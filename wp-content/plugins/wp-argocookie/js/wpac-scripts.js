jQuery( window ).ready( function(){
		
	// COOKIE REGISTER
	var dominio = document.domain;	
	var nomeCookie 	=  dominio + '_argocookie';
	var scadenza = parseInt( jQuery( '.cookie-content' ).attr( 'data-rel' ) );
	
	jQuery( '.close-cookie, a:not( #cookies .cookie-text a )' ).click( function() {
		jQuery.cookie( nomeCookie, true, { expires: scadenza, path: '' });
		jQuery( '#cookies' ).hide();
	});
	
	jQuery( window ).scroll( function() {
		if ( jQuery( window ).scrollTop() > 800) {
			jQuery.cookie( nomeCookie, true, { expires: scadenza, path: '' });
			jQuery( '#cookies' ).hide();
		}
	});

	var cookie = jQuery.cookie( nomeCookie );
	if ( !cookie ){
		jQuery( '#cookies' ).show();
	}
	
});