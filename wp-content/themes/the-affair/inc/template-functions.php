<?php
/**
 * Template Functions
 *
 * Utility functions.
 *
 * @package The Affair
 */

if ( ! function_exists( 'csco_doing_request' ) ) {
	/**
	 * Determines whether the current request is a WordPress REST or Ajax request.
	 */
	function csco_doing_request() {
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return true;
		}
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return true;
		}
	}
}

if ( ! function_exists( 'csco_get_locale' ) ) {
	/**
	 * Get locale in uniform format.
	 */
	function csco_get_locale() {

		$csco_locale = get_locale();

		if ( preg_match( '#^[a-z]{2}\-[A-Z]{2}$#', $csco_locale ) ) {
			$csco_locale = str_replace( '-', '_', $csco_locale );
		} elseif ( preg_match( '#^[a-z]{2}$#', $csco_locale ) ) {
			$csco_locale .= '_' . mb_strtoupper( $csco_locale, 'UTF-8' );
		}

		if ( empty( $csco_locale ) ) {
			$csco_locale = 'en_US';
		}

		return apply_filters( 'csco_locale', $csco_locale );

	}
}

if ( ! function_exists( 'csco_hex_is_light' ) ) {
	/**
	 * Determine whether a hex color is light.
	 *
	 * @param mixed $color Color.
	 * @return bool  True if a light color.
	 */
	function csco_hex_is_light( $color ) {
		$hex        = str_replace( '#', '', $color );
		$c_r        = hexdec( substr( $hex, 0, 2 ) );
		$c_g        = hexdec( substr( $hex, 2, 2 ) );
		$c_b        = hexdec( substr( $hex, 4, 2 ) );
		$brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;
		return $brightness > 155;
	}
}

if ( ! function_exists( 'csco_light_or_dark' ) ) {
	/**
	 * Detect if we should use a light or dark color on a background color.
	 *
	 * @param mixed  $color Color.
	 * @param string $dark  Darkest reference.
	 *                      Defaults to '#000000'.
	 * @param string $light Lightest reference.
	 *                      Defaults to '#FFFFFF'.
	 * @return string
	 */
	function csco_light_or_dark( $color, $dark = '#000000', $light = '#FFFFFF' ) {
		return csco_hex_is_light( $color ) ? $dark : $light;
	}
}


if ( ! function_exists( 'csco_get_round_number' ) ) {
	/**
	 * Get rounded number.
	 *
	 * @param int $number    Input number.
	 * @param int $min_value Minimum value to round number.
	 * @param int $decimal   How may decimals shall be in the rounded number.
	 */
	function csco_get_round_number( $number, $min_value = 1000, $decimal = 1 ) {
		if ( $number < $min_value ) {
			return number_format_i18n( $number );
		}
		$alphabets = array(
			1000000000 => esc_html__( 'B', 'the-affair' ),
			1000000    => esc_html__( 'M', 'the-affair' ),
			1000       => esc_html__( 'K', 'the-affair' ),
		);
		foreach ( $alphabets as $key => $value ) {
			if ( $number >= $key ) {
				return number_format_i18n( round( $number / $key, $decimal ), $decimal ) . $value;
			}
		}
	}
}

if ( ! function_exists( 'csco_the_round_number' ) ) {
	/**
	 * Echo rounded number.
	 *
	 * @param int $number    Input number.
	 * @param int $min_value Minimum value to round number.
	 * @param int $decimal   How may decimals shall be in the rounded number.
	 */
	function csco_the_round_number( $number, $min_value = 1000, $decimal = 1 ) {
		echo esc_html( csco_get_round_number( $number, $min_value, $decimal ) );
	}
}

