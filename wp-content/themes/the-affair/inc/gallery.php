<?php
/**
 * Galleries
 *
 * @package The Affair
 */

/**
 * Filters the default gallery shortcode output.
 *
 * If the filtered output isn't empty, it will be used instead of generating
 * the default gallery template.
 *
 * @see gallery_shortcode()
 *
 * @param string $output   The gallery output. Default empty.
 * @param array  $attr     Attributes of the gallery shortcode.
 * @param int    $instance Unique numeric ID of this gallery shortcode instance.
 */
function csco_gallery_content( $output, $attr, $instance ) {

	$attr = array_merge( array(
		'type'     => 'default',
		'location' => 'fullwidth',
	), (array) $attr );

	if ( ! ( is_single() && in_the_loop() ) ) {
		return $output;
	}

	if ( 'post' === $attr['location'] ) {
		return $output;
	}

	$function_remove = 'remove_filter';

	// Remove the filter to prevent infinite loop.
	$function_remove( 'post_gallery', 'csco_gallery_content', 10, 3 );

	// Add closing entry columns and entry content.
	$return = '</div></div></div>';

	// Add opening wrapper.
	$return .= '<div class="entry-content gallery-wrap gallery-wrap-' . $attr['type'] . '">';

	// Add opening container.
	$return .= '<div class="gallery-container">';

	// Generate the standard gallery output.
	$return .= gallery_shortcode( $attr );

	// Add closing container.
	$return .= '</div>';

	// Add closing wrapper.
	$return .= '</div>';

	// Add opening new entry columns.
	$return .= '<div class="entry-content-columns">';

	// Add opening new entry empty sidebar.
	$return .= '<div class="entry-sidebar-area"></div>';

	// Add opening new entry content.
	$return .= '<div class="entry-content"><div class="content">';

	// Add the filter for subsequent calls to gallery shortcode.
	add_filter( 'post_gallery', 'csco_gallery_content', 10, 3 );

	// Finally, return the output.
	return $return;
}
add_filter( 'post_gallery', 'csco_gallery_content', 10, 3 );

/**
 * Add Gallery Location Dropdown
 */
function csco_print_media_location() {
	?>
	<script type="text/html" id="tmpl-theme-gallery-location">
		<label class="setting">
			<span><?php esc_html_e( 'Location', 'the-affair' ); ?></span>
			<select class="location" name="location" data-setting="location">
				<option value="fullwidth"><?php esc_html_e( 'Fullwidth', 'the-affair' ); ?></option>
				<option value="post"><?php esc_html_e( 'Post Content', 'the-affair' ); ?></option>
			</select>
		</label>
	</script>

	<script>
		jQuery( document ).ready( function() {
			_.extend( wp.media.gallery.defaults, {
				location: 'fullwidth'
			} );

			// join default gallery settings template with yours -- store in list
			if ( !wp.media.gallery.templates ) wp.media.gallery.templates = [ 'gallery-settings' ];
			wp.media.gallery.templates.push( 'theme-gallery-location' );

			// loop through list -- allowing for other templates/settings
			wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend( {
				template: function( view ) {
					var output = '';
					for ( var i in wp.media.gallery.templates ) {
						output += wp.media.template( wp.media.gallery.templates[ i ] )( view );
					}
					return output;
				}
			} );

		} );
	</script>
	<?php
}
add_action( 'print_media_templates', 'csco_print_media_location', 99 );
