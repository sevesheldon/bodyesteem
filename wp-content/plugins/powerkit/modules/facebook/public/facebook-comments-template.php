<?php
/**
 * Facebook Comments Template
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    PowerKit
 * @subpackage PowerKit/templates
 */

?>

<?php
if ( Powerkit_Connect::$facebook_app_id ) {
	?>
		<div class="fb-comments" data-width="100%" data-href="<?php the_permalink(); ?>" data-numposts="<?php get_option( 'powerkit_facebook_number_comments', 10 ); ?>"></div>
	<?php
} else {
	/* translators: Facebook API Link. */
	powerkit_alert_warning( __( 'Warning: Facebook ID not specified!', 'powerkit' ) );
}
