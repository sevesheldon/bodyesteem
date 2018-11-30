<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package The Affair
 */

?>

					<?php do_action( 'csco_main_content_end' ); ?>

				</div><!-- .main-content -->

				<?php do_action( 'csco_main_content_after' ); ?>

			</div><!-- .site-container -->

			<?php do_action( 'csco_site_content_end' ); ?>

		</div><!-- .site-content -->

		<?php do_action( 'csco_site_content_after' ); ?>

		<?php do_action( 'csco_footer_before' ); ?>

		<?php $scheme = csco_light_or_dark( get_theme_mod( 'color_footer_bg', '#000000' ), null, 'cs-bg-dark' ); ?>

		<footer id="colophon" class="site-footer <?php echo esc_attr( $scheme ); ?>">

			<div class="cs-container site-info">

				<?php
				$footer_title = get_theme_mod( 'footer_title', get_bloginfo( 'desription' ) );
				if ( $footer_title ) {
					?>
					<div class="site-title footer-title">
						<?php echo wp_kses_post( $footer_title ); ?>
					</div>
					<?php
				}
				?>

				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'footer',
							'menu_class'      => 'navbar-nav',
							'container'       => 'nav',
							'container_class' => 'navbar-footer',
							'depth'           => 1,
						)
					);
				}
				?>

				<?php
				/* translators: %s: Author name. */
				$footer_copyright = get_theme_mod( 'footer_copyright', sprintf( esc_html__( 'Designed & Developed by %s', 'the-affair' ), '<a href="https://codesupply.co/">Code Supply Co.</a>' ) );
				if ( $footer_copyright ) {
					?>
					<div class="footer-copyright">
						<?php echo wp_kses_post( $footer_copyright ); ?>
					</div>
					<?php
				}
				?>


				<?php
				$social_in_footer = get_theme_mod( 'footer_social_links', false );

				if ( csco_powerkit_module_enabled( 'social_links' ) && $social_in_footer ) {
					$scheme  = get_theme_mod( 'footer_social_links_scheme', 'light' );
					$maximum = get_theme_mod( 'footer_social_links_maximum', 5 );

					powerkit_social_links( false, false, true, 'inline', $scheme, 'mixed', $maximum );
				}
				?>

			</div><!-- .site-info -->

		</footer>

		<?php do_action( 'csco_footer_after' ); ?>

	</div><!-- .site-inner -->

	<?php do_action( 'csco_site_end' ); ?>

</div><!-- .site -->

<?php do_action( 'csco_site_after' ); ?>

<?php wp_footer(); ?>
</body>
</html>
