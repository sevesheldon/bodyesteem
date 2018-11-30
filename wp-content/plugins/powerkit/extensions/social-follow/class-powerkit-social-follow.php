<?php
/**
 * Social Follow
 *
 * @package    Powerkit
 * @subpackage Extensions
 */

/**
 * Init module
 */
class Powerkit_Social_Follow extends Powerkit_Module {

	/**
	 * Register module
	 */
	public function register() {
		$this->name     = 'Social Follow';
		$this->slug     = 'social_follow';
		$this->type     = 'extension';
		$this->category = 'basic';
		$this->public   = false;
		$this->enabled  = true;
	}

	/**
	 * Api Keys
	 *
	 * @since 1.0.0
	 * @var   array $api_keys    List of api keys.
	 */
	public $api_keys = array();

	/**
	 * Transient Prefix
	 *
	 * @since 1.0.0
	 * @var   string $cache_timeout    Cache Timeout (minutes).
	 */
	private $trans_prefix = 'powerkit_social_follow';

	/**
	 * Cache Results
	 *
	 * @since 1.0.0
	 * @var   int $cache_timeout    Cache Timeout (minutes).
	 */
	public $cache_timeout = 720;

	/**
	 * Initialize module
	 */
	public function initialize() {
		// New Connect.
		$connect = new Powerkit_Connect();

		// Init Config.
		$connect->connect_keys();

		// Keys.
		$this->api_keys = array(
			'youtube_key'     => $connect::$youtube_key,
			'facebook_app_id' => $connect::$facebook_app_id,
		);

		// Reset cache.
		add_action( 'powerkit_ajax_reset_cache', array( $this, 'ajax_reset_cache' ) );
	}

	/**
	 * Register Reset Cache
	 *
	 * @since    1.0.0
	 * @param    array $list Change list reset cache.
	 * @access   private
	 */
	public function ajax_reset_cache( $list ) {
		$slug = powerkit_get_page_slug( $this->slug );

		$list[ $slug ] = 'powerkit_social_follow';
		$list[ $slug ] = 'powerkit_data_instagram';

		return $list;
	}

	/**
	 * Curl request data
	 *
	 * @since 1.0.0
	 * @param array $args   Api params.
	 */
	public function curl_get_api( $args ) {
		$cache_name = $this->trans_prefix . '_' . $args['network'];

		// Custom trans prefix.
		if ( isset( $args['trans_prefix'] ) ) {
			$cache_name = $args['trans_prefix'];
		}

		// Cache timeout.
		$social_request = get_transient( $cache_name );

		if ( ! $social_request ) {

			// Generate Url.
			$params     = http_build_query( $args['params'] );
			$remote_url = $params ? $args['url'] . '?' . $params : $args['url'];

			// Request_params.
			$request_params = array(
				'timeout'    => 10,
				'user-agent' => $this->get_random_user_agent(),
				'headers'    => array(
					'Accept-language' => 'en',
				),
			);

			$social_request = wp_safe_remote_get( $remote_url, $request_params );

			set_transient( $cache_name, $social_request, 60 * $this->cache_timeout );
		}

		if ( is_wp_error( $social_request ) ) {
			return false;
		}

		// Retrieve data.
		$data = wp_remote_retrieve_body( $social_request );

		// JSON Decode.
		if ( $args['decode'] ) {
			$data = json_decode( $data );
		}

		return $data;
	}

	/**
	 * Get random user agent
	 *
	 * @since 1.0.0
	 */
	public function get_random_user_agent() {
		$user_agents = array(
			'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
			'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
			'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
			'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246',
		);

		$random = rand( 0, count( $user_agents ) - 1 );

		return $user_agents[ $random ];
	}

	/**
	 * Parse all characters in a string and retrieve only the numeric ones.
	 *
	 * @param string $td_string The string.
	 */
	private function extract_numbers_from_string( $td_string ) {
		$buffy     = null;
		$td_string = preg_split( '//u', $td_string, -1, PREG_SPLIT_NO_EMPTY );

		foreach ( $td_string as $td_char ) {
			if ( is_numeric( $td_char ) ) {
				$buffy .= $td_char;
			}
		}
		return $buffy;
	}

