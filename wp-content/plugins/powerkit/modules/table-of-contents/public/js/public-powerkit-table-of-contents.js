/**
 * Table of Contents
 */
( function( $ ) {

	$( document ).ready( function() {

		var pk_toc_container  = '.entry-content';
		var pk_toc_wpadminbar = 0;
		var pk_toc_offset     = 80;

		// Get height adminbar.
		if ( $( '#wpadminbar' ).length > 0 ) {
			pk_toc_wpadminbar = $( '#wpadminbar' ).outerHeight();

			if ( 'absolute' === $( '#wpadminbar' ).css( 'position' ) ) {
				pk_toc_wpadminbar = 0;
			}
		}

		/**
		 * TOC: Scroll to Heading.
		 */
		$( document ).on( 'click', '.pk-toc a', function() {

			let objContent = $( pk_toc_container );

			// If the list is found inside the content.
			if ( $( this ).closest( pk_toc_container ).length > 0 ) {
				objContent = $( this ).closest( pk_toc_container );
			}

			// Get position heading.
			let offsetHeading = $( objContent ).find( $( this ).attr( 'href' ) ).offset();

			if ( typeof offsetHeading === 'undefined' ) {
				return;
			}

			let positionHeading = offsetHeading.top;

			// Scroll to Heading.
			$( 'body, html' ).animate( {
				scrollTop: positionHeading - pk_toc_wpadminbar - pk_toc_offset
			}, 400 );

			return false;
		} );

		/**
		 * TOC: Active element of toc widget.
		 */
		$( window ).scroll( function() {
			var scrollTop = $( window ).scrollTop();

			$( '.powerkit_toc_widget' ).first().find( '.pk-toc a' ).each( function( index, elem ) {

				// Get position heading.
				let offsetHeading = $( $( elem ).attr( 'href' ) ).offset();

				if ( typeof offsetHeading === 'undefined' ) {
					return;
				}

				let positionHeading = offsetHeading.top;

				if ( positionHeading - scrollTop - pk_toc_wpadminbar - pk_toc_offset <= 0 ) {
					let filterElem = '[href="%1s"]'.replace( '%1s', $( elem ).attr( 'href' ) );

					// Find menu element.
					let menuElem = $( '.powerkit_toc_widget .pk-toc' ).find( 'a' ).filter( filterElem );

					// Remove class active.
					$( '.powerkit_toc_widget .pk-toc li' ).removeClass( 'active active-child' );

					// Add class active.
					$( menuElem ).parents( 'li' ).addClass( 'active-child' );
					$( menuElem ).parent( 'li' ).addClass( 'active' );
				}
			} );
		} );

	} );

} )( jQuery );
