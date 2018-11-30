<?php
/**
 * The template part for displaying related posts.
 *
 * @package The Affair
 */

$args = array(
	'query_type'          => 'related',
	'orderby'             => 'rand',
	'ignore_sticky_posts' => true,
	'post__not_in'        => array( $post->ID ),
	'category__in'        => wp_get_post_categories( $post->ID ),
	'posts_per_page'      => get_theme_mod( 'post_related_number', 6 ),
);

// Order by post views.
if ( class_exists( 'Post_Views_Counter' ) ) {
	$args['orderby'] = 'post_views';
}

// Time Frame.
$time_frame = get_theme_mod( 'post_related_time_frame' );
if ( $time_frame ) {
	$args['date_query'] = array(
		array(
			'column' => 'post_date_gmt',
			'after'  => $time_frame . ' ago',
		),
	);
}

// WP Query.
$related = new WP_Query( apply_filters( 'csco_related_posts_args', $args ) );

// Columns.
$columns      = 2;
$columns_xl   = 2;
$columns_full = 2;

if ( 'fullwidth' === csco_get_page_layout() ) {
	if ( 'disabled' === csco_get_page_sidebar() ) {
		$columns_xl   = 3;
		$columns_full = 3;
	} else {
		$columns_full = 3;
	}
}

if ( $related->have_posts() && isset( $related->posts ) ) {
	?>
	<section class="post-archive archive-related">
		<div class="archive-related-wrap">
			<div class="archive-related-header">
				<h5 class="title-trending"><?php echo esc_html( get_theme_mod( 'post_related_title', 'You May also Like' ) ); ?></h5>
			</div>
			<div class="archive-related-container cs-merge-init">
				<div class="cs-merge-carousel"
				data-columns="<?php echo esc_attr( $columns ); ?>"
				data-xl-columns="<?php echo esc_attr( $columns_xl ); ?>"
				data-full-columns="<?php echo esc_attr( $columns_full ); ?>">
					<?php
					while ( $related->have_posts() ) :
						$related->the_post();

						// Get attachment data.
						$attachment_data = csco_attachment_orientation_data( get_post_thumbnail_id(), false );

						$merge = 'portrait' === $attachment_data['orientation'] ? 1 : 2;

						if ( 'fullwidth' === csco_get_page_layout() ) {
							$attachment_data['size'] = str_replace( array( 'cs-thumbnail', 'cs-large' ), 'cs-medium', $attachment_data['size'] );
						}
						?>
						<div class="archive-related-post owl-slide" data-merge="<?php echo esc_attr( $merge ); ?>">
							<article <?php post_class(); ?>>
								<div class="cs-overlay cs-overlay-ratio cs-bg-dark">
									<div class="cs-overlay-background">
										<?php the_post_thumbnail( $attachment_data['size'] ); ?>
									</div>
									<div class="cs-overlay-content">
										<?php csco_the_post_format_icon(); ?>
										<?php csco_get_post_meta( 'category', false, false, true, 'post_meta' ); ?>
										<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
										<?php csco_get_post_meta( array( 'shares', 'views', 'author', 'date', 'comments', 'reading_time' ), false, true, true, 'post_meta' ); ?>
									</div>
									<a href="<?php the_permalink(); ?>" class="cs-overlay-link"></a>
								</div>
							</article>
						</div>
						<?php
					endwhile;
					?>
				</div>
				<div class="owl-nav"></div>
				<div class="owl-dots"></div>
			</div>
		</div>
	</section>

	<?php wp_reset_postdata(); ?>

<?php
}