if ( ! function_exists( 'csco_str_truncate' ) ) {
	/**
	 * Truncates string with specified length
	 *
	 * @param  string $string      Text string.
	 * @param  int    $length      Letters length.
	 * @param  string $etc         End truncate.
	 * @param  bool   $break_words Break words or not.
	 * @return string
	 */
	function csco_str_truncate( $string, $length = 80, $etc = '&#133;', $break_words = false ) {
		if ( 0 === $length ) {
			return '';
		}

		if ( function_exists( 'mb_strlen' ) ) {

			// MultiBite string functions.
			if ( mb_strlen( $string ) > $length ) {
				$length -= min( $length, mb_strlen( $etc ) );
				if ( ! $break_words ) {
					$string = preg_replace( '/\s+?(\S+)?$/', '', mb_substr( $string, 0, $length + 1 ) );
				}

				return mb_substr( $string, 0, $length ) . $etc;
			}
		} else {

			// Default string functions.
			if ( strlen( $string ) > $length ) {
				$length -= min( $length, strlen( $etc ) );
				if ( ! $break_words ) {
					$string = preg_replace( '/\s+?(\S+)?$/', '', substr( $string, 0, $length + 1 ) );
				}

				return substr( $string, 0, $length ) . $etc;
			}
		}

		return $string;
	}
}

if ( ! function_exists( 'csco_get_retina_image' ) ) {
	/**
	 * Get retina image.
	 *
	 * @param int    $attachment_id Image attachment ID.
	 * @param array  $attr          Attributes for the image markup. Default empty.
	 * @param string $type          The tag of type.
	 */
	function csco_get_retina_image( $attachment_id, $attr = array(), $type = 'img' ) {
		$attachment_url = wp_get_attachment_url( $attachment_id );

		// Retina image.
		$attached_file = get_attached_file( $attachment_id );

		if ( $attached_file ) {
			$uriinfo  = pathinfo( $attachment_url );
			$pathinfo = pathinfo( $attached_file );

			$retina_uri  = sprintf( '%s/%s@2x.%s', $uriinfo['dirname'], $uriinfo['filename'], $uriinfo['extension'] );
			$retina_file = sprintf( '%s/%s@2x.%s', $pathinfo['dirname'], $pathinfo['filename'], $pathinfo['extension'] );

			if ( file_exists( $retina_file ) ) {
				$attr['srcset'] = sprintf( '%s 1x, %s 2x', $attachment_url, $retina_uri );
			}
		}

		// Sizes.
		if ( 'amp-img' === $type ) {
			$data = wp_get_attachment_image_src( $attachment_id, 'full' );

			if ( isset( $data[1] ) ) {
				$attr['width'] = $data[1];
			}
			if ( isset( $data[2] ) ) {
				$attr['height'] = $data[2];
			}
		}

		// Attr.
		$output = null;

		foreach ( $attr as $name => $value ) {
			$output .= sprintf( ' %s="%s" ', esc_attr( $name ), esc_attr( $value ) );
		}

		// Image output.
		printf( '<%1$s src="%2$s" %3$s>', esc_attr( $type ), esc_url( $attachment_url ), $output ); // XSS ok.
	}
}

if ( ! function_exists( 'csco_offcanvas_exists' ) ) {
	/**
	 * Check if offcanvas exists.
	 */
	function csco_offcanvas_exists() {
		$locations = get_nav_menu_locations();

		if ( isset( $locations['mobile'] ) || is_active_sidebar( 'sidebar-offcanvas' ) ) {
			return true;
		}
	}
}

if ( ! function_exists( 'csco_coauthors_enabled' ) ) {
	/**
	 * Is it possible to check whether it is possible to output CoAuthors.
	 */
	function csco_coauthors_enabled() {
		if ( class_exists( 'Powerkit' ) && class_exists( 'CoAuthors_Plus' ) ) {
			return true;
		}
	}
}

if ( ! function_exists( 'csco_powerkit_module_enabled' ) ) {
	/**
	 * Helper function to check the status of powerkit modules
	 *
	 * @param array $name Name of module.
	 */
	function csco_powerkit_module_enabled( $name ) {
		if ( function_exists( 'powerkit_module_enabled' ) && powerkit_module_enabled( $name ) ) {
			return true;
		}
	}
}

