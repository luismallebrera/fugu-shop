(function($) {
	
	'use strict';
    
	$(function() { // Doc ready
        // Get product-attribute form container
		var $paFormContainer = ( $('#addtag').length ) ? $('#addtag') : $('#edittag');
        // Init color picker
        $paFormContainer.find('.fugu_pa_color-picker').wpColorPicker();
	});
    
} (jQuery));