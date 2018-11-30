<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Affair
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'csco_main_before' ); ?>

		<main id="main" class="site-main">

			<?php
			if ( have_posts() ) {

				do_action( 'csco_main_start' );

				$page_layout = csco_get_page_layout();
				$sidebar     = csco_get_page_sidebar();

				$archive_layout = get_theme_mod( csco_get_archive_option( 'layout' ), 'full' );
				?>

				<div class="post-archive">

					<div class="archive-wrap">

						<div class="archive-main archive-<?php echo esc_attr( $archive_layout ); ?>">

							<?php

							// Start the Loop.
							while ( have_posts() ) {
								the_post();
								?>
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<?php
										if ( 'full' === $archive_layout ) {
											get_template_part( 'template-parts/content-cover' );
										} else {
											get_template_part( 'template-parts/content' );
										}
										?>
									</article><!-- #post-<?php the_ID(); ?> -->
								<?php
							}

							// Columns for masonry.
							if ( 'masonry' === $archive_layout ) {
								echo '<div class="archive-col archive-col-1"></div>';
								echo '<div class="archive-col archive-col-2"></div>';

								if ( ( 'boxed' === $page_layout && 'disabled' === $sidebar ) || ( 'fullwidth' === $page_layout ) ) {
									echo '<div class="archive-col archive-col-3"></div>';
								}
							}
							?>
						</div>

					</div>

					<?php
					/* Posts Pagination */
					if ( 'standard' === get_theme_mod( csco_get_archive_option( 'pagination_type' ), 'standard' ) ) {
						the_posts_pagination(
							array(
								'prev_text' => esc_html__( 'Previous', 'the-affair' ),
								'next_text' => esc_html__( 'Next', 'the-affair' ),
							)
						);
					}
					?>

				</div>

			<?php
			do_action( 'csco_main_end' );

			} else {
				?>
					<div class="post-wrap">

						<?php do_action( 'csco_main_start' ); ?>

						<div class="post-container">
							<div class="content entry-content">
								<p class="cs-alert"><?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'the-affair' ); ?></p>
								<?php get_search_form(); ?>
							</div>
						</div>

						<?php do_action( 'csco_main_end' ); ?>

					</div>

				<?php
			}
			?>

		</main>

		<?php do_action( 'csco_main_after' ); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
