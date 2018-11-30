<?php
/**
 * The template for displaying all single pages.
 *
 * @package The Affair
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'csco_main_before' ); ?>

		<main id="main" class="site-main">

			<?php do_action( 'csco_main_start' ); ?>

			<div class="post-wrap">

				<?php do_action( 'csco_page_wrap_start' ); ?>

				<div class="post-container">

					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<?php do_action( 'csco_page_before' ); ?>

							<article id="post-<?php the_ID(); ?>">

								<?php do_action( 'csco_page_content_before' ); ?>


								<div class="entry-content">

									<?php do_action( 'csco_page_entry_content_start' ); ?>

									<div class="content">
										<?php do_action( 'csco_page_content_start' ); ?>

										<?php the_content(); ?>

										<?php do_action( 'csco_page_content_end' ); ?>
									</div>

									<?php do_action( 'csco_page_entry_content_end' ); ?>

								</div>

								<?php do_action( 'csco_page_content_after' ); ?>

							</article>

						<?php do_action( 'csco_page_after' ); ?>

					<?php endwhile; ?>

				</div>

				<?php do_action( 'csco_page_wrap_end' ); ?>

			</div>

			<?php do_action( 'csco_main_end' ); ?>

		</main>

		<?php do_action( 'csco_main_after' ); ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