	/**
	 * Count format
	 *
	 * @param int $value  Count number.
	 */
	public function count_format( $value = 0 ) {
		$result = '';
		$value  = (int) $value;

		$count_format = apply_filters( 'powerkit_social_follow_count_format', true );

		if ( $count_format ) {
			if ( $value > 999 && $value <= 999999 ) {
				$result = round( $value / 1000 ) . esc_html( 'K', 'powerkit' );
			} elseif ( $value > 999999 ) {
				$result = number_format( $value / 1000000, 1, '.', '' ) . esc_html( 'M', 'powerkit' );

				$result = str_replace( '.0', '', $result );
			} else {
				$result = $value;
			}
		} else {
			$result = $value;
		}

		return $result;
	}

	/**
	 * Return social follow
	 *
	 * @param string $name     Name of social network.
	 * @param string $username Username of social network.
	 * @param string $type     Type of social network.
	 */
	public function get_data( $name, $username, $type = null ) {
		$social_function = sprintf( 'get_%s', $name );

		if ( ! $username ) {
			return;
		}

		$this->trans_prefix .= sprintf( '%s_%s', $this->trans_prefix, md5( $username ) );

		if ( method_exists( $this, $social_function ) ) {
			return $this->$social_function( $username, $type );
		}
	}

	/**
	 * Get youtube data.
	 *
	 * @param string $username Username of social network.
	 * @param string $type     Type of social network.
	 */
	public function get_youtube( $username, $type = null ) {

		$result = array();

		$network = 'youtube';

		// Check token.
		if ( ! $this->api_keys['youtube_key'] ) {
			return;
		}

		// Generate Params.
		switch ( $type ) {
			case 'channel':
				$params = array(
					'part' => 'snippet,contentDetails,statistics',
					'id'   => $username,
					'key'  => $this->api_keys['youtube_key'],
				);
				break;

			// User.
			default:
				$params = array(
					'part'        => 'snippet,contentDetails,statistics',
					'forUsername' => $username,
					'key'         => $this->api_keys['youtube_key'],
				);
				break;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'url'     => 'https://www.googleapis.com/youtube/v3/channels/',
			'network' => $network,
			'params'  => $params,
			'decode'  => true,
		));

		// Set Count.
		if ( isset( $data->error->message ) ) {

			// API Error.
			$result['error'] = $data->error->message;

		} elseif ( isset( $data->items[0]->statistics->subscriberCount ) ) {

			// Live Count.
			$result['followers'] = $this->count_format( $data->items[0]->statistics->subscriberCount );

		} elseif ( isset( $data->items ) && empty( $data->items ) ) {

			// API Error 2.
			$result['error'] = esc_html( 'Please check your channel.', 'powerkit' );
		}

		if ( isset( $result['error'] ) ) {
			powerkit_alert_warning( $result['error'] );
		}

		// Link.
		if ( 'channel' === $type ) {
			$result['link'] = sprintf( 'https://www.youtube.com/channel/%s/', $username );
		} else {
			$result['link'] = sprintf( 'https://www.youtube.com/user/%s/', $username );
		}

		// Avatar.
		if ( isset( $data->items[0]->snippet->thumbnails->default->url ) ) {
			$result['avatar_1x'] = $data->items[0]->snippet->thumbnails->default->url;
		}
		if ( isset( $data->items[0]->snippet->thumbnails->medium->url ) ) {
			$result['avatar_2x'] = $data->items[0]->snippet->thumbnails->medium->url;
		}

		// Username.
		if ( isset( $data->items[0]->snippet->title ) ) {
			$result['text'] = $data->items[0]->snippet->title;
		}

