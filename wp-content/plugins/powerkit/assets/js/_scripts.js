/**
 * Global Powerkit Scripts
 */

jQuery( document ).ready( function( $ ) {

	// ToolTip.
	$( '.pk-tippy' ).each(function( index, element ) {
		tippy( element, {
			arrow: true,
			interactive: true,
			placement: 'bottom',
			html: $( element ).find( '.pk-alert' )[0]
		});
	});

} );
