/**
 * Slider Gallery
 */
( function( $ ) {

	function powerkitInitSliderGallery() {

		/**
		 * Get Page Info
		 */
		function powerkitSliderPageInfo( cellNumber, cellsLength ) {
			var sep = powerkit_sg_flickity.page_info_sep;

			return '<span class="current">' + ( cellNumber + 1 ) + '</span><span class="sep">' + sep + '</span><span class="cells">' + cellsLength + '</span>';
		}

		/**
		 * Slider Init
		 */
		$( '.gallery-type-slider' ).imagesLoaded( function( instance ) {

			$( instance.elements ).each( function( index, el ) {

				$( el ).flickity( {
					pageDots: $( el ).data( 'sg-page-dots' ),
					prevNextButtons: $( el ).data( 'sg-nav' ),
					adaptiveHeight: true,
					cellAlign: 'left',
					contain: true,
					on: {
						ready: function() {
							var data = Flickity.data( el );

							$( el ).addClass( 'slider-loaded' );

							if ( $( el ).data( 'sg-page-info' ) ) {

								if ( $( el ).data( 'sg-page-dots' ) ) {
									$( el ).find( '.flickity-page-dots' ).wrap( '<div class="flickity-pages"></div>' );
								} else {
									$( el ).append( '<div class="flickity-pages"></div>' );
								}

								var cellNumber = data.selectedIndex;

								$( el ).find( '.flickity-pages' ).append( '<div class="flickity-page-info">' + powerkitSliderPageInfo( cellNumber, data.cells.length ) + '</div>' );
							}

							$( document.body ).trigger( 'image-load' );
						},
						change: function( cellNumber ) {
							var data = Flickity.data( el );

							if ( $( el ).data( 'sg-page-info' ) ) {

								$( el ).find( '.flickity-page-info' ).html( powerkitSliderPageInfo( cellNumber, data.cells.length ) );
							}
						}
					}
				} );
			} );
		} );
	}

	$( document ).ready( function() {
		powerkitInitSliderGallery();
		$( document.body ).on( 'post-load', function() {
			powerkitInitSliderGallery();
		} );
	} );

} )( jQuery );