if ( ! function_exists( 'csco_share_links' ) ) {
	/**
	 * Post Share links
	 */
	function csco_share_links() {

		if ( ! function_exists( 'powerkit_share_buttons_location' ) ) {
			return;
		}

		if ( ! get_option( 'powerkit_share_buttons_post_archive_display' ) ) {
			return;
		}

		$total    = get_option( 'powerkit_share_buttons_post_archive_display_total_share_count', true );
		$accounts = get_option( 'powerkit_share_buttons_post_archive_multiple_list', array( 'facebook', 'twitter', 'pinterest' ) );

		// Share Count.
		$shares = $total ? powerkit_share_buttons_get_total_count( $accounts, get_the_ID(), null, true ) : null;
		?>
			<div class="meta-share-links">
				<div class="share-total">
					<i class="cs-icon cs-icon-share"></i>
					<?php
					if ( ! $shares ) {
						echo esc_html__( 'Share', 'the-affair' );
					} else {
						$shares = powerkit_share_buttons_count_format( $shares );
						/* translators: %s number of post views */
						echo esc_html( sprintf( _n( '%s Share', '%s Shares', $shares, 'the-affair' ), $shares ) );
					}
					?>
				</div>
				<?php
					powerkit_share_buttons_location( 'post_archive' );
				?>
			</div>
		<?php
	}
}

if ( ! function_exists( 'csco_get_cover_background' ) ) {
	/**
	 * Get Cover Background
	 */
	function csco_get_cover_background() {
		$post_cover_bg = get_post_meta( get_the_ID(), 'csco_post_cover_bg', true );

		$color_class = sprintf( ' cover-%s', $post_cover_bg ? $post_cover_bg : 'default' );

		if ( $post_cover_bg ) {

			if ( 'default' !== $post_cover_bg ) {
				$color = get_theme_mod( 'color_cover_bg_' . $post_cover_bg );

				if ( ! in_array( strtoupper( $color ), array( '#C3C9C8', '#B7B9BC', '#D1D0CA', false ), true ) ) {
					$color_class .= csco_light_or_dark( $color, null, ' cs-bg-dark' );
				} else {
					$color_class .= ' cs-bg-dark';
				}
			}
		}

		return $color_class;
	}
}

if ( ! function_exists( 'csco_kirki_rules_output' ) ) {
	/**
	 * Add new rules to kirki output
	 *
	 * @param string $filter The name of filter.
	 * @param array  $rules  The rules.
	 * @param int    $index  The index.
	 */
	function csco_kirki_rules_output( $filter, $rules = array(), $index = 0 ) {

		// Init kirki filter.
		add_filter( $filter, function( $output ) use ( $rules, $index ) {
			if ( isset( $output[ $index ]['element'] ) ) {
				// Explode elements.
				$data = explode( ',', $output[ $index ]['element'] );

				// Add new elements.
				$data = array_merge( $data, $rules );

				// Implode elements.
				$output[ $index ]['element'] = implode( ',', $data );
			}

			return $output;
		} );
	}
}

if ( ! function_exists( 'csco_attachment_orientation_data' ) ) {
	/**
	 * Check attachment orientation: portrait, landscape or square.
	 *
	 * @param int    $attachment_id  The id of attachment.
	 * @param bool   $support_square Support square orientation.
	 * @param string $orientation    Defined orientation.
	 */
	function csco_attachment_orientation_data( $attachment_id, $support_square = true, $orientation = null ) {

		$image_data = wp_get_attachment_image_src( $attachment_id, 'full' );

		$slug = 'cs-thumbnail';

		if ( 'fullwidth' === csco_get_page_layout() ) {
			$slug = 'cs-large';
		} elseif ( 'disabled' === csco_get_page_sidebar() ) {
			$slug = 'cs-medium';
		}

		if ( ! $orientation ) {
			$orientation = 'landscape';

			if ( $image_data ) {

				$width  = $image_data[1];
				$height = $image_data[2];

				if ( $width > $height ) {
					$orientation = 'landscape';
				} elseif ( $height > $width ) {
					$orientation = 'portrait';
				} elseif ( $height === $width ) {
					if ( $support_square ) {
						$orientation = 'square';
					} else {
						$orientation = 'landscape';
					}
				}
			}
		}

		$size = sprintf( '%s-%s', $slug, $orientation );

		return array(
			'size'        => $size,
			'orientation' => $orientation,
		);
	}
}

