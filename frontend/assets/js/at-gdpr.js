jQuery(document).ready(function(){

    if( atgdpr.e !== undefined && atgdpr.e == '1' ) {

        at_cookie_bar();

    	jQuery('body').on('click', '.at-cookie-bar button', function(e){
    		e.preventDefault();
    		at_cookie_bar_consent( jQuery(this).attr('data-consent') );
    	});

    	at_check_cookies_consent();

    }

});

function at_cookie_bar() {

    var consent = Cookies.get('CookieConsent');

    if( ! consent ) {

        var html = '<div class="at-cookie-bar">';
        html += '<div class="wrapper">';
            html += '<div class="cookie-bar-left">' + atgdpr.t + '</div>';
            html += '<div class="cookie-bar-right"><button class="cookie-consent" data-consent="1">' + atgdpr.acbl + '</button> <button class="cookie-consent" data-consent="0">' + atgdpr.rcbl + '</button></div>';
        html += '</div></div>';

        jQuery('body').append( html );

    }

}

function at_cookie_bar_consent( consent ) {

    Cookies.set('CookieConsent', consent, { expires: 30 });

    jQuery('.at-cookie-bar').fadeOut().remove();

    if( consent == '0' ) {
        Cookies.remove('_ga', { domain: atgdpr.d });
        Cookies.remove('_gat_gtag_' + atgdpr.ga, { domain: atgdpr.d });
        Cookies.remove('_gid', { domain: atgdpr.d });
    }

	setTimeout(function(){
		location.reload(true);
	}, 1000)

}

function at_check_cookies_consent() {

    var consent = Cookies.get('CookieConsent');

    if( consent == 0 ) {
        setTimeout(function(){
            Cookies.remove('_ga', { domain: atgdpr.d });
			Cookies.remove('_gat', { domain: atgdpr.d });
            Cookies.remove('_gat_gtag_' + atgdpr.ga, { domain: atgdpr.d });
            Cookies.remove('_gid', { domain: atgdpr.d });
        }, 1000)
    }

}
