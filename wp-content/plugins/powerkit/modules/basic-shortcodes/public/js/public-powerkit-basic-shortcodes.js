/**
 * Basic Shortcodes
 */
( function( $ ) {

	$( document ).ready( function() {

		/* Alerts */
		$( '.pk-alert .pk-close' ).on( 'click', function() {
			$( this ).closest( '.pk-alert' ).remove();
		} );

		/* Tabs */
		$( '.pk-tab-pane' ).removeClass( 'pk-fade' );

		$( '.pk-tabs .pk-nav-item .pk-nav-link' ).on( 'click', function() {
			// Nav.
			$( this ).parent().siblings().find( '.pk-active' ).removeClass( 'pk-active' );
			$( this ).addClass( 'pk-active' );

			// Pane.
			$( this ).closest( '.pk-tabs' ).find( '.pk-tab-pane' ).removeClass( 'pk-show pk-active' );
			$( this ).closest( '.pk-tabs' ).find( '.pk-tab-content' ).find( $( this ).attr( 'href' ) ).addClass( 'pk-show pk-active' );

			return false;
		} );

		/* Collapsibles */
		$( '.pk-card a[data-toggle="collapse"]' ).on( 'click', function() {

			if ( $( this ).closest( '.pk-collapsibles' ).length > 0 ) {
				$( this ).closest( '.pk-card' ).siblings().removeClass( 'expanded' );
				$( this ).closest( '.pk-card' ).siblings().find( '.pk-collapse' ).slideUp();
			}

			$( this ).closest( '.pk-card' ).toggleClass( 'expanded' ).find( $( this ).attr( 'href' ) ).slideToggle();

			return false;
		} );

	} );
} )( jQuery );