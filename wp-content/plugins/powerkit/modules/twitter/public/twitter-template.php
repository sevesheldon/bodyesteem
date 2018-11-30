<?php
/**
 * Twitter Template
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    PowerKit
 * @subpackage PowerKit/templates
 */

/**
 * Default Template
 *
 * @param array $tweets List of tweets.
 * @param array $params Parameters.
 */
function powerkit_twitter_default_template( $tweets, $params ) {

	$template = isset( $params['template'] ) ? $params['template'] : 'default';
	?>

	<div class="pk-twitter-wrap pk-twitter-<?php echo esc_attr( $template ); ?>">

		<?php
		if ( is_array( $tweets ) && $tweets ) {

			$name        = $tweets[0]->user->name;
			$screen_name = $tweets[0]->user->screen_name;
			$avatar      = $tweets[0]->user->profile_image_url_https;
			$following   = (int) $tweets[0]->user->friends_count;
			$followers   = (int) $tweets[0]->user->followers_count;

			$avatar_1x = str_replace( '_normal', '_normal', $avatar );
			$avatar_2x = str_replace( '_normal', '_reasonably_small', $avatar );

			if ( $params['header'] ) {
			?>
				<div class="pk-twitter-header">
					<div class="pk-twitter-container">
						<?php if ( $avatar ) { ?>
							<a href="<?php echo esc_url( sprintf( 'https://twitter.com/%s/', $screen_name ) ); ?>" class="pk-twitter-link" target="_blank">
								<?php
									$image_avatar = sprintf(
										'<img src="%s" srcset="%s" alt="avatar" class="pk-twitter-avatar">',
										esc_url( $avatar_1x ), esc_url( $avatar_1x ) . ' 1x, ' . esc_url( $avatar_2x ) . ' 2x'
									);

									echo wp_kses_post( apply_filters( 'powerkit_lazy_process_images', $image_avatar ) );
								?>
							</a>
						<?php } ?>

						<?php $tag = apply_filters( 'powerkit_twitter_name_tag', 'h6' ); ?>

						<div class="pk-twitter-info">
							<<?php echo esc_html( $tag ); ?> class="pk-twitter-name pk-title pk-font-heading">
								<a href="<?php echo esc_url( sprintf( 'https://twitter.com/%s/', $screen_name ) ); ?>" target="_blank">
									<?php echo esc_html( $name ); ?>
								</a>
							</<?php echo esc_html( $tag ); ?>>

							<?php if ( $name !== $screen_name ) { ?>
								<span class="pk-twitter-username pk-color-secondary">
									<a href="<?php echo esc_url( sprintf( 'https://twitter.com/%s/', $screen_name ) ); ?>" target="_blank">
									@<?php echo wp_kses_post( $screen_name ); ?>
									</a>
								</span>
							<?php } ?>
						</div>
					</div>

					<div class="pk-twitter-counters pk-color-secondary">
						<div class="counter following">
							<span class="number"><?php echo esc_html( powerkit_abridged_number( $following, 0 ) ); ?></span> <?php esc_html_e( 'Following', 'powerkit' ); ?>
						</div>
						<div class="counter followers">
							<span class="number"><?php echo esc_html( powerkit_abridged_number( $followers, 0 ) ); ?></span> <?php esc_html_e( 'Followers', 'powerkit' ); ?>
						</div>
					</div>
				</div>
			<?php
			}
			?>

			<div class="pk-tweets">

				<?php
				foreach ( $tweets as $tweet ) {
					$retweets = $tweet->retweet_count > 0 ? $tweet->retweet_count : '';
					$tweet_id = $tweet->id_str;
					$time     = powerkit_relative_time( $tweet->created_at );
					$text     = powerkit_twitter_convert_links( $tweet->text );
					?>
						<div class="pk-twitter-tweet">

							<div class="pk-twitter-content pk-color-secondary"><?php echo wp_kses_post( $text ); ?></div>
							<a href="https://twitter.com/<?php echo esc_attr( $screen_name ); ?>/status/<?php echo esc_attr( $tweet_id ); ?>" class="pk-twitter-time pk-font-secondary timestamp" target="_blank"><?php echo esc_html( $time ); ?></a>

							<div class="pk-twitter-actions">
								<ul>
									<li>
										<a onClick="window.open('https://twitter.com/intent/tweet?in_reply_to=<?php echo esc_attr( $tweet_id ); ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="tweet-reply" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo esc_attr( $tweet_id ); ?>">
											<i class="pk-icon pk-icon-reply"></i>
											<span class="pk-twitter-label pk-twitter-reply"><?php esc_html_e( 'Reply', 'powerkit' ); ?></span>
										</a>
									</li>
									<li>
										<a onClick="window.open('https://twitter.com/intent/retweet?tweet_id=<?php echo esc_attr( $tweet_id ); ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="tweet-retweet" href="https://twitter.com/intent/retweet?tweet_id=<?php echo esc_attr( $tweet_id ); ?>">
											<i class="pk-icon pk-icon-retweet"></i>
											<span class="pk-twitter-count"><?php echo wp_kses_post( $retweets ); ?></span>
											<span class="pk-twitter-label pk-twitter-retweet"><?php esc_html_e( 'Retweet', 'powerkit' ); ?></span>
										</a>
									</li>
									<li>
										<a onClick="window.open('https://twitter.com/intent/favorite?tweet_id=<?php echo esc_attr( $tweet_id ); ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="tweet-favorite" href="https://twitter.com/intent/favorite?tweet_id=<?php echo esc_attr( $tweet_id ); ?>">
											<i class="pk-icon pk-icon-like"></i>
											<span class="pk-twitter-label pk-twitter-favorite"><?php esc_html_e( 'Favorite', 'powerkit' ); ?></span>
										</a>
									</li>
								</ul>
							</div>

						</div>
					<?php
				}
				?>
			</div>

			<?php
			if ( $params['button'] ) {
			?>
				<div class="pk-twitter-footer">
					<a class="pk-twitter-btn button" href="<?php echo esc_url( sprintf( 'https://twitter.com/%s/', $screen_name ) ); ?>" target="_blank">
						<span class="pk-twitter-follow"><?php echo wp_kses( apply_filters( 'powerkit_twitter_follow', esc_html__( 'Follow', 'powerkit' ) ), 'post' ); ?></span>
					</a>
				</div>
				<?php
			}
		} else {
		?>
			<p><?php esc_html_e( 'Twitter user not found. Please check your Twitter User ID.', 'powerkit' ); ?></p>
			<?php
		}
		?>
	</div>
	<?php
}