if ( ! function_exists( 'csco_get_archive_location' ) ) {
	/**
	 * Returns Archive Location.
	 */
	function csco_get_archive_location() {

		global $wp_query;

		if ( isset( $wp_query->query_vars['csco_query']['location'] ) ) {

			return $wp_query->query_vars['csco_query']['location'];
		}

		if ( is_home() ) {

			return 'home';

		} else {

			return 'archive';
		}
	}
}

if ( ! function_exists( 'csco_get_archive_option' ) ) {
	/**
	 * Returns Archive Option Name.
	 *
	 * @param string $option_name The customize option name.
	 */
	function csco_get_archive_option( $option_name ) {

		return csco_get_archive_location() . '_' . $option_name;
	}
}

if ( ! function_exists( 'csco_get_page_layout' ) ) {
	/**
	 * Returns Page Layout: fullwidth or boxed.
	 */
	function csco_get_page_layout() {

		if ( is_home() ) {

			$show_on_front = get_option( 'show_on_front', 'posts' );

			if ( 'posts' === $show_on_front ) {

				return apply_filters( 'csco_page_layout', get_theme_mod( 'home_page_layout', 'boxed' ) );
			}

			if ( 'page' === $show_on_front ) {

				$layout = get_post_meta( $post->ID, 'csco_singular_layout', true );

				if ( ! $layout || 'default' === $layout ) {

					return apply_filters( 'csco_page_layout', get_theme_mod( 'page_layout', 'fullwidth' ) );
				}

				return apply_filters( 'csco_page_layout', $layout );
			}
		}

		if ( is_archive() || is_search() ) {
			return apply_filters( 'csco_page_layout', get_theme_mod( 'archive_page_layout', 'fullwidth' ) );
		}

		if ( is_singular() ) {

			global $post;

			$layout = get_post_meta( $post->ID, 'csco_singular_layout', true );

			if ( ! $layout || 'default' === $layout ) {

				$post_type = get_post_type( $post );

				return apply_filters( 'csco_page_layout', get_theme_mod( $post_type . '_layout', 'boxed' ) );
			}

			return apply_filters( 'csco_page_layout', $layout );
		}

		if ( is_404() ) {
			return apply_filters( 'csco_page_layout', get_theme_mod( 'page_layout', 'fullwidth' ) );
		}

		return apply_filters( 'csco_page_layout', 'fullwidth' );
	}
}

if ( ! function_exists( 'csco_get_page_sidebar' ) ) {
	/**
	 * Returns Page Sidebar: right, left or disabled.
	 */
	function csco_get_page_sidebar() {

		if ( is_home() ) {

			$show_on_front = get_option( 'show_on_front', 'posts' );

			if ( 'posts' === $show_on_front ) {

				return apply_filters( 'csco_page_sidebar', get_theme_mod( 'home_sidebar', 'right' ) );
			}

			if ( 'page' === $show_on_front ) {

				// Get sidebar for the blog posts page.
				$sidebar = get_post_meta( $post->ID, 'csco_singular_sidebar', true );

				if ( ! $sidebar || 'default' === $sidebar ) {

					return apply_filters( 'csco_page_sidebar', get_theme_mod( 'page_sidebar', 'right' ) );
				}

				return apply_filters( 'csco_page_sidebar', $sidebar );
			}
		}

		if ( is_singular( array( 'post', 'page' ) ) ) {

			global $post;

			// Get sidebar for current post.
			$sidebar = get_post_meta( $post->ID, 'csco_singular_sidebar', true );

			if ( ! $sidebar || 'default' === $sidebar ) {

				$post_type = get_post_type( $post );

				return apply_filters( 'csco_page_sidebar', get_theme_mod( $post_type . '_sidebar', 'right' ) );
			}

			return apply_filters( 'csco_page_sidebar', $sidebar );
		}

		if ( is_archive() || is_search() ) {

			return apply_filters( 'csco_page_sidebar', get_theme_mod( 'archive_sidebar', 'right' ) );
		}

		if ( is_404() ) {

			return apply_filters( 'csco_page_sidebar', 'disabled' );
		}

		return apply_filters( 'csco_page_sidebar', 'right' );
	}
}

