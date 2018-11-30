<?php
/**
 * Connect
 *
 * @package    Powerkit
 * @subpackage Extensions
 */

/**
 * Init module
 */
class Powerkit_Connect extends Powerkit_Module {

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $facebook_app_id;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $facebook_app_secret;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $instagram_token;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $twitter_consumer_key;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $twitter_consumer_secret;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $twitter_access_token;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $twitter_access_token_secret;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $google_key;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $youtube_key;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $telegram_token;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $soundcloud_client_id;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $dribbble_token;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $vimeo_token;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $behance_client_id;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $github_client_id;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $github_client_secret;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $twitch_client_id;

	/**
	 * The connect key.
	 *
	 * @var string The connect key.
	 */
	public static $vk_token;

	/**
	 * Register module
	 */
	public function register() {
		$this->name     = 'connect';
		$this->slug     = 'connect';
		$this->type     = 'extension';
		$this->category = 'basic';
		$this->public   = false;
		$this->enabled  = true;
	}

	/**
	 * Initialize module
	 */
	public function initialize() {
		add_action( 'init', array( $this, 'connect_keys' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_ajax_powerkit_reset_cache', array( $this, 'ajax_reset_cache' ) );
		add_action( 'wp_ajax_nopriv_powerkit_reset_cache', array( $this, 'ajax_reset_cache' ) );
	}

	/**
	 * Connect keys
	 */
	public function connect_keys() {
		self::$facebook_app_id             = apply_filters( 'powerkit_connect_facebook_app_id', '233401800329539' );
		self::$facebook_app_secret         = apply_filters( 'powerkit_connect_facebook_app_secret', 'e5d53f9d0d6fe2ac057111c75c0e8ab2' );
		self::$instagram_token             = apply_filters( 'powerkit_connect_instagram_token', '8131074748.1677ed0.144d976f2d1640fea9d632d7cf4a2f7a' );
		self::$twitter_consumer_key        = apply_filters( 'powerkit_connect_twitter_consumer_key', 'OQcc7qGSR3e7yr2RyW7GENrYv' );
		self::$twitter_consumer_secret     = apply_filters( 'powerkit_connect_twitter_consumer_secret', 'h1LuUHmHcjQXtkQ6Q4sPc9P7gzxDeZHqRhJaqhfkNTOvqrOv6z' );
		self::$twitter_access_token        = apply_filters( 'powerkit_connect_twitter_access_token', '3465063683-azlK2bxzTAV5l66Rg959M5zy88An7DhByTS7WZE' );
		self::$twitter_access_token_secret = apply_filters( 'powerkit_connect_twitter_access_token_secret', '9clHjgWuOCbU8I8PxX5obvxqhpmwD1FMpmt8ME51h6WC3' );
		self::$google_key                  = apply_filters( 'powerkit_connect_google_key', 'AIzaSyDPX6CN1ZqCCuKhDjYjsPKd6Y8-REzMgN0' );
		self::$youtube_key                 = apply_filters( 'powerkit_connect_youtube_key', 'AIzaSyDPX6CN1ZqCCuKhDjYjsPKd6Y8-REzMgN0' );
		self::$telegram_token              = apply_filters( 'powerkit_connect_telegram_token', '535500238:AAGwTT0N08hxqOjlGaXCT1FkMfog6nTgCfQ' );
		self::$soundcloud_client_id        = apply_filters( 'powerkit_connect_soundcloud_client_id', '97220fb34ad034b5d4b59b967fd1717e' );
		self::$dribbble_token              = apply_filters( 'powerkit_connect_dribbble_token', '' );
		self::$vimeo_token                 = apply_filters( 'powerkit_connect_vimeo_token', '88b058608aeb2e627bb782f633d65c64' );
		self::$behance_client_id           = apply_filters( 'powerkit_connect_behance_client_id', 'GD1rhPqJoigZ7LjpQDTIm2Fc8gOzi1j4' );
		self::$github_client_id            = apply_filters( 'powerkit_connect_github_client_id', 'cb73d7473e8504a79f04' );
		self::$github_client_secret        = apply_filters( 'powerkit_connect_github_client_secret', 'd2997a66afdcfafed88da68a362edfe1893e680a' );
		self::$twitch_client_id            = apply_filters( 'powerkit_connect_twitch_client_id', 'vi406y9ha45y2dsrksp6o17umky54w' );
		self::$vk_token                    = apply_filters( 'powerkit_connect_vk_token', 'bfc38fc9bfc38fc9bfc38fc9ecbfa77e89bbfc3bfc38fc9e4f322ef356dfb912e4dc7ce' );
	}

	/**
	 * Reset cache
	 *
	 * @param array $list Reset list.
	 */
	public static function reset_cache( $list = false ) {
		if ( is_array( $list ) ) {

			$list = $list;

		} elseif ( is_string( $list ) && $list ) {

			$list = explode( ' ', $list );

		} else {
			$list = apply_filters( 'powerkit_reset_cache', array() );
		}

		if ( $list ) {
			global $wpdb;

			foreach ( $list as $option_name ) {
				$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->options WHERE option_name LIKE '%%%s%%'", $option_name ) ); // db call ok; no-cache ok.
				$wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_key LIKE '%%%s%%'", $option_name ) ); // db call ok; no-cache ok.
			}

			printf( '<div id="message" class="updated fade"><p><strong>%s</strong></p></div>', esc_html__( 'Cache purged.', 'powerkit' ) );
		}
	}

	/**
	 * Ajax Reset cache
	 */
	public function ajax_reset_cache() {
		wp_verify_nonce( null );

		$list = apply_filters( 'powerkit_ajax_reset_cache', array() );

		if ( ! isset( $_POST['page'] ) ) { // Input var ok.
			return false;
		}

		$page = sanitize_key( $_POST['page'] ); // Input var ok; sanitization ok.

		if ( ! isset( $list[ $page ] ) ) {
			return false;
		}

		self::reset_cache( $list[ $page ] );

		die();
	}

	/**
	 * Register the stylesheets and JavaScript for the admin area.
	 *
	 * @param string $page Current page.
	 */
	public function enqueue_scripts( $page ) {
		if ( is_customize_preview() || 'toplevel_page_powerkit_manager' === $page ) {

			wp_enqueue_script( 'admin-powerkit-connect', plugin_dir_url( __FILE__ ) . 'js/admin-powerkit-connect.js', array( 'jquery' ), powerkit_get_setting( 'version' ), false );

			wp_localize_script( 'admin-powerkit-connect', 'pk_connect', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			) );
		}
	}
}

new Powerkit_Connect();
