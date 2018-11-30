<?php
/**
 * Deprecated features and migration functions
 *
 * @package The Affair
 */

/**
 * Check First Theme Version
 */
function csco_first_theme_version() {
	$theme_name = get_template();

	if ( get_option( 'csco_theme_version_' . $theme_name ) ) {
		return;
	}

	$triggers = array(
		'theme_mods_the-affair',
		'widget_the_affair_widget_posts',
		'widget_the_affair_widget_about',
		'widget_the_affair_widget_facebook',
		'widget_the_affair_widget_twitter',
		'widget_the_affair_widget_social',
		'widget_the_affair_widget_subscribe',
	);

	foreach ( $triggers as $trigger ) {
		if ( get_option( $trigger ) ) {
			update_option( 'csco_sidebars_widgets', get_option( 'sidebars_widgets' ), true );
			update_option( 'csco_theme_version_' . $theme_name, '1.0.0' );
			break;
		}
	}
}
add_action( 'init', 'csco_first_theme_version', 10 );

/**
 * Check Theme Version
 */
function csco_check_theme_version() {
	// Get Theme info.
	$theme_name = get_template();
	$theme      = wp_get_theme( $theme_name );
	$theme_ver  = $theme->get( 'Version' );

	// Get Theme option.
	$csco_theme_version = get_option( 'csco_theme_version_' . $theme_name );

	// Get old version.
	if ( $theme_name && isset( $csco_theme_version ) ) {
		$old_theme_ver = $csco_theme_version;
	}

	// First start.
	if ( ! isset( $old_theme_ver ) ) {
		$old_theme_ver = 0;
	}

	// If versions don't match.
	if ( $old_theme_ver !== $theme_ver ) {

		/**
		 * If different versions call a special hook.
		 *
		 * @param string $old_theme_ver  Old theme version.
		 * @param string $theme_ver      New theme version.
		 */
		do_action( 'csco_theme_deprecated', $old_theme_ver, $theme_ver );

		update_option( 'csco_theme_version_' . $theme_name, $theme_ver );
	}
}
add_action( 'init', 'csco_check_theme_version', 30 );

/**
 * Run migration based.
 *
 * @param string $old_theme_ver Old Theme version.
 * @param string $theme_ver     Current Theme version.
 */
function csco_run_migration( $old_theme_ver, $theme_ver ) {

	if ( $old_theme_ver && version_compare( $old_theme_ver, '1.0.0', '<=' ) ) {
		csco_migrate_custom_css();
		csco_migrate_theme_menu();
		csco_migrate_theme_terms();
		csco_migrate_theme_widgets();
		csco_migrate_theme_settings();
		csco_migrate_theme_posts();

		// Clear cache.
		header( 'Refresh:0' );
	}
}
add_action( 'csco_theme_deprecated', 'csco_run_migration', 10, 2 );

/**
 * Custom CSS Migrate
 */
function csco_migrate_custom_css() {
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$custom_css = get_theme_mod( 'the_affair_custom_css' );
		if ( $custom_css ) {
			$core_css = wp_get_custom_css();
			wp_update_custom_css_post( $core_css . $custom_css );
		}
	}
}

/**
 * General Theme Mod Migration Function
 *
 * @param string $old Old theme mod name.
 * @param string $new New theme mod name.
 * @param array  $unset Unset array keys.
 */
function csco_migrate_theme_mod( $old, $new, $unset = array() ) {
	$old = get_theme_mod( $old );
	if ( $old ) {
		if ( is_array( $old ) && $unset ) {
			foreach ( $unset as $param ) {
				unset( $old[ $param ] );
			}
		}
		set_theme_mod( $new, $old );
	}
}

/**
 * Theme Settings Migrate
 */
function csco_migrate_theme_menu() {
	$locations = get_theme_mod( 'nav_menu_locations' );

	$new_locations = array();

	if ( $locations ) {
		foreach ( $locations as $slug => $location ) {
			if ( 'primary-menu' === $slug ) {
				$new_locations['primary'] = $location;
			} elseif ( 'footer-menu' === $slug ) {
				$new_locations['footer'] = $location;
			} else {
				$new_locations[ $slug ] = $location;
			}
		}
	}

	set_theme_mod( 'nav_menu_locations', $new_locations );
}

/**
 * Theme Terms Migrate
 */
function csco_migrate_theme_terms() {
	$terms = get_terms( 'category', array(
		'hide_empty' => false,
	) );

	if ( $terms ) {
		foreach ( $terms as $term ) {
			$header_image = get_option( sprintf( 'category_%s_csco_category_thumbnail', $term->term_id ), false );

			if ( $header_image ) {
				update_term_meta( $term->term_id, 'csco_header_image', $header_image );
			}
		}
	}
}

