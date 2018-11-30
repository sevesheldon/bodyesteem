<?php
/**
 * Footer template part.
 *
 * @package AMP
 */

/**
 * Context.
 *
 * @var AMP_Post_Template $this
 */
?>

<?php $scheme = csco_light_or_dark( get_theme_mod( 'color_footer_bg', '#FFFFFF' ), null, ' cs-bg-dark' ); ?>

<footer class="amp-wp-footer <?php echo esc_attr( $scheme ); ?>" style="background-color:<?php echo esc_attr( get_theme_mod( 'color_footer_bg', '#FFFFFF' ) ); ?>;">
	<div class="site-info">
		<?php
		$footer_title = get_theme_mod( 'footer_title', get_bloginfo( 'desription' ) );
		if ( $footer_title ) {
			?>
			<h5 class="site-title footer-title"><?php echo wp_kses_post( $footer_title ); ?></h5>
			<?php
		}
		?>

		<?php
		/* translators: %s: Author name. */
		$footer_text = get_theme_mod( 'footer_text', sprintf( esc_html__( 'Designed & Developed by %s', 'the-affair' ), '<a href="https://codesupply.co/">Code Supply Co.</a>' ) );
		if ( $footer_text ) {
			?>
			<div class="footer-copyright">
				<?php echo wp_kses_post( $footer_text ); ?>
			</div>
			<?php
		}
		?>
	</div><!-- .site-info -->
</footer>
