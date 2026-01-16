(function($) {
	
	'use strict';
	
	// Extend core script
	$.extend($.nmTheme, {
		
		/**
		 *	Initialize checkout scripts
		 */
		checkout_init: function() {
            var self = this;
            
            
            /* Bind: Login link */
            $('.showlogin').on('click.nmShowForm', function(e) {
                e.preventDefault();
                self.loginCouponShowForm('#fugu-checkout-login-form', 'fugu-login-popup');
            });
            
            
            /* Bind: Coupon link */
            $('.showcoupon').on('click.nmShowForm', function(e) {
                e.preventDefault();
                self.loginCouponShowForm('#fugu-coupon-login-form', 'fugu-coupon-popup');
            });
            
            
            /* Bind: Payment methods input/radio-button */
            var paymentsAnim = false;
            self.$document.on('change', '.wc_payment_methods li > .input-radio', function(e) {
                var $this = $(this).parent('li'),
                    $active = $this.parent('.wc_payment_methods').children('.active');
                
                $active.removeClass('active');
                $this.addClass('active');
                
                if (!paymentsAnim) {
                    $active.children('.payment_box').hide();
                    $this.children('.payment_box').show();
                }
            });
            
            
            /* T&C link: Bind */
            if (fugu_wp_vars.checkoutTacLightbox !== '0') {
                self.$document.on('click', '.woocommerce-terms-and-conditions-link', function(e) {
                    e.preventDefault();
                    
                    var $popupContent = $('.woocommerce-terms-and-conditions');
                    $popupContent.addClass('entry-content'); // Add class for content styling
                    
                    $.magnificPopup.open({
                        mainClass: 'fugu-checkout-tac-popup fugu-mfp-fade-in',
                        closeMarkup: '<a class="mfp-close fugu-font fugu-font-close2"></a>',
                        removalDelay: 180,
                        items: {
                            src: $popupContent,
                            type: 'inline'
                        }
                    });
                });
            }
		},
        
        
        /**
		 *    Login/Coupon: Show popup form
		 */
		loginCouponShowForm: function($formContainer, containerClass) {
            $.magnificPopup.open({
                mainClass: containerClass + ' fugu-mfp-fade-in',
                alignTop: true,
                closeMarkup: '<a class="mfp-close fugu-font fugu-font-close2"></a>',
                removalDelay: 180,
                items: {
                    src: $formContainer,
                    type: 'inline'
                }
            });
        }
		
	});
	
    
	// Add extension so it can be called from $.nmThemeExtensions
	$.nmThemeExtensions.checkout = $.nmTheme.checkout_init;
	
    
    // jQuery doc ready
    $(function() {
        /*
         * T&C link: Unbind - Default WooCommerce "click" event
         *
         * Note: Bound inside jQuery doc ready by WooCommerce
         */
        if (fugu_wp_vars.checkoutTacLightbox !== '0') {
            $(document.body).off('click', 'a.woocommerce-terms-and-conditions-link');
        }
    });
    
})(jQuery);
