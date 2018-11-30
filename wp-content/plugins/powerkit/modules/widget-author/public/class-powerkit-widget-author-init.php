<?php
/**
 * Widget Author
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Powerkit
 * @subpackage Powerkit/widgets
 */

/**
 * Widget Author
 */
class Powerkit_Widget_Author_Init extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 */
	public function __construct() {

		$this->default_settings = apply_filters( 'powerkit_widget_author_settings', array(
			'title'           => esc_html__( 'Author', 'powerkit' ),
			'author'          => 'сurrent',
			'bg_image_id'     => false,
			'avatar'          => true,
			'description'     => true,
			'social_accounts' => true,
			'posts_only'      => false,
			'archive_btn'     => false,
		) );

		$widget_details = array(
			'classname'   => 'powerkit_widget_author',
			'description' => '',
		);

		// Actions.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		parent::__construct( 'powerkit_widget_author', esc_html__( 'Author', 'powerkit' ), $widget_details );
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

		$authors = array();

		// Get authors.
		if ( 'сurrent' === $params['author'] ) {
			if ( is_single() ) {
				$params['posts_only'] = true;

				$coauthors = array();

				if ( function_exists( 'get_coauthors' ) ) {
					$coauthors = get_coauthors();
				}

				if ( $coauthors ) {
					// Get co authors.
					foreach ( $coauthors as $author ) {
						$authors[] = $author->ID;
					}
				} else {
					// Get the default WP author.
					$authors[] = get_the_author_meta( 'ID' );
				}
			}
		} else {

			if ( get_the_author_meta( 'display_name', $params['author'] ) ) {

				$authors[] = $params['author'];

			} elseif ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
				?>
				<p class="pk-alert pk-alert-warning" role="alert">
					<?php esc_html_e( 'Author not found.', 'powerkit' ); ?>
				</p>
				<?php
			}
		}

		if ( empty( $authors ) ) {
			return;
		}

		foreach ( $authors as $author ) {
			// Display on posts only.
			if ( $params['posts_only'] ) {
				if ( is_single() ) {
					$post_id = get_queried_object_id();

					if ( ! powerkit_check_post_author( $author, $post_id ) ) {
						continue;
					}
				} else {
					continue;
				}
			}

			// Display author.
			if ( ! @ is_author( $author ) ) {

				// Before Widget.
				echo $args['before_widget']; // XSS.

				$avatar_size = apply_filters( 'powerkit_widget_author_avatar_size', 80 );
				?>
					<div class="widget-body">
						<div class="pk-widget-author<?php echo esc_attr( $params['bg_image_id'] ? ' pk-widget-author-with-bg' : '' ); ?>">
							<?php if ( $params['bg_image_id'] ) { ?>
								<div class="pk-widget-author-bg">
									<?php echo wp_get_attachment_image( $params['bg_image_id'], apply_filters( 'powerkit_widget_author_image_size', 'large' ) ); ?>
								</div>
							<?php } ?>

							<div class="pk-widget-author-container<?php echo esc_attr( $params['bg_image_id'] ? ' pk-bg-overlay' : '' ); ?>">
								<?php
								// Title.
								if ( $params['title'] ) {
									echo $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title']; // XSS.
								}
								?>

								<?php $tag = apply_filters( 'powerkit_widget_author_title_tag', 'h5' ); ?>

								<<?php echo esc_html( $tag ); ?> class="pk-author-title">
									<a href="<?php echo esc_url( get_author_posts_url( $author ) ); ?>" rel="author">
										<?php echo esc_html( get_the_author_meta( 'display_name', $author ) ); ?>
									</a>
								</<?php echo esc_html( $tag ); ?>>

								<?php if ( $params['avatar'] ) { ?>
									<div class="pk-author-avatar">
										<a href="<?php echo esc_url( get_author_posts_url( $author ) ); ?>" rel="author">
											<?php echo get_avatar( $author, $avatar_size ); ?>
										</a>
									</div>
								<?php } ?>

								<div class="pk-author-data">
									<?php
									if ( $params['description'] && get_the_author_meta( 'description', $author ) ) {
										?>
										<div class="author-description pk-color-secondary">
											<?php echo wp_kses_post( powerkit_str_truncate( get_the_author_meta( 'description', $author ), 100 ) ); ?>
										</div>
										<?php
									}
									if ( $params['social_accounts'] && powerkit_module_enabled( 'social_links' ) ) {
										powerkit_author_social_links( $author );
									}
									?>

									<?php if ( $params['archive_btn'] ) { ?>
										<a href="<?php echo esc_url( get_author_posts_url( $author) ); ?>" class="pk-author-button button">
											<?php echo wp_kses( apply_filters( 'powerkit_widget_author_button', esc_html__( 'View Posts', 'powerkit' ) ), 'post' ); ?>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php
				// After Widget.
				echo $args['after_widget']; // XSS.
			}
		}
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

		// Display avatar.
		if ( ! isset( $instance['avatar'] ) ) {
			$instance['avatar'] = false;
		}

		// Display description.
		if ( ! isset( $instance['description'] ) ) {
			$instance['description'] = false;
		}

		// Display social accounts.
		if ( ! isset( $instance['social_accounts'] ) ) {
			$instance['social_accounts'] = false;
		}

		// Display on posts only.
		if ( ! isset( $instance['posts_only'] ) ) {
			$instance['posts_only'] = false;
		}

		// Display post archive button.
		if ( ! isset( $instance['archive_btn'] ) ) {
			$instance['archive_btn'] = false;
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

		$bg_image_url = $params['bg_image_id'] ? wp_get_attachment_image_url( intval( $params['bg_image_id'] ), 'large' ) : '';
		?>
			<!-- Title -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'powerkit' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $params['title'] ); ?>" /></p>

			<!-- Author -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>"><?php esc_html_e( 'Author:', 'powerkit' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'author' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>" class="widefat">
					<option value="сurrent" <?php selected( $params['author'], 'сurrent' ); ?>><?php esc_html_e( 'Current Post’s Author' ); ?></option>
					<?php
					$authors = powerkit_get_users();

					if ( isset( $authors ) && ! empty( $authors ) ) {
						foreach ( $authors as $author ) {
							?>
								<option value="<?php echo esc_attr( $author->ID ); ?>" <?php selected( $params['author'], $author->ID ); ?>><?php echo esc_html( $author->display_name ); ?></option>
							<?php
						}
					}
					?>
				</select>
			</p>

			<!-- Background Image container -->
			<div class="author-upload-image upload-img-container" data-frame-title="<?php esc_html_e( 'Select or upload background image', 'powerkit' ); ?>" data-frame-btn-text="<?php esc_html_e( 'Set background image', 'powerkit' ); ?>">
				<p class="uploaded-img-box">
					<label for="<?php echo esc_attr( $this->get_field_id( 'bg_image_id' ) ); ?>"><?php esc_html_e( 'Background image:', 'powerkit' ); ?></label>

					<span class="uploaded-image">
						<?php if ( $bg_image_url ) : ?>
							<img src="<?php echo esc_url( $bg_image_url ); ?>" style="display: block; margin-top: 5px; max-width:100%;" />
						<?php endif; ?>
					</span>

					<input id="<?php echo esc_attr( $this->get_field_id( 'bg_image_id' ) ); ?>" class="uploaded-img-id" name="<?php echo esc_attr( $this->get_field_name( 'bg_image_id' ) ); ?>" type="hidden" value="<?php echo esc_attr( $params['bg_image_id'] ); ?>" />
				</p>

				<!-- Add & remove image links -->
				<p class="hide-if-no-js">
					<a class="upload-img-link button button-primary <?php echo esc_attr( $bg_image_url ? 'hidden' : '' ); ?>" href="#"><?php esc_html_e( 'Add Image', 'powerkit' ); ?></a>
					<a class="delete-img-link button button-secondary <?php echo esc_attr( ! $bg_image_url ? 'hidden' : '' ); ?>" href="#"><?php esc_html_e( 'Remove Image', 'powerkit' ); ?></a>
				</p>
			</div>

			<!-- Display avatar -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'avatar' ) ); ?>" type="checkbox" <?php checked( (bool) $params['avatar'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>"><?php esc_html_e( 'Display avatar', 'powerkit' ); ?></label></p>

			<!-- Display description -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="checkbox" <?php checked( (bool) $params['description'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Display description', 'powerkit' ); ?></label></p>

			<!-- Display social accounts -->
			<?php if ( powerkit_module_enabled( 'social_links' ) ) : ?>
				<p><input id="<?php echo esc_attr( $this->get_field_id( 'social_accounts' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'social_accounts' ) ); ?>" type="checkbox" <?php checked( (bool) $params['social_accounts'] ); ?> />
				<label for="<?php echo esc_attr( $this->get_field_id( 'social_accounts' ) ); ?>"><?php esc_html_e( 'Display social accounts', 'powerkit' ); ?></label></p>
			<?php endif; ?>

			<!-- Display post archive button -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'archive_btn' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'archive_btn' ) ); ?>" type="checkbox" <?php checked( (bool) $params['archive_btn'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'archive_btn' ) ); ?>"><?php esc_html_e( 'Display post archive button', 'authentic' ); ?></label></p>

			<!-- Display on posts only -->
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'posts_only' ) ); ?>" class="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'posts_only' ) ); ?>" type="checkbox" <?php checked( (bool) $params['posts_only'] ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'posts_only' ) ); ?>"><?php esc_html_e( 'Display on posts of the author only', 'authentic' ); ?></label></p>

		<?php
	}

	/**
	 * Admin Enqunue Scripts
	 *
	 * @param string $page Current page.
	 */
	public function admin_enqueue_scripts( $page ) {
		if ( 'widgets.php' === $page ) {
			wp_enqueue_media();

			ob_start();
			?>
			<script>
			jQuery( document ).ready(function( $ ) {

				var powerkitMediaFrame;
				/* Set all variables to be used in scope */
				var metaBox = '.author-upload-image';

				/* Add Image Link */
				$( metaBox ).find( '.upload-img-link' ).live( 'click', function( event ){
					event.preventDefault();

					var parentContainer = $( this ).parents( metaBox );

					// Options.
					var options = {
						title: parentContainer.data( 'frame-title' ) ? parentContainer.data( 'frame-title' ) : 'Select or Upload Media',
						button: {
							text: parentContainer.data( 'frame-btn-text' ) ? parentContainer.data( 'frame-btn-text' ) : 'Use this media',
						},
						library : { type : 'image' },
						multiple: false // Set to true to allow multiple files to be selected.
					};

					// Create a new media frame
					powerkitMediaFrame = wp.media( options );

					// When an image is selected in the media frame...
					powerkitMediaFrame.on( 'select', function() {

						// Get media attachment details from the frame state.
						var attachment = powerkitMediaFrame.state().get('selection').first().toJSON();

						// Send the attachment URL to our custom image input field.
						parentContainer.find( '.uploaded-image' ).html( '<img src="' + attachment.url + '" style="display: block; margin-top: 5px; max-width:100%;"/>' );
						parentContainer.find( '.uploaded-img-id' ).val( attachment.id ).change();
						parentContainer.find( '.upload-img-link' ).addClass( 'hidden' );
						parentContainer.find( '.delete-img-link' ).removeClass( 'hidden' );

						powerkitMediaFrame.close();
					});

					// Finally, open the modal on click.
					powerkitMediaFrame.open();
				});


				/* Delete Image Link */
				$( metaBox ).find( '.delete-img-link' ).live( 'click', function( event ){
					event.preventDefault();

					$( this ).parents( metaBox ).find( '.uploaded-image' ).html( '' );
					$( this ).parents( metaBox ).find( '.upload-img-link' ).removeClass( 'hidden' );
					$( this ).parents( metaBox ).find( '.delete-img-link' ).addClass( 'hidden' );
					$( this ).parents( metaBox ).find( '.uploaded-img-id' ).val( '' ).change();
				});
			});
			</script>
			<?php
			wp_add_inline_script( 'jquery-core', str_replace( array( '<script>', '</script>' ), '', ob_get_clean() ) );
		}
	}
}

/**
 * Register Widget
 */
function powerkit_widget_author_init() {
	register_widget( 'Powerkit_Widget_Author_Init' );
}
add_action( 'widgets_init', 'powerkit_widget_author_init' );
