<?php
/**
 * Powerkit Filters
 *
 * @package The Affair
 */

/**
 * Register Post Archive Share Buttons Location
 *
 * @param array $locations List of Locations.
 */
function csco_share_buttons_post_meta( $locations = array() ) {

	$locations['post_meta'] = array(
		'shares'         => array( 'facebook', 'twitter', 'pinterest' ),
		'name'           => esc_html__( 'Post Meta', 'the-affair' ),
		'location'       => 'post_meta',
		'mode'           => 'cached',
		'before'         => '',
		'after'          => '',
		'display'        => true,
		'meta'           => array(
			'icons'  => true,
			'titles' => false,
			'labels' => false,
		),
		// Display only the specified layouts and color schemes.
		'fields'         => array(
			'layouts'         => array( 'simple' ),
			'schemes'         => array( 'default', 'bold' ),
			'count_locations' => array( 'inside' ),
		),
		'display_total'  => false,
		'layout'         => 'simple',
		'scheme'         => 'bold',
		'count_location' => 'inside',
	);

	return $locations;
}
add_filter( 'powerkit_share_buttons_locations', 'csco_share_buttons_post_meta' );

/**
 * Dequeue Powerkit Styles
 *
 * @param array $locations List of Locations.
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'powerkit-slider-gallery' );
	wp_dequeue_script( 'powerkit-slider-gallery' );
} );

/**
 * PinIt add selectors
 *
 * @param string $selectors List selectors.
 */
function powerkit_pinit_add_selectors( $selectors ) {
	$selectors[] = '.single .cover-gallery img';
	$selectors[] = '.single .cover-thumbnail img';

	return $selectors;
}
add_filter( 'powerkit_pinit_image_selectors', 'powerkit_pinit_add_selectors' );

/**
 * Register Floated Share Buttons Location
 *
 * @param  array $locations List of Locations.
 */
function csco_share_buttons_post_sidebar( $locations = array() ) {

	$locations['post_sidebar'] = array(
		'shares'         => array( 'facebook', 'twitter', 'pinterest', 'mail' ),
		'name'           => esc_html__( 'Entry Sidebar', 'the-affair' ),
		'location'       => 'post_sidebar',
		'mode'           => 'mixed',
		'before'         => '',
		'after'          => '',
		'display'        => true,
		'meta'           => array(
			'icons'  => true,
			'titles' => false,
			'labels' => false,
		),
		// Display only the specified layouts and color schemes.
		'fields'         => array(
			'display_total'   => true,
			'display_count'   => true,
			'layouts'         => array(),
			'schemes'         => array( 'default', 'bold', 'bold-bg' ),
			'count_locations' => array( 'inside' ),
		),
		'layout'         => 'simple',
		'scheme'         => 'default',
		'count_location' => 'inside',
	);

	unset( $locations['before-content'] );

	return $locations;
}
add_filter( 'powerkit_share_buttons_locations', 'csco_share_buttons_post_sidebar' );

/**
 * Register Floated Share Buttons Location
 */
function csco_powerkit_widget_author_image_size() {
	return 'cs-thumbnail';
}
add_filter( 'powerkit_widget_author_image_size', 'csco_powerkit_widget_author_image_size' );

/**
 * Change Contributors widget post author description length.
 */
function csco_powerkit_widget_contributors_description_length() {
	return 80;
}
add_filter( 'powerkit_widget_contributors_description_length', 'csco_powerkit_widget_contributors_description_length' );

/**
 * Add Carousel Template for featured posts
 *
 * @param array $templates The templates.
 */
function csco_powerkit_featured_posts_carousel( $templates = array() ) {
	$templates['carousel'] = array(
		'name' => esc_html__( 'Carousel', 'the-affair' ),
		'func' => 'csco_powerkit_carousel_template',
	);
	return $templates;
}
add_filter( 'powerkit_featured_posts_templates', 'csco_powerkit_featured_posts_carousel' );

/**
 * Exclude Inline Posts posts from related posts block
 *
 * @param array $args Array of WP_Query args.
 */
function csco_related_posts_args( $args ) {
	global $powerkit_inline_posts;
	if ( ! $powerkit_inline_posts ) {
		return $args;
	}
	$post__not_in         = $args['post__not_in'];
	$post__not_in         = array_unique( array_merge( $post__not_in, $powerkit_inline_posts ) );
	$args['post__not_in'] = $post__not_in;
	return $args;
}

add_filter( 'csco_related_posts_args', 'csco_related_posts_args' );

/**
 * Carousel Template Callback
 *
 * @param  array $posts    Array of posts.
 * @param  array $params   Array of params.
 * @param  array $instance Widget instance.
 */
function csco_powerkit_carousel_template( $posts, $params, $instance ) {
	?>
	<article <?php post_class(); ?>>
		<div class="cs-overlay cs-overlay-ratio cs-bg-dark cs-ratio-portrait">

			<div class="cs-overlay-background">
				<?php the_post_thumbnail( 'cs-thumbnail-portrait' ); ?>
			</div>
			<div class="cs-overlay-content">
				<?php if ( 'numbered' === $params['template'] ) : ?>
					<span class="pk-post-number">
						<?php echo esc_html( $posts->current_post + 1 ); ?>
					</span>
				<?php endif; ?>

				<?php
				if ( function_exists( 'csco_get_post_meta' ) && $params['post_meta_category'] ) {
					csco_get_post_meta( 'category' );
				}

				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );

				if ( function_exists( 'csco_get_post_meta' ) ) {
					csco_get_post_meta( $params['post_meta'], (bool) $params['post_meta_compact'], true );
				}
				?>

				<div class="entry-more-button">
					<a class="button" href="<?php echo esc_url( get_permalink() ); ?>">
						<?php esc_html_e( 'View Post', 'the-affair' ); ?>
					</a>
				</div>
			</div>
			<a href="<?php the_permalink(); ?>" class="cs-overlay-link"></a>
		</div>
	</article>
<?php
}
