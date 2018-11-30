<?php
/**
 * Get Share Buttons Counter
 *
 * @package    Powerkit
 * @subpackage Modules/Helper
 */

/**
 * Add Facebook Counter.
 *
 * @param array      $account Account name.
 * @param int|string $post_id Post ID.
 * @param string     $url     Custom URL.
 * @param bool       $suffix  Unique suffix.
 */
function powerkit_share_buttons_facebook_counter( $account, $post_id, $url = null, $suffix = false ) {

	// Get Post ID.
	$post_id = $post_id ? $post_id : powerkit_share_buttons_get_current_post_id( $url );

	// Get Chache.
	$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, false, $suffix );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Counter.
	$endpoint = esc_url( 'https://graph.facebook.com/?id=' . $url, null, '' );
	$response = wp_remote_get( $endpoint, array(
		'timeout' => 3,
	) );

	$response = wp_remote_retrieve_body( $response );

	// Create Counter.
	$response_result = json_decode( $response, true );

	if ( isset( $response_result['share']['share_count'] ) ) {
		$count = $response_result['share']['share_count'];
	} else {
		$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, true, $suffix );
	}

	// Set Cache.
	powerkit_share_buttons_set_cache_account( $account, $post_id, intval( $count ), $url, $suffix );

	// Return Result.
	return $count;
}

/**
 * Add Google Counter.
 *
 * @param array      $account Account name.
 * @param int|string $post_id Post ID.
 * @param string     $url     Custom URL.
 * @param bool       $suffix  Unique suffix.
 */
function powerkit_share_buttons_google_counter( $account, $post_id, $url = null, $suffix = false ) {

	// Get Post ID.
	$post_id = $post_id ? $post_id : powerkit_share_buttons_get_current_post_id( $url );

	// Get Chache.
	$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, false, $suffix );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Count.
	$args     = array(
		'method'   => 'POST',
		'timeout'  => 3,
		'blocking' => true,
		'headers'  => array(
			'Content-Type' => 'application/json',
		),
		'body'     => '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]',
	);
	$response = wp_remote_post( esc_url( 'https://clients6.google.com/rpc', null, '' ), $args );
	$response = wp_remote_retrieve_body( $response );

	// Set Count.
	$response_result = json_decode( $response, true );
	if ( isset( $response_result[0]['result']['metadata']['globalCounts']['count'] ) ) {
		$count = $response_result[0]['result']['metadata']['globalCounts']['count'];
	} else {
		$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, true, $suffix );
	}

	// Set Cache.
	powerkit_share_buttons_set_cache_account( $account, $post_id, intval( $count ), $url, $suffix );

	// Return Result.
	return $count;
}

/**
 * Add LinkedIn Counter.
 *
 * @param array      $account Account name.
 * @param int|string $post_id Post ID.
 * @param string     $url     Custom URL.
 * @param bool       $suffix  Unique suffix.
 */
function powerkit_share_buttons_linkedin_counter( $account, $post_id, $url = null, $suffix = false ) {

	// Get Post ID.
	$post_id = $post_id ? $post_id : powerkit_share_buttons_get_current_post_id( $url );

	// Get Chache.
	$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, false, $suffix );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Count.
	$endpoint = esc_url( 'https://www.linkedin.com/countserv/count/share?format=json&url=' . $url, null, '' );
	$response = wp_remote_get( $endpoint, array(
		'timeout' => 3,
	) );
	$response = wp_remote_retrieve_body( $response );

	// Set Count.
	$response_result = json_decode( $response, true );

	if ( isset( $response_result['count'] ) ) {
		$count = $response_result['count'];
	} else {
		$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, true, $suffix );
	}

	// Set Cache.
	powerkit_share_buttons_set_cache_account( $account, $post_id, intval( $count ), $url, $suffix );

	// Return Result.
	return $count;
}

/**
 * Add Pinterest Counter.
 *
 * @param array      $account Account name.
 * @param int|string $post_id Post ID.
 * @param string     $url     Custom URL.
 * @param bool       $suffix  Unique suffix.
 */
function powerkit_share_buttons_pinterest_counter( $account, $post_id, $url = null, $suffix = false ) {

	// Get Post ID.
	$post_id = $post_id ? $post_id : powerkit_share_buttons_get_current_post_id( $url );

	// Get Chache.
	$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, false, $suffix );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Count.
	$endpoint = esc_url( 'https://widgets.pinterest.com/v1/urls/count.json?callback=jsonp&url=' . $url, null, '' );
	$response = wp_remote_get( $endpoint, array(
		'timeout' => 3,
	) );
	$response = wp_remote_retrieve_body( $response );

	// Set Count.
	$response_body   = str_replace( array( 'jsonp(', ')' ), '', $response );
	$response_result = json_decode( $response_body, true );

	if ( isset( $response_result['count'] ) ) {
		$count = $response_result['count'];
	} else {
		$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, true, $suffix );
	}

	// Set Cache.
	powerkit_share_buttons_set_cache_account( $account, $post_id, intval( $count ), $url, $suffix );

	// Return Result.
	return $count;
}

/**
 * Add Vkontakte Counter.
 *
 * @param array      $account Account name.
 * @param int|string $post_id Post ID.
 * @param string     $url     Custom URL.
 * @param bool       $suffix  Unique suffix.
 */
function powerkit_share_buttons_vkontakte_counter( $account, $post_id, $url = null, $suffix = false ) {

	// Get Post ID.
	$post_id = $post_id ? $post_id : powerkit_share_buttons_get_current_post_id( $url );

	// Get Chache.
	$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, false, $suffix );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Count.
	$endpoint = esc_url( 'https://vk.com/share.php?act=count&index=1&url=' . $url, null, '' );
	$response = wp_remote_get( $endpoint, array(
		'timeout' => 3,
	) );
	$response = wp_remote_retrieve_body( $response );

	// Set Count.
	preg_match( '/^VK.Share.count\(1, (\d+)\);$/i', $response, $response_result );

	if ( isset( $response_result[1] ) ) {
		$count = $response_result[1];
	} else {
		$count = powerkit_share_buttons_get_cached_account( $account, $post_id, $url, true, $suffix );
	}

	// Set Cache.
	powerkit_share_buttons_set_cache_account( $account, $post_id, intval( $count ), $url, $suffix );

	// Return Result.
	return $count;
}
