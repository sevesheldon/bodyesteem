<?php
/**
 * Social API Config
 *
 * @package    Powerkit
 * @subpackage Modules/Helper
 */

/**
 * Social API Config Class
 */
class Powerkit_Links_Api_Config {

	/**
	 * Cache Timeout
	 *
	 * @var string $cache_timeout  Cache Timeout.
	 */
	public static $cache_timeout;

	/**
	 * Users
	 *
	 * @var string $users  Users List.
	 */
	public static $users = array();

	/**
	 * Api keys
	 *
	 * @var string $api_keys  Api keys.
	 */
	public static $api_keys = array();

	/**
	 * Api keys
	 *
	 * @var string $extra  Extra data.
	 */
	public static $extra = array();

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		self::$cache_timeout = (int) apply_filters( 'powerkit_social_links_cache_timeout', 60 );

		self::$users['powerkit_social_links_rss_url'] = get_option( 'powerkit_social_links_powerkit_social_links_rss_url' );
		self::$users['dribbble_user']                 = get_option( 'powerkit_social_links_dribbble_user' );
		self::$users['facebook_user']                 = get_option( 'powerkit_social_links_facebook_user' );
		self::$users['instagram_user']                = get_option( 'powerkit_social_links_instagram_user' );
		self::$users['google_plus_id']                = get_option( 'powerkit_social_links_google_plus_id' );
		self::$users['youtube_slug']                  = get_option( 'powerkit_social_links_youtube_slug' );
		self::$users['telegram_chat']                 = get_option( 'powerkit_social_links_telegram_chat' );
		self::$users['pinterest_user']                = get_option( 'powerkit_social_links_pinterest_user' );
		self::$users['soundcloud_user_id']            = get_option( 'powerkit_social_links_soundcloud_user_id' );
		self::$users['vimeo_user']                    = get_option( 'powerkit_social_links_vimeo_user' );
		self::$users['twitter_user']                  = get_option( 'powerkit_social_links_twitter_user' );
		self::$users['behance_user']                  = get_option( 'powerkit_social_links_behance_user' );
		self::$users['github_user']                   = get_option( 'powerkit_social_links_github_user' );
		self::$users['vk_id']                         = get_option( 'powerkit_social_links_vk_id' );
		self::$users['twitch_user_id']                = get_option( 'powerkit_social_links_twitch_user_id' );
		self::$users['flickr_user_id']                = get_option( 'powerkit_social_links_flickr_user_id' );
		self::$users['snapchat_user']                 = get_option( 'powerkit_social_links_snapchat_user' );
		self::$users['medium_user']                   = get_option( 'powerkit_social_links_medium_user' );
		self::$users['reddit_user']                   = get_option( 'powerkit_social_links_reddit_user' );
		self::$extra['reddit_type']                   = get_option( 'powerkit_social_links_reddit_type' );
		self::$extra['youtube_channel_type']          = get_option( 'powerkit_social_links_youtube_channel_type' );
		self::$extra['linkedin_slug']                 = get_option( 'powerkit_social_links_linkedin_slug' );

		self::$api_keys['facebook_app_id']             = Powerkit_Connect::$facebook_app_id;
		self::$api_keys['facebook_app_secret']         = Powerkit_Connect::$facebook_app_secret;
		self::$api_keys['instagram_token']             = Powerkit_Connect::$instagram_token;
		self::$api_keys['twitter_consumer_key']        = Powerkit_Connect::$twitter_consumer_key;
		self::$api_keys['twitter_consumer_secret']     = Powerkit_Connect::$twitter_consumer_secret;
		self::$api_keys['twitter_access_token']        = Powerkit_Connect::$twitter_access_token;
		self::$api_keys['twitter_access_token_secret'] = Powerkit_Connect::$twitter_access_token_secret;
		self::$api_keys['google_key']                  = Powerkit_Connect::$google_key;
		self::$api_keys['youtube_key']                 = Powerkit_Connect::$youtube_key;
		self::$api_keys['telegram_token']              = Powerkit_Connect::$telegram_token;
		self::$api_keys['soundcloud_client_id']        = Powerkit_Connect::$soundcloud_client_id;
		self::$api_keys['dribbble_token']              = Powerkit_Connect::$dribbble_token;
		self::$api_keys['vimeo_token']                 = Powerkit_Connect::$vimeo_token;
		self::$api_keys['behance_client_id']           = Powerkit_Connect::$behance_client_id;
		self::$api_keys['github_client_id']            = Powerkit_Connect::$github_client_id;
		self::$api_keys['github_client_secret']        = Powerkit_Connect::$github_client_secret;
		self::$api_keys['twitch_client_id']            = Powerkit_Connect::$twitch_client_id;
		self::$api_keys['vk_token']                    = Powerkit_Connect::$vk_token;
	}
}
