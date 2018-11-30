<?php
/**
 * Helpers Facebook
 *
 * @package    Powerkit
 * @subpackage Modules/Helper
 */

/**
 * Get locale in uniform format.
 */
function powerkit_facebook_get_locale() {

	$locale = get_locale();

	if ( preg_match( '#^[a-z]{2}\-[A-Z]{2}$#', $locale ) ) {
		$locale = str_replace( '-', '_', $locale );
	} elseif ( preg_match( '#^[a-z]{2}$#', $locale ) ) {
		$locale .= '_' . mb_strtoupper( $locale, 'UTF-8' );
	}

	if ( empty( $locale ) ) {
		$locale = 'en_US';
	}

	return apply_filters( 'powerkit_facebook_locale', $locale );
}

/**
 * Facebook load sdk.
 */
function powerkit_facebook_load_sdk() {
	?>
		<div id="fb-root"></div>
		<script>( function( d, s, id ) {
			var js, fjs = d.getElementsByTagName( s )[0];
			if ( d.getElementById( id ) ) return;
			js = d.createElement( s ); js.id = id;
			js.src = "//connect.facebook.net/<?php echo esc_html( powerkit_facebook_get_locale() ); ?>/sdk.js#xfbml=1&version=v2.5&appId=<?php echo esc_html( Powerkit_Connect::$facebook_app_id ); ?>";
			fjs.parentNode.insertBefore( js, fjs );
		}( document, 'script', 'facebook-jssdk' ) );</script>
	<?php
}
