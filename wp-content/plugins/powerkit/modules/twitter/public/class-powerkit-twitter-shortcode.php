<?php
/**
 * Shortcode Twitter
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    PowerKit
 * @subpackage PowerKit/shortcodes
 */

/**
 * Twitter Shortcode
 *
 * @param array  $atts      User defined attributes in shortcode tag.
 * @param string $content   Shorcode tag content.
 * @return string           Shortcode result HTML.
 */
function powerkit_twitter_shortcode( $atts, $content = '' ) {

	$cache_timeout = (int) apply_filters( 'powerkit_twitter_cache_timeout', 60 );

	$params = powerkit_shortcode_atts( shortcode_atts( array(
		'title'               => esc_html__( 'Twitter Feed', 'powerkit' ),
		'username'            => '',
		'number'              => 5,
		'template'            => 'default',
		'header'              => true,
		'button'              => true,
		'replies'             => false,
		'retweets'            => false,
		'cache_time'          => $cache_timeout,
		'consumer_key'        => Powerkit_Connect::$twitter_consumer_key,
		'consumer_secret'     => Powerkit_Connect::$twitter_consumer_secret,
		'access_token'        => Powerkit_Connect::$twitter_access_token,
		'access_token_secret' => Powerkit_Connect::$twitter_access_token_secret,
	), $atts ) );

	$id = md5( wp_json_encode( $params ) );

	ob_start();

	// Check if transient already exists.
	$twitter = get_transient( 'powerkit_twitter_shortcode_cache_' . $id );

	if ( ! empty( $twitter ) ) {

		// Fetch twitter from the transient.
		$twitter = maybe_unserialize( $twitter );

	} else {

		// Get Twitter via Twitter OAuth.
		$twitter = powerkit_twitter_get_timeline(
			$params['consumer_key'],
			$params['consumer_secret'],
			$params['access_token'],
			$params['access_token_secret'],
			$params['cache_time'],
			array(
				'screen_name'     => $params['username'],
				'count'           => $params['number'],
				'include_rts'     => 'true' === $params['retweets'] ? 'true' : 'false',
				'exclude_replies' => 'true' === $params['replies'] ? 'false' : 'true',
			)
		);

		// Set a new transient if no errors returned.
		set_transient( 'powerkit_twitter_shortcode_cache_' . $id, maybe_serialize( $twitter ), $params['cache_time'] * 60 );
	}

	// Check if errors have been returned.
	if ( ! empty( $twitter ) && isset( $twitter['errors'] ) ) {

		powerkit_alert_warning( $twitter['errors'][0]['message'] );

	} elseif ( ! empty( $twitter ) && ! isset( $twitter['errors'] ) ) {

		// Check if there're valid twitter.
		if ( isset( $twitter ) && ! empty( $twitter ) && ! isset( $twitter['errors'] ) ) {
			powerkit_twitter_template_handler( $params['template'], $twitter, $params );
		}
	}


	return ob_get_clean();
}
add_shortcode( 'powerkit_twitter_feed', 'powerkit_twitter_shortcode' );

/**
 * Map Twitter Shortcode into the Basic Shortcodes Plugin
 */
if ( function_exists( 'powerkit_basic_shortcodes_register' ) ) :

	$shortcode_map = array(
		'name'         => 'twitter',
		'title'        => esc_html__( 'Twitter Feed', 'powerkit' ),
		'priority'     => 100,
		'base'         => 'powerkit_twitter_feed',
		'autoregister' => false,
		'fields'       => array(
			array(
				'type'  => 'input',
				'name'  => 'username',
				'label' => esc_html__( 'Twitter user ID', 'powerkit' ),
			),
			array(
				'type'    => 'input',
				'name'    => 'number',
				'label'   => esc_html__( 'Number of tweets to displays', 'powerkit' ),
				'default' => 5,
			),
			array(
				'type'    => 'checkbox',
				'name'    => 'header',
				'label'   => esc_html__( 'Display header', 'powerkit' ),
				'default' => true,
			),
			array(
				'type'    => 'checkbox',
				'name'    => 'button',
				'label'   => esc_html__( 'Display follow button', 'powerkit' ),
				'default' => true,
			),
			array(
				'type'    => 'checkbox',
				'name'    => 'replies',
				'label'   => esc_html__( 'Include replies', 'powerkit' ),
				'default' => false,
			),
			array(
				'type'    => 'checkbox',
				'name'    => 'retweets',
				'label'   => esc_html__( 'Include retweets', 'powerkit' ),
				'default' => false,
			),
		),
	);

	$templates = apply_filters( 'powerkit_twitter_templates', array() );

	if ( count( (array) $templates ) > 1 ) {
		$shortcode_map['fields'][] = array(
			'type'    => 'select',
			'name'    => 'template',
			'label'   => esc_html__( 'Template', 'powerkit' ),
			'default' => 'default',
			'options' => powerkit_twitter_get_templates_options(),
		);
	}

	powerkit_basic_shortcodes_register( $shortcode_map );

endif;