/**
 * Theme Widgets Migrate
 */
function csco_migrate_theme_widgets() {
	$search = array(
		'the_affair_widget_posts',
		'the_affair_widget_about',
		'the_affair_widget_facebook',
		'the_affair_widget_twitter',
		'the_affair_widget_social',
		'the_affair_widget_subscribe',
	);

	$replace = array(
		'powerkit_widget_posts',
		'powerkit_widget_author',
		'powerkit_facebook_fanpage_widget',
		'powerkit_twitter_widget',
		'powerkit_social_links_widget',
		'powerkit_opt_in_subscription_widget',
	);

	// Sidebars.
	$csco_sidebars = get_option( 'csco_sidebars_widgets' );
	$sidebars      = wp_get_sidebars_widgets();

	$new_sidebars = array();

	if ( $csco_sidebars ) {
		foreach ( $csco_sidebars as $slug => & $sidebar ) {
			if ( is_array( $sidebar ) && $sidebar ) {
				foreach ( $sidebar as $key => $widget ) {
					$sidebar[ $key ] = str_replace( $search, $replace, $sidebar[ $key ] );
				}
			}
			if ( 'sidebar-primary' === $slug ) {
				$new_sidebars['sidebar-offcanvas'] = $sidebar;
			} else {
				$new_sidebars[ $slug ] = $sidebar;
			}
		}
	}

	if ( isset( $new_sidebars['sidebar-offcanvas'] ) ) {
		$sidebars['sidebar-offcanvas'] = $new_sidebars['sidebar-offcanvas'];
	}

	wp_set_sidebars_widgets( $sidebars );


	// Widgets.
	foreach ( $search as $widget_name ) {
		$widget_db_name  = 'widget_' . $widget_name;
		$sidebar_widgets = get_option( $widget_db_name );

		if ( ! is_array( $sidebar_widgets ) ) {
			continue;
		}

		// Each added widgets.
		foreach ( $sidebar_widgets as $widget_id => $widgets_fields ) {

			// ACF widget ID.
			$acf_widget_id = $widget_db_name . '-' . $widget_id;

			// Add fields for replacement.
			switch ( $widget_name ) {

				// Widget About.
				case 'the_affair_widget_about':
					$replace_fields = array( 'social_accounts' );
					break;

				// Widget Facebook.
				case 'the_affair_widget_facebook':
					$replace_fields = array( 'href', 'hide-cover', 'show-facepile', 'show-posts', 'small-header', 'adapt-container-width' );
					break;

				// Widget Subscribe.
				case 'the_affair_widget_subscribe':
					$replace_fields = array( 'text' );
					break;

				// Widget Twitter.
				case 'the_affair_widget_twitter':
					$replace_fields = array( 'tweets_count', 'consumer_key', 'consumer_secret', 'access_token', 'access_token_secret' );
					break;

				// Widget Posts.
				case 'the_affair_widget_posts':
					$replace_fields = array( 'layout', 'posts_per_page', 'orderby', 'order', 'time_frame', 'category', 'post_meta', 'post_meta_compact' );
					break;

				default:
					$replace_fields = array();
					break;
			}

			// Each fields needed for replacement.
			foreach ( $replace_fields as & $field_name ) {
				$acf_db_name = $widget_db_name . '-' . $widget_id . '_' . $field_name;

				// Get ACF Field.
				$acf_field_value = get_option( $acf_db_name );

				if ( $acf_field_value ) {

					// New field value.
					$new_value = $acf_field_value;

					// Exceptions of replacing.
					switch ( $widget_name ) {
						// Widget Facebook.
						case 'the_affair_widget_facebook':
							$field_name = str_replace( '-', '_', $field_name );
							break;
						// Widget Posts.
						case 'the_affair_widget_twitter':
							if ( 'tweets_count' === $field_name ) {
								$field_name = 'number';
							}
							if ( 'consumer_key' === $field_name ) {
								update_option( 'powerkit_twitter_consumer_key', $acf_field_value );
							}
							if ( 'consumer_secret' === $field_name ) {
								update_option( 'powerkit_twitter_consumer_secret', $acf_field_value );
							}
							if ( 'access_token' === $field_name ) {
								update_option( 'powerkit_twitter_access_token', $acf_field_value );
							}
							if ( 'access_token_secret' === $field_name ) {
								update_option( 'powerkit_twitter_access_token_secret', $acf_field_value );
							}
							break;
						// Widget Posts.
						case 'the_affair_widget_posts':
							if ( 'layout' === $field_name ) {
								$field_name = 'template';
								$new_value  = 'slider' === $acf_field_value ? 'carousel' : $acf_field_value;
							}
							break;
					}

					// Replace field value in the widget.
					$sidebar_widgets[ $widget_id ][ $field_name ] = $new_value;
				}
			}
		}

		$widget_new_db_name = str_replace( $search, $replace, $widget_db_name );

		// Update widget.
		$updated = update_option( $widget_new_db_name, $sidebar_widgets );
	}
}

