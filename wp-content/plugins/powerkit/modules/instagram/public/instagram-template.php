<?php
/**
 * Instagram Template
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
 * @param array $feed      The instagram feed.
 * @param array $instagram The instagram items.
 * @param array $params    The user parameters.
 */
function powerkit_instagram_default_template( $feed, $instagram, $params ) {

	if ( $params['header'] ) {
	?>
	<div class="pk-instagram-header">
		<div class="pk-instagram-container">
			<?php if ( $feed['avatar_1x'] ) { ?>
				<a href="<?php echo esc_url( sprintf( 'https://www.instagram.com/%s/', $feed['username'] ) ); ?>" class="pk-avatar-link" target="<?php echo esc_attr( $params['target'] ); ?>">
					<?php
						$image_avatar = sprintf(
							'<img src="%s" alt="avatar" class="pk-instagram-avatar">', esc_url( $feed['avatar_1x'] )
						);

						echo wp_kses_post( apply_filters( 'powerkit_lazy_process_images', $image_avatar ) );
					?>
				</a>
			<?php } ?>

			<?php $tag = apply_filters( 'powerkit_instagram_username_tag', 'h6' ); ?>

			<div class="pk-instagram-info">
				<?php if ( $feed['name'] !== $feed['username'] ) { ?>
					<<?php echo esc_html( $tag ); ?>  class="pk-instagram-username pk-title pk-font-heading">
						<a href="<?php echo esc_url( sprintf( 'https://www.instagram.com/%s/', $feed['username'] ) ); ?>" target="<?php echo esc_attr( $params['target'] ); ?>">
							<?php echo wp_kses_post( $feed['username'] ); ?>
						</a>
					</<?php echo esc_html( $tag ); ?>>
				<?php } ?>

				<span class="pk-instagram-name pk-color-secondary">
					<a href="<?php echo esc_url( sprintf( 'https://www.instagram.com/%s/', $feed['username'] ) ); ?>" target="<?php echo esc_attr( $params['target'] ); ?>">
						<?php echo esc_html( $feed['name'] ); ?>
					</a>
				</span>
			</div>
		</div>

		<div class="pk-instagram-counters pk-color-secondary">
			<div class="counter following">
				<span class="number"><?php echo esc_html( powerkit_abridged_number( $feed['following'], 0 ) ); ?></span> <?php esc_html_e( 'Following', 'powerkit' ); ?>
			</div>
			<div class="counter followers">
				<span class="number"><?php echo esc_html( powerkit_abridged_number( $feed['followers'], 0 ) ); ?></span> <?php esc_html_e( 'Followers', 'powerkit' ); ?>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php if ( is_array( $instagram ) && $instagram ) { ?>
		<div class="pk-instagram-items">
			<?php foreach ( $instagram as $item ) { ?>
				<div class="pk-instagram-item">
					<a class="pk-instagram-link" href="<?php echo esc_url( $item['user_link'] ); ?>" target="<?php echo esc_attr( $params['target'] ); ?>">
						<img src="<?php echo esc_attr( $item['user_image'] ); ?>" class="<?php echo esc_attr( $item['class'] ); ?>" alt="<?php echo esc_html( $item['description'] ); ?>" srcset="<?php echo esc_attr( $item['srcset'] ); ?>" sizes="<?php echo esc_attr( $item['sizes'] ); ?>">

						<span class="pk-instagram-data">
							<span class="pk-instagram-meta">
								<span class="pk-meta pk-meta-likes"><i class="pk-icon pk-icon-like"></i> <?php echo esc_attr( powerkit_abridged_number( $item['likes'], 0 ) ); ?></span>
								<span class="pk-meta pk-meta-comments"><i class="pk-icon pk-icon-comment"></i> <?php echo esc_attr( powerkit_abridged_number( $item['comments'], 0 ) ); ?></span>
							</span>
						</span>
					</a>
				</div>
			<?php } ?>
		</div>
	<?php } else { ?>
		<p><?php esc_html_e( 'Images Not Found!', 'powerkit' ); ?></p>
	<?php } ?>

	<?php
	if ( $params['button'] ) {
	?>
		<div class="pk-instagram-footer">
			<a class="pk-instagram-btn button" href="<?php echo esc_url( sprintf( 'https://www.instagram.com/%s/', $feed['username'] ) ); ?>" target="<?php echo esc_attr( $params['target'] ); ?>">
				<span class="pk-instagram-follow"><?php echo wp_kses( apply_filters( 'powerkit_instagram_follow', esc_html__( 'Follow', 'powerkit' ) ), 'post' ); ?></span>
			</a>
		</div>
		<?php
	}
}
