(function($){

    /**
     * @object Main functionality Object
     */
    const ATGDPR = {

        /**
         * @method atCookieBar() - Renders the cookie bar if it hasn't already been closed
         * @return void
         */
        atCookieBar: function() {

            let consent = Cookies.get('CookieConsent');

            if( ! consent ) {

                var html = '<div class="at-cookie-bar">';
                html += '<div class="wrapper">';
                    html += '<div class="cookie-bar-left">' + atgdpr.t + '</div>';
                    html += '<div class="cookie-bar-right"><button class="cookie-consent" data-consent="1">' + atgdpr.acbl + '</button> <button class="cookie-consent" data-consent="0">' + atgdpr.rcbl + '</button></div>';
                html += '</div></div>';

                jQuery('body').append( html );

            }

        },

        /**
         * @method atCookieBarConsent() - Performs the required cookie bar functionality
         * @int consent - 1 or 0 depending on the choice of the user
         * @return void
         */
        atCookieBarConsent: function( consent ) {

            Cookies.set('CookieConsent', consent, { expires: 30 });
        
            jQuery('.at-cookie-bar').fadeOut().remove();
        
            if( consent == '0' ) {
                Cookies.remove('_ga', { domain: atgdpr.d });
                Cookies.remove('_gat_gtag_' + atgdpr.ga, { domain: atgdpr.d });
                Cookies.remove('_gid', { domain: atgdpr.d });
            }
        
            setTimeout(function(){
                location.reload(true);
            }, 1000);
        
        },

        /**
         * @method atCheckCookiesConsent() - Checks whether it shoudl allow Google Analytics tracking or not
         * @return void
         */
        atCheckCookiesConsent() {

            let consent = Cookies.get('CookieConsent');
        
            if( consent == 0 ) {

                setTimeout(function(){

                    Cookies.remove('_ga', { domain: atgdpr.d });
                    Cookies.remove('_gat', { domain: atgdpr.d });
                    Cookies.remove('_gat_gtag_' + atgdpr.ga, { domain: atgdpr.d });
                    Cookies.remove('_gid', { domain: atgdpr.d });

                }, 1000);

            }
        
        }

    }

    /**
     * @function Main event
     */
    jQuery(document).ready(function(){

        if( atgdpr.e !== undefined && atgdpr.e == '1' ) {
    
            ATGDPR.atCookieBar();
    
            jQuery('body').on('click', '.at-cookie-bar button', function(evt){
                evt.preventDefault();
                ATGDPR.atCookieBarConsent( jQuery(this).attr('data-consent') );
            });

            ATGDPR.atCheckCookiesConsent();
    
        }
    
    });

})(jQuery);
