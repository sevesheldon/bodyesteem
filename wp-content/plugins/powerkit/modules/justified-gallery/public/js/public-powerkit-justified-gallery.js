/**
 * Justified Gallery
 */
( function( $ ) {

	function powerkitInitJustifiedGallery() {

		$( '.gallery-type-justified' ).imagesLoaded( function( instance ) {

			$( instance.elements ).each( function( index, el ) {
				$( el ).justifiedGallery( {
					rtl: powerkitJG.rtl,
					margins: $( el ).data( 'jg-margins' ),
					rowHeight: $( el ).data( 'jg-row-height' ),
					maxRowHeight: $( el ).data( 'jg-max-row-height' ),
					lastRow: $( el ).data( 'jg-last-row' ),
					border: 0,
					selector: 'figure',
					captions: true,
					cssAnimation: true,
					captionSettings: {
						animationDuration: 100,
						visibleOpacity: 1.0,
						nonVisibleOpacity: 0.0
					}
				} ).on( 'jg.complete', function( e ) {

					$( el ).addClass( 'justified-loaded' );

					$( document.body ).trigger( 'image-load' );
				} );
			} );

		} );
	}

	$( document ).ready( function() {
		powerkitInitJustifiedGallery();
		$( document.body ).on( 'post-load', function() {
			powerkitInitJustifiedGallery();
		} );
	} );

} )( jQuery );