( function( $ ) {
	'use strict';

	$( function() {

		/*
		* AJAX Reset cache
		*/
		$( document ).on( 'click dblclick', 'a[href*="action=powerkit_reset_cache"]', function( e ) {
			var $this = this;
			$.ajax( {
				type: 'POST',
				url: window.pk_connect.ajax_url + '?action=powerkit_reset_cache',
				data: {
					page: $( $this ).attr( 'href' ).split( 'page=' ).pop().split( '&' ).shift(),
				},
				beforeSend: function() {
					$( $this ).siblings( '.spinner, .status' ).remove();

					$( $this ).after( '<span class="spinner is-active"></span>' );
				},
				success: function( data ) {
					$( $this ).after( '<span class="status dashicons dashicons-yes"></span>' );
				},
				error: function() {
					$( $this ).after( '<span class="status dashicons dashicons-no-alt"></span>' );
				},
				complete: function() {
					$( $this ).siblings( '.spinner' ).remove();

					setTimeout( function() {
						$( $this ).siblings( '.status' ).fadeOut();
					}, 2000 );
				}
			} );

			// Refresh customizer.
			if ( $( 'body' ).hasClass( 'wp-customizer' ) ) {
				wp.customize.previewer.refresh();
			}

			return false;
		} );

	} );

} )( jQuery );