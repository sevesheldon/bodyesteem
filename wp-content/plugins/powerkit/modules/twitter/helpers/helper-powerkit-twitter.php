<?php
/**
 * Helpers Twitter
 *
 * @package    Powerkit
 * @subpackage Modules/Helper
 */

/**
 * Convert links to clickable format
 *
 * @param string $name Specific template.
 * @param array  $twitter Array of twitter.
 * @param array  $params Array of params.
 */
function powerkit_twitter_template_handler( $name, $twitter, $params ) {
	$templates = apply_filters( 'powerkit_twitter_templates', array() );

	$new = isset( $templates['default'] ) ? false : true;

	if ( $new && count( $templates ) > 0 ) {
		$first_item = array_shift( $templates );

		if ( function_exists( $first_item['func'] ) ) {
			call_user_func( $first_item['func'], $twitter, $params );
		} else {
			call_user_func( 'powerkit_twitter_default_template', $twitter, $params );
		}
	} elseif ( isset( $templates[ $name ] ) && function_exists( $templates[ $name ]['func'] ) ) {
		call_user_func( $templates[ $name ]['func'], $twitter, $params );
	} else {
		call_user_func( 'powerkit_twitter_default_template', $twitter, $params );
	}
}

/**
 * Get templates options
 *
 * @return array Items.
 */
function powerkit_twitter_get_templates_options() {
	$options = array();

	$templates = apply_filters( 'powerkit_twitter_templates', array() );

	if ( $templates ) {
		foreach ( $templates as $key => $item ) {
			if ( isset( $item['name'] ) ) {
				$options[ $key ] = $item['name'];
			}
		}
	}

	return $options;
}

/**
 * Convert links to clickable format
 *
 * @param string $links       Text with links.
 * @param bool   $targetblank Open links in a new tab.
 * @return string Text with replaced links.
 */
function powerkit_twitter_convert_links( $links, $targetblank = true ) {

	// The target.
	$target = $targetblank ? ' target="_blank" ' : '';

	// Convert link to url.
	$links = preg_replace( '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i', '<a href="\0" target="_blank">\0</a>', $links );

	// Convert @ to follow.
	$links = preg_replace( '/(@([_a-z0-9\-]+))/i', '<a href="http://twitter.com/$2" title="Follow $2" $target >$1</a>', $links );

	// Convert # to search.
	$links = preg_replace( '/(#([_a-z0-9\-]+))/i', '<a href="https://twitter.com/search?q=$2" title="Search $1" $target >$1</a>', $links );

	// Return links.
	return $links;
}

/**
 * Get timeline twitter
 *
 * @param string $consumer_key        Twitter consumer key.
 * @param string $consumer_secret     Twitter consumer secret.
 * @param string $access_token        Twitter access token.
 * @param string $access_token_secret Twitter access token secret.
 * @param array  $cache_time          Cache time.
 * @param array  $options             Timeline options.
 */
function powerkit_twitter_get_timeline( $consumer_key, $consumer_secret, $access_token, $access_token_secret, $cache_time, $options ) {
	if ( ! empty( $consumer_key ) && ! empty( $consumer_secret ) && ! empty( $access_token ) && ! empty( $access_token_secret ) ) {

		/* Get Token */
		$token = get_transient( 'powerkit_twitter_twitter_token' );

		if ( ! $token || ! $cache_time ) {
			$credentials = $consumer_key . ':' . $consumer_secret;
			$to_send = base64_encode( $credentials );

			$args = array(
				'method' => 'POST',
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'Authorization' => 'Basic ' . $to_send,
					'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
				),
				'body' => array(
					'grant_type' => 'client_credentials',
				),
			);

			add_filter( 'https_ssl_verify', '__return_false' );
			$response = wp_remote_post( esc_url( 'https://api.twitter.com/oauth2/token', null, '' ), $args );

			$keys = json_decode( wp_remote_retrieve_body( $response ) );

			$token = isset( $keys->access_token ) ? $keys->access_token : null;

			set_transient( 'powerkit_twitter_twitter_token', $token, 360 );
		}

		/* Get Data */
		$args = array(
			'httpversion' => '1.1',
			'blocking' => true,
			'headers' => array(
				'Authorization' => "Bearer $token",
			),
		);
		add_filter( 'https_ssl_verify', '__return_false' );

		$json_url = add_query_arg( $options, 'https://api.twitter.com/1.1/statuses/user_timeline.json' );

		$response = wp_remote_get( $json_url, $args );

		remove_filter( 'https_ssl_verify', '__return_false' );

		/* Set Data Followers */
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			$twitter = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( ! isset( $twitter['errors'] ) ) {

				$twitter = array();

				$twitter['errors'][0]['message'] = 'Not available!';
			}
		} else {
			$twitter = json_decode( wp_remote_retrieve_body( $response ) );
		}

		return $twitter;
	}
}
