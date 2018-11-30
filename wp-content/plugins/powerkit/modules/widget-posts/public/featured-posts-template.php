<?php
/**
 * Posts Template
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    PowerKit
 * @subpackage PowerKit/templates
 */

/**
 * Default Template
 *
 * @param array $posts    Array of posts.
 * @param array $params   Array of params.
 * @param array $instance Widget instance.
 */
function powerkit_featured_posts_default_template( $posts, $params, $instance ) {
	?>
	<article <?php post_class(); ?>>
		<div class="pk-post-outer">
			<?php
				$thumbnail_size = ( 'large' === $params['template'] ) ? 'pk-thumbnail' : 'pk-small';

				$thumbnail_size = apply_filters( 'powerkit_widget_featured_posts_size', $thumbnail_size, $params, $instance );
			?>
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="pk-post-inner pk-post-thumbnail">
					<a href="<?php the_permalink(); ?>" class="post-thumbnail">
						<?php the_post_thumbnail( $thumbnail_size ); ?>

						<?php if ( 'numbered' === $params['template'] ) : ?>
							<span class="pk-post-number pk-bg-primary">
								<?php echo esc_html( $posts->current_post + 1 ); ?>
							</span>
						<?php endif; ?>
					</a>
				</div>
			<?php } ?>

			<div class="pk-post-inner pk-post-data">
				<?php
				if ( function_exists( 'csco_get_post_meta' ) && $params['post_meta_category'] ) {
					csco_get_post_meta( 'category' );
				}
				?>
				<?php
				$tag = ( 'large' === $params['template'] ) ? 'h5' : 'h6';

				$tag = apply_filters( 'powerkit_widget_featured_posts_title_tag', $tag, $params, $instance );
				?>

				<<?php echo esc_html( $tag ); ?> class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</<?php echo esc_html( $tag ); ?>>

				<?php
				if ( function_exists( 'csco_get_post_meta' ) ) {
					csco_get_post_meta( $params['post_meta'], (bool) $params['post_meta_compact'] );
				} elseif ( $params['post_meta_data'] ) {
					?>
						<div class="pk-post-meta">
							<?php echo powerkit_get_meta_date(); // XSS. ?>
							<span class="sep">·</span>
							<?php echo powerkit_get_meta_author(); // XSS. ?>
						</div>
					<?php
				} else {
					?>
						<div class="pk-post-meta pk-post-meta-hide">
							<?php echo powerkit_get_meta_date(); // XSS. ?>
							<?php echo powerkit_get_meta_author(); // XSS. ?>
						</div>
					<?php
				}
				?>
			</div>
		</div>
	</article>
	<?php
}