/**
 * Theme Settings Migrate
 */
function csco_migrate_theme_settings() {
	$theme_mods = array(
		array(
			'old' => 'the_affair_typography_base',
			'new' => 'font_base',
		),
		array(
			'old'   => 'the_affair_btn_typography',
			'new'   => 'font_primary',
			'unset' => array( 'subsets', 'line-height' ),
		),
		array(
			'old' => 'layout_post_cover_bg_brand',
			'new' => 'color_cover_bg_brand',
		),
		array(
			'old' => 'layout_post_cover_bg_primary',
			'new' => 'color_cover_bg_primary',
		),
		array(
			'old' => 'layout_post_cover_bg_secondary',
			'new' => 'color_cover_bg_secondary',
		),
		array(
			'old' => 'the_affair_home_heading',
			'new' => 'hero',
		),
		array(
			'old' => 'the_affair_home_heading_height',
			'new' => 'hero_height',
		),
		array(
			'old' => 'the_affair_home_bg_select',
			'new' => 'hero_background',
		),
		array(
			'old' => 'the_affair_home_bg_video_source',
			'new' => 'hero_background_video_source',
		),
		array(
			'old' => 'the_affair_home_bg_video_hosted',
			'new' => 'hero_background_video_hosted',
		),
		array(
			'old' => 'the_affair_home_bg_video_self',
			'new' => 'hero_background_video_self',
		),
		array(
			'old' => 'the_affair_home_logo_select',
			'new' => 'hero_content',
		),
		array(
			'old' => 'the_affair_home_logo_width',
			'new' => 'hero_logo_width',
		),
		array(
			'old' => 'the_affair_home_logo_text',
			'new' => 'hero_title',
		),
		array(
			'old' => 'the_affair_home_featured',
			'new' => 'featured_posts',
		),
		array(
			'old' => 'the_affair_home_featured_height',
			'new' => 'featured_posts_height',
		),
		array(
			'old' => 'the_affair_home_featured_slides_number',
			'new' => 'featured_posts_number',
		),
		array(
			'old' => 'the_affair_home_featured_columns',
			'new' => 'featured_posts_columns',
		),
		array(
			'old' => 'the_affair_header_navbar_bg_color',
			'new' => 'color_navbar_bg',
		),
		array(
			'old' => 'the_affair_footer_bg_color',
			'new' => 'color_footer_bg',
		),
		array(
			'old' => 'the_affair_effects_parallax',
			'new' => 'effects_parallax',
		),
		array(
			'old' => 'the_affair_effects_navbar_scroll',
			'new' => 'navbar_sticky',
		),
		array(
			'old' => 'the_affair_effects_sticky_sidebar',
			'new' => 'sticky_sidebar',
		),
	);

	$unset = array();

	foreach ( $theme_mods as $theme_mod ) {
		if ( isset( $theme_mod['unset'] ) ) {
			$unset = $theme_mod['unset'];
		}
		csco_migrate_theme_mod( $theme_mod['old'], $theme_mod['new'], $unset );
	}

	// Logo.
	$logo = get_theme_mod( 'the_affair_header_logo_url' );
	if ( $logo && is_string( $logo ) ) {
		$logo_id = attachment_url_to_postid( $logo );

		if ( $logo_id ) {
			set_theme_mod( 'logo', $logo_id );
		}
	}

	// Hero.
	if ( ! get_theme_mod( 'the_affair_home_heading' ) ) {
		set_theme_mod( 'hero', true );
	}

	// Hero Logo.
	$logo = get_theme_mod( 'the_affair_home_logo_url' );
	if ( $logo && is_string( $logo ) ) {
		$logo_id = attachment_url_to_postid( $logo );

		if ( $logo_id ) {
			set_theme_mod( 'hero_logo', $logo_id );
		}
	}

	// Hero Background Image.
	$hero_bg_url = get_theme_mod( 'the_affair_home_bg_url' );
	$hero_bg_id  = attachment_url_to_postid( $hero_bg_url );

	if ( $hero_bg_id ) {
		set_theme_mod( 'hero_background_image', $hero_bg_id );
		set_theme_mod( 'hero_background_video_poster', $hero_bg_id );
	}

	// Hero Background Color.
	$bg_color = get_theme_mod( 'hero_background_color' );
	if ( ! $bg_color ) {
		set_theme_mod( 'hero_background_color', '#000000' );
	}

	// Home featured.
	if ( ! get_theme_mod( 'the_affair_home_featured' ) ) {
		set_theme_mod( 'featured_posts', true );
	}

	// Page Layout.
	$page_layout = get_theme_mod( 'the_affair_page_layout' );

	$page_layout = str_replace( array( 'layout-boxed', 'layout-fullwidth' ), array( 'boxed', 'fullwidth' ), $page_layout );

	if ( $page_layout ) {
		set_theme_mod( 'home_page_layout', $page_layout );
		set_theme_mod( 'archive_page_layout', $page_layout );
		set_theme_mod( 'post_layout', $page_layout );
		set_theme_mod( 'page_layout', $page_layout );
	} else {
		set_theme_mod( 'home_page_layout', 'boxed' );
		set_theme_mod( 'archive_page_layout', 'boxed' );
		set_theme_mod( 'post_layout', 'fullwidth' );
		set_theme_mod( 'page_layout', 'fullwidth' );
	}

	// Page Sidebar.
	set_theme_mod( 'home_sidebar', 'disabled' );
	set_theme_mod( 'archive_sidebar', 'disabled' );
	set_theme_mod( 'post_sidebar', 'disabled' );
	set_theme_mod( 'page_sidebar', 'disabled' );

	// Instagram Username.
	$instagram = get_theme_mod( 'the_affair_footer_instagram_username' );
	if ( $instagram ) {
		set_theme_mod( 'footer_instagram_recent', true );
		set_theme_mod( 'footer_instagram_user_id', $instagram );
	}

	// Post Meta.
	$post_meta = array();
	if ( get_theme_mod( 'the_affair_meta_date' ) ) {
		array_push( $post_meta, 'date' );
	}
	if ( get_theme_mod( 'the_affair_meta_comments' ) ) {
		array_push( $post_meta, 'comments' );
	}
	if ( get_theme_mod( 'the_affair_meta_category' ) ) {
		array_push( $post_meta, 'category' );
	}
	if ( get_theme_mod( 'the_affair_meta_reading_time' ) ) {
		array_push( $post_meta, 'reading_time' );
	}
	if ( get_theme_mod( 'the_affair_meta_views' ) ) {
		array_push( $post_meta, 'views' );
	}
	if ( get_theme_mod( 'the_affair_meta_author' ) ) {
		array_push( $post_meta, 'author' );
	}
	if ( $post_meta ) {
		set_theme_mod( 'home_post_meta', $post_meta );
		set_theme_mod( 'archive_post_meta', $post_meta );
	}

	// Connect.
	$social_accounts = get_option( 'csco_social_accounts', array( 'facebook' ) );

	if ( $social_accounts ) {
		$multiple_list       = array();
		$order_multiple_list = array();
		foreach ( $social_accounts as $account ) {
			if ( isset( $account['type'] ) ) {
				array_push( $multiple_list, $account['type'] );
				array_push( $order_multiple_list, $account['type'] );
			}
		}
		update_option( 'powerkit_social_links_multiple_list', $multiple_list );
		update_option( 'powerkit_social_links_order_multiple_list', $order_multiple_list );
	}
}

/**
 * Theme Posts Migrate
 */
function csco_migrate_theme_posts() {
	$args = array(
		'numberposts'      => -1,
		'post_status'      => array( 'publish', 'draft', 'future' ),
		'post_type'        => array( 'post', 'page' ),
		'suppress_filters' => true,
	);

	$posts = get_posts( $args );

	// Loop.
	if ( $posts ) {
		foreach ( $posts as $post ) {
			// Replace shortcode gallery layout.
			$post->post_content = preg_replace( '/(\[gallery.*?)(layout)(=.*?\])/', '$1type$3', $post->post_content );
			// Replace shortcode alert dismissible.
			$post->post_content = preg_replace( '/(\[powerkit_alert.*?)(dismissable)(=.*?\])/', '$1dismissible$3', $post->post_content );

			// New data of post.
			$settings                 = array();
			$settings['ID']           = $post->ID;
			$settings['post_content'] = $post->post_content;

			// Update the data in the database.
			wp_update_post( wp_slash( $settings ) );
		}
	}
}
