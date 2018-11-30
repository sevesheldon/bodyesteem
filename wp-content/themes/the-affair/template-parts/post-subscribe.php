<?php
/**
 * The template part for displaying post subscribe section.
 *
 * @package The Affair
 */

?>

<?php do_action( 'csco_post_subscribe_before' ); ?>

<section class="post-subscribe">
	<?php
		$title = get_theme_mod( 'post_subscribe_title', esc_html__( 'Sign Up for Our Newsletters', 'the-affair' ) );
		$text  = get_theme_mod( 'post_subscribe_text', esc_html__( 'Get notified of the best deals on our WordPress themes.', 'the-affair' ) );
		$name  = get_theme_mod( 'post_subscribe_name', false );

		echo do_shortcode( sprintf( '[powerkit_subscription_form title="%s" text="%s" display_name="%s"]', $title, $text, $name ) );
	?>
</section>

<?php do_action( 'csco_post_subscribe_after' ); ?>
