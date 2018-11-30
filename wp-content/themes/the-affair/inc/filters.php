<?php
/**
 * Filters
 *
 * Filtering native WordPress and third-party plugins' functions.
 *
 * @package The Affair
 */

/**
 * Adds classes to <body> tag
 *
 * @param array $classes is an array of all body classes.
 */
function csco_body_class( $classes ) {

	// Page Sidebar.
	$classes[] = 'sidebar-' . csco_get_page_sidebar();

	// Page Layout.
	$classes[] = 'page-layout-' . csco_get_page_layout();

	// Parallax.
	if ( get_theme_mod( 'effects_parallax', true ) ) {
		$classes[] = 'parallax-enabled';
	}

	// Sticky Navbar.
	if ( get_theme_mod( 'navbar_sticky', true ) ) {
		$classes[] = 'navbar-sticky-enabled';
	}

	// Smart Navbar.
	if ( get_theme_mod( 'navbar_sticky', true ) && get_theme_mod( 'effects_navbar_scroll', true ) ) {
		$classes[] = 'navbar-smart-enabled';
	}

	// Sticky Sidebar.
	if ( get_theme_mod( 'sticky_sidebar', true ) ) {
		$classes[] = 'sticky-sidebar-enabled';
		$classes[] = get_theme_mod( 'sticky_sidebar_method', 'stick-to-bottom' );
	}

	return $classes;
}

add_filter( 'body_class', 'csco_body_class' );

/**
 * Check if there enable a sidebar for display.
 *
 * @param bool   $is_active_sidebar Whether or not the sidebar should be considered "active".
 * @param string $index             Sidebar name, id or number to check.
 */
function csco_is_active_sidebar_main( $is_active_sidebar, $index ) {

	if ( 'sidebar-main' === $index && 'disabled' === csco_get_page_sidebar() ) {
		return false;
	}

	return $is_active_sidebar;
}
add_filter( 'is_active_sidebar', 'csco_is_active_sidebar_main', 10, 2 );

/**
 * TinyMCE Refresh Cache.
 *
 * @param array $settings An array with TinyMCE config.
 */
function csco_tiny_mce_refresh_cache( $settings ) {

	$theme = wp_get_theme();

	$settings['cache_suffix'] = sprintf( 'v=%s', $theme->get( 'Version' ) );

	return $settings;
}

add_filter( 'tiny_mce_before_init', 'csco_tiny_mce_refresh_cache' );

/**
 * Changes max image width in srcset attribute
 *
 * @param int   $max_width  The maximum image width to be included in the 'srcset'. Default '1600'.
 * @param array $size_array Array of width and height values in pixels (in that order).
 */
function csco_max_srcset_image_width( $max_width, $size_array ) {
	return 3840;
}
add_filter( 'max_srcset_image_width', 'csco_max_srcset_image_width', 10, 2 );

/**
 *  Add responsive container to embeds, except for Instagram and Twitter
 *
 * @param string $html oembed markup.
 */
function csco_embed_oembed_html( $html ) {
	// Skip if Jetpack is active.
	if ( class_exists( 'Jetpack' ) ) {
		return $html;
	}
	// Skip for Instagram, Twitter & Facebook embeds.
	if ( strpos( $html, 'instagram' ) || strpos( $html, 'twitter-tweet' ) || strpos( $html, 'facebook' ) ) {
		return $html;
	}
	return '<div class="cs-embed cs-embed-responsive">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'csco_embed_oembed_html', 10, 3 );

/**
 * Archive Title
 *
 * Removes default prefixes, like "Category:" from archive titles.
 *
 * @param string $title Archive title.
 */
function csco_get_the_archive_title( $title ) {
	if ( is_category() ) {

		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {

		$title = single_tag_title( '', false );

	} elseif ( is_author() ) {

		$title = get_the_author( '', false );

	}
	return $title;
}

add_filter( 'get_the_archive_title', 'csco_get_the_archive_title' );

/**
 * Excerpt Length
 *
 * @param string $length of the excerpt.
 */
function csco_excerpt_length( $length ) {
	return 30;
}

add_filter( 'excerpt_length', 'csco_excerpt_length' );

/**
 * Strip shortcodes from excerpt
 *
 * @param string $content Excerpt.
 */
function csco_strip_shortcode_from_excerpt( $content ) {
	$content = strip_shortcodes( $content );
	return $content;
}

add_filter( 'the_excerpt', 'csco_strip_shortcode_from_excerpt' );

/**
 * Excerpt Suffix
 *
 * @param string $more suffix for the excerpt.
 */
function csco_excerpt_more( $more ) {
	return '&hellip;';
}

add_filter( 'excerpt_more', 'csco_excerpt_more' );

/**
 * Pre processing post meta choices
 *
 * @param array $data Post meta list.
 */
function csco_post_meta_process( $data ) {
	if ( ! csco_powerkit_module_enabled( 'share_buttons' ) && isset( $data['shares'] ) ) {
		unset( $data['shares'] );
	}
	if ( ! class_exists( 'Post_Views_Counter' ) && isset( $data['views'] ) ) {
		unset( $data['views'] );
	}
	return $data;
}

add_filter( 'csco_post_meta_choices', 'csco_post_meta_process' );

/**
 * Paginated Post Pagination
 *
 * @param string $args Paginated posts pagination args.
 */
function csco_wp_link_pages_args( $args ) {
	if ( 'next_and_number' === $args['next_or_number'] ) {
		global $page, $numpages, $multipage, $more, $pagenow;
		$args['next_or_number'] = 'number';

		$prev = '';
		$next = '';
		if ( $multipage ) {
			if ( $more ) {
				$i = $page - 1;
				if ( $i && $more ) {
					$prev .= _wp_link_page( $i );
					$prev .= $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$next .= _wp_link_page( $i );
					$next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>';
				}
			}
		}
		$args['before'] = $args['before'] . $prev;
		$args['after']  = $next . $args['after'];
	}
	return $args;
}

add_filter( 'wp_link_pages_args', 'csco_wp_link_pages_args' );

/**
 * -------------------------------------------------------------------------
 * [ Gridable ]
 * -------------------------------------------------------------------------
 */

/**
 * Row Class
 */
function csco_gridable_row_class() {
	return array( 'cs-row' );
}
add_filter( 'gridable_row_class', 'csco_gridable_row_class' );

/**
 * Column Class
 *
 * @param array  $classes Available classes.
 * @param int    $size    Column size.
 * @param array  $atts    Attributes.
 * @param string $content Content.
 */
function csco_gridable_column_class( $classes, $size, $atts, $content ) {

	$classes = array( 'cs-col-md-' . $size );

	return $classes;
}
add_filter( 'gridable_column_class', 'csco_gridable_column_class', 10, 4 );

/**
 * Remove Default Styles
 */
add_filter( 'gridable_load_public_style', '__return_false' );

/**
 * Remove Default Scripts
 */
function csco_gridable_load_public_scripts() {
	wp_dequeue_script( 'gridable' );
}
add_action( 'wp_print_scripts', 'csco_gridable_load_public_scripts' );
