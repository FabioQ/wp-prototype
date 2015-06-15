( function( $ ) {
		
	// Add Color Picker to all inputs that have 'color-field' class
    $( function() {
		$('.wpac-color-picker').iris({
			color: false,
			mode: 'hsl',
			hide: true,
			palettes: ['#FF0000', '#FFFF26', '#00D900', '#007FFF', '#FF26C9', '#666667']
		});
    });
     
})( jQuery );