		return $result;
	}

	/**
	 * Get facebook data.
	 *
	 * @param string $username Username of social network.
	 * @param string $type     Type of social network.
	 */
	public function get_facebook( $username, $type = null ) {

		$result = array();

		$network = 'facebook';

		// Check token.
		if ( ! $this->api_keys['facebook_app_id'] ) {
			return $result;
		}

		$url = add_query_arg( array(
			'href'                  => rawurlencode( 'https://www.facebook.com/' . $username ),
			'domain'                => rawurlencode( home_url() ),
			'origin'                => rawurlencode( home_url() ),
			'adapt_container_width' => 'true',
			'relation'              => 'parent.parent',
			'container_width'       => '300',
			'hide_cover'            => 'false',
			'locale'                => 'en_US',
			'sdk'                   => 'joey',
			'show_facepile'         => 'false',
			'show_posts'            => 'false',
			'small_header'          => 'false',
			'width'                 => '500px',
			'app_id'                => $this->api_keys['facebook_app_id'],
		), 'https://www.facebook.com/v2.5/plugins/page.php' );

		// Get Count.
		$data = $this->curl_get_api( array(
			'url'     => $url,
			'network' => $network,
			'params'  => array(),
			'decode'  => false,
		));
		// Set Count.
		$facebook_result = preg_match( '/<div[^>]*?>(.*?)likes/s', $data, $facebook_data );

		if ( $facebook_result ) {
			$facebook_data_full = array_shift( $facebook_data );
			$facebook_data_json = array_shift( $facebook_data );

			// Live Count.
			$result['followers'] = $this->count_format( (int) $this->extract_numbers_from_string( strip_tags( $facebook_data_json ) ) );
		} else {
			$result['error'] = esc_html__( 'Data not found. Please check your user ID.', 'powerkit' );
		}

		if ( isset( $result['error'] ) ) {
			powerkit_alert_warning( $result['error'] );
		}

		// Link.
		$result['link'] = sprintf( 'https://facebook.com/%s/', $username );

		// Avatar.
		$result['avatar_1x'] = "https://graph.facebook.com/{$username}/picture?width=80&height=80";
		$result['avatar_2x'] = "https://graph.facebook.com/{$username}/picture?width=160&height=160";

		// Username.
		$result['text'] = $username;

		return $result;
	}

	/**
	 * Get instagram data.
	 *
	 * @param string $username Username of social network.
	 * @param string $type     Type of social network.
	 */
	public function get_instagram( $username, $type = null ) {

		$result = array();

		$network = 'instagram';

		// Get Count.
		$data = $this->curl_get_api( array(
			'url'          => 'https://www.instagram.com/' . $username,
			'trans_prefix' => 'powerkit_data_instagram_' . md5( $username ),
			'network'      => $network,
			'params'       => array(),
			'decode'       => false,
		) );

		// Get the serialized data string present in the page script.
		preg_match( '/window\._sharedData = (.*);<\/script>/', $data, $ins_data );

		$ins_data_full = array_shift( $ins_data );
		$ins_data_json = array_shift( $ins_data );

		if ( $ins_data_json ) {
			$instagram_json = json_decode( $ins_data_json, true );

			// Live Count.
			if ( ! empty( $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'] ) ) {
				$result['followers'] = $this->count_format( (int) $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'] );
			} else {
				$result['error'] = esc_html__( 'Data not found. Please check your user ID.', 'powerkit' );
			}
		} else {
			$result['error'] = esc_html__( 'Data not found. Please check your user ID.', 'powerkit' );
		}

		// Link.
		$result['link'] = sprintf( 'https://www.instagram.com/%s/', $username );

		// USER DATA ------------------.
		$user_data = array();

		// Get the serialized data string present in the page script.
		preg_match( '/window\._sharedData = (.*);<\/script>/', $data, $ins_data );

		$ins_data_full = array_shift( $ins_data );
		$ins_data_json = array_shift( $ins_data );

		if ( $ins_data_json ) {
			$instagram_json = json_decode( $ins_data_json, true );

			// Current instagram data is not set.
			if ( isset( $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user'] ) ) {
				$user_data = $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user'];
			}
		}

		// Avatar.
		if ( isset( $user_data['profile_pic_url'] ) ) {
			$result['avatar_1x'] = $user_data['profile_pic_url'];
		}
		if ( isset( $user_data['profile_pic_url_hd'] ) ) {
			$result['avatar_2x'] = $user_data['profile_pic_url_hd'];
		}

		// Username.
		$result['text'] = $username;

		return $result;
	}
}

/**
 * Get social follow
 *
 * @param string $name     Name of social network.
 * @param string $username Username of social network.
 * @param string $type     Type of social network.
 */
function powerkit_get_social_follow( $name, $username, $type = null ) {
	$object = new Powerkit_Social_Follow();

	return $object->get_data( $name, $username, $type );
}

new Powerkit_Social_Follow();
