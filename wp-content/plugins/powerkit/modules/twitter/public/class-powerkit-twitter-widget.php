<?php
/**
 * Widget Twitter
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    PowerKit
 * @subpackage PowerKit/widgets
 */

/**
 * Widget Twitter Class
 */
class Powerkit_Twitter_Widget extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 */
	public function __construct() {

		$cache_timeout = (int) apply_filters( 'powerkit_twitter_cache_timeout', 60 );

		$this->default_settings = apply_filters( 'powerkit_twitter_widget_settings', array(
			'title'      => esc_html__( 'Twitter Feed', 'powerkit' ),
			'username'   => '',
			'number'     => 5,
			'template'   => 'default',
			'header'     => true,
			'button'     => true,
			'retweets'   => false,
			'replies'    => false,
			'cache_time' => $cache_timeout,
		) );

		$widget_details = array(
			'classname'   => 'powerkit_twitter_widget',
			'description' => esc_html__( 'A list of recent tweets.', 'powerkit' ),
		);
		parent::__construct( 'powerkit_twitter_widget', esc_html__( 'Twitter Feed', 'powerkit' ), $widget_details );
	}

	/**
	 * Outputs the content for the current widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget( $args, $instance ) {
		$params = array_merge( $this->default_settings, $instance );

		// Connect keys.
		$params['consumer_key']        = Powerkit_Connect::$twitter_consumer_key;
		$params['consumer_secret']     = Powerkit_Connect::$twitter_consumer_secret;
		$params['access_token']        = Powerkit_Connect::$twitter_access_token;
		$params['access_token_secret'] = Powerkit_Connect::$twitter_access_token_secret;

		$id = md5( wp_json_encode( $params ) );

		// Before Widget.
		echo $args['before_widget']; // XSS OK.
		?>

		<div class="widget-body">
			<?php
			// Title.
			if ( $params['title'] ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title']; // XSS.
			}

			// Check if transient already exists.
			$twitter = get_transient( 'powerkit_twitter_widget_cache_' . $id );

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
						'include_rts'     => $params['retweets'] ? 'true' : 'false',
						'exclude_replies' => $params['replies'] ? 'false' : 'true',
					)
				);

				// Set a new transient if no errors returned.
				set_transient( 'powerkit_twitter_widget_cache_' . $id, maybe_serialize( $twitter ), $params['cache_time'] * 60 );
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
			?>
		</div>

		<?php

		// After Widget.
		echo $args['after_widget']; // XSS OK.
	}

	/**
	 * Handles updating settings for the current widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;

		// Display header.
		if ( ! isset( $instance['header'] ) ) {
			$instance['header'] = false;
		}

		// Display follow button.
		if ( ! isset( $instance['button'] ) ) {
			$instance['button'] = false;
		}

		// Include retweets.
		if ( ! isset( $instance['retweets'] ) ) {
			$instance['retweets'] = false;
		}

		// Include replies.
		if ( ! isset( $instance['replies'] ) ) {
			$instance['replies'] = false;
		}

		return $instance;
	}

	/**
	 * Outputs the widget settings form.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$params = array_merge( $this->default_settings, $instance );

		$templates = apply_filters( 'powerkit_twitter_templates', array() );
		?>
			<!-- Title -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'powerkit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $params['title'] ); ?>" /></p>

			<!-- Twitter User ID -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Twitter user ID:', 'powerkit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $params['username'] ); ?>" /></p>

			<!-- Number of Tweets -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of tweets to display:', 'powerkit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo esc_attr( $params['number'] ); ?>" /></p>

			<!-- Template -->
			<?php if ( count( (array) $templates ) > 1 ) : ?>
				<p><label for="<?php echo esc_attr( $this->get_field_id( 'Template' ) ); ?>"><?php esc_html_e( 'Template:', 'powerkit' ); ?></label>
					<select name="<?php echo esc_attr( $this->get_field_name( 'template' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'template' ) ); ?>" class="widefat">
						<?php
						if ( $templates ) {
							foreach ( $templates as $key => $item ) {
								?>
									<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $params['template'], $key ); ?>><?php echo esc_attr( $item['name'] ); ?></option>
								<?php
							}
						}
						?>
					</select>
				</p>
			<?php endif; ?>

			<!-- Display header -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'header' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'header' ) ); ?>" type="checkbox" <?php checked( (bool) $params['header'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'header' ) ); ?>"><?php esc_html_e( 'Display header', 'powerkit' ); ?></label></p>

			<!-- Display follow button -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'button' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'button' ) ); ?>" type="checkbox" <?php checked( (bool) $params['button'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'button' ) ); ?>"><?php esc_html_e( 'Display follow button', 'powerkit' ); ?></label></p>

			<!-- Display header -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'retweets' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'retweets' ) ); ?>" type="checkbox" <?php checked( (bool) $params['retweets'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'retweets' ) ); ?>"><?php esc_html_e( 'Include retweets', 'powerkit' ); ?></label></p>

			<!-- Display follow button -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'replies' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'replies' ) ); ?>" type="checkbox" <?php checked( (bool) $params['replies'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'replies' ) ); ?>"><?php esc_html_e( 'Include replies', 'powerkit' ); ?></label></p>
		<?php
	}
}

/**
 * Register Widget
 */
function powerkit_widget_init_twitter() {
	register_widget( 'Powerkit_Twitter_Widget' );
}
add_action( 'widgets_init', 'powerkit_widget_init_twitter' );