if ( ! function_exists( 'csco_get_state_load_nextpost' ) ) {
	/**
	 * State Auto Load Next Post.
	 */
	function csco_get_state_load_nextpost() {

		if ( is_singular( array( 'post', 'page' ) ) ) {

			global $post;

			$page_load_nextpost = get_post_meta( $post->ID, 'csco_post_load_nextpost', true );

			if ( ! $page_load_nextpost || 'default' === $page_load_nextpost ) {

				$post_type = get_post_type( $post );

				return apply_filters( 'csco_post_load_nextpost', get_theme_mod( $post_type . '_load_nextpost', false ) );
			}

			$page_load_nextpost = 'enabled' === $page_load_nextpost ? true : false;

			return apply_filters( 'csco_post_load_nextpost', $page_load_nextpost );
		}

		return apply_filters( 'csco_post_load_nextpost', false );
	}
}

if ( ! function_exists( 'csco_get_filtered_posts_ids' ) ) {
	/**
	 * Get IDs of posts by filters
	 *
	 * @param string $location       Featured Location.
	 * @param int    $posts_per_page Number of post to show.
	 * @param bool   $in_category    Filter for category.
	 */
	function csco_get_filtered_posts_ids( $location = null, $posts_per_page = 3, $in_category = false ) {

		global $wp_query;

		$queried_object = $wp_query->get_queried_object();

		$args = array(
			'ignore_sticky_posts' => true,
			'order'               => 'DESC',
			'posts_per_page'      => $posts_per_page,
		);

		if ( isset( $queried_object->term_id ) && $in_category ) {
			$args['cat'] = $queried_object->term_id;
		}

		$location = $location ? sprintf( '%s', $location ) : 'featured';

		$categories = get_theme_mod( $location . '_posts_filter_categories' );

		// Filter by categories.
		if ( $categories ) {
			$categories = array_map( 'trim', explode( ',', $categories ) );
			// Category.
			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'category',
					'field'            => 'slug',
					'terms'            => $categories,
					'include_children' => true,
				),
			);
		}

		$tags = get_theme_mod( $location . '_posts_filter_tags' );

		// Filter by tags.
		if ( $tags ) {
			// Tag.
			$args['tag'] = $tags;
		}

		$posts = get_theme_mod( $location . '_posts_filter_posts' );

		// Filter by posts.
		if ( $posts ) {
			// Tag.
			$args['post__in'] = explode( ',', str_replace( ' ', '', $posts ) );
		}

		$orderby = get_theme_mod( $location . '_posts_orderby', 'date' );

		// Post order.
		if ( 'post_views' === $orderby && class_exists( 'Post_Views_Counter' ) ) {
			// Post Views.
			$args['orderby'] = 'post_views';
			// Time Frame for Post Views.
			$time_frame = get_theme_mod( $location . '_posts_time_frame' );
			if ( $time_frame ) {
				$args['date_query'] = array(
					array(
						'column' => 'post_date_gmt',
						'after'  => $time_frame . ' ago',
					),
				);
			}
		} else {
			// Date.
			$args['orderby'] = 'date';
		}

		$args = apply_filters( 'csco_' . $location . '_posts_args', $args );

		$post_ids = array();

		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$post_ids[] = get_the_ID();
			}
			wp_reset_postdata();
		}

		return apply_filters( 'csco_' . $location . '_posts_ids', $post_ids );
	}
}
