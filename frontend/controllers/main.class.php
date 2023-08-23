<?php
class AT_GDPR_Main {

    private $settings;

    function __construct() {
        $this->settings = $this->get_settings();
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
    }

    function get_settings() {

        $settings_fields = array(
            'active',
            'text',
            'accept_button_label',
            'reject_button_label',
            'domain',
            'ga_account',
            'button_color',
            'button_hover_color',
            'button_text_color',
            'button_hover_text_color'
        );
        $settings = array();
        foreach( $settings_fields as $setting ) {
            $settings[ 'at_gdpr_' . $setting ] = get_option( 'at_gdpr_' . $setting );
        }

        return $settings;

    }

    function scripts() {

        wp_enqueue_style( 'at-gdpr', ATGDPRURL . 'frontend/assets/css/at-gdpr.css' );
        $style = '.at-cookie-bar button {';
        if( isset( $this->settings['at_gdpr_button_color'] ) && $this->settings['at_gdpr_button_color'] ) {
            $style .= 'background:' . $this->settings['at_gdpr_button_color'] . ';';
        }
        if( isset( $this->settings['at_gdpr_button_text_color'] ) && $this->settings['at_gdpr_button_text_color'] ) {
            $style .= 'color:' . $this->settings['at_gdpr_button_text_color'] . ';';
        }
        $style .= '}';
        $style .= '.at-cookie-bar button:hover {';
        if( isset( $this->settings['at_gdpr_button_hover_color'] ) && $this->settings['at_gdpr_button_hover_color'] ) {
            $style .= 'background:' . $this->settings['at_gdpr_button_hover_color'] . ';';
        }
        if( isset( $this->settings['at_gdpr_button_hover_text_color'] ) && $this->settings['at_gdpr_button_hover_text_color'] ) {
            $style .= 'color:' . $this->settings['at_gdpr_button_hover_text_color'] . ';';
        }
        $style .= '}';
        wp_add_inline_style( 'at-gdpr', $style );

        wp_enqueue_script( 'at-gdpr-js-cookie', ATGDPRURL . 'frontend/assets/js/js-cookie.js', array('jquery'), null, false );

        wp_enqueue_script( 'at-gdpr', ATGDPRURL . 'frontend/assets/js/at-gdpr.js', array('jquery'), null, true );
        wp_localize_script( 'at-gdpr', 'atgdpr', array(
            'e'    => $this->settings['at_gdpr_active'],
            't'    => $this->settings['at_gdpr_text'],
            'acbl' => $this->settings['at_gdpr_accept_button_label'],
            'rcbl' => $this->settings['at_gdpr_reject_button_label'],
            'd'    => $this->settings['at_gdpr_domain'],
            'ga'   => str_replace( '-', '_', $this->settings['at_gdpr_ga_account'] ),
            'bc'   => $this->settings['at_gdpr_button_color'],
            'bhc'  => $this->settings['at_gdpr_button_hover_color'],
            'btc'  => $this->settings['at_gdpr_button_text_color'],
            'bhtc' => $this->settings['at_gdpr_button_hover_text_color']
        ) );

        //Add GA Tracking script
        wp_enqueue_script( 'at-gdpr-ga-track', 'https://www.googletagmanager.com/gtag/js?id=' . $this->settings['at_gdpr_ga_account'], array(), null, false );
        ob_start();
        ?>
        var consent = Cookies.get('CookieConsent');
        if( consent == 1 ) {
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?php echo $this->settings['at_gdpr_ga_account'] ?>',{
                'cookie_domain': '<?php echo $this->settings['at_gdpr_domain']; ?>',
            });
        }
        <?php
        wp_add_inline_script( 'at-gdpr-ga-track', ob_get_clean() );


    }

}
?>
