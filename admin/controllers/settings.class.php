<?php
class AT_GDPR_Admin_Settings {

    private $views, $settings;

    function __construct() {
        $this->settings = $this->get_settings();
        $this->views = new AT_GDPR_Admin_Settings_Views;
        add_action( 'admin_menu', array( $this, 'menu' ) );
        add_action( 'admin_init', array( $this, 'display' ) );
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

    function menu() {

        add_submenu_page(
            'options-general.php',
            __( 'AT GDPR', 'at-gdpr' ),
            __( 'AT GDPR', 'at-gdpr' ),
            'manage_options',
            'at-gdpr-settings',
            array( $this, 'settings' )
        );

    }

    function settings() {
        echo $this->views->settings();
    }

    function display_settings() {
        //echo 'Settings';
    }

    function display() {

        add_settings_section('at_gdpr_settings', __('General Settings', 'at-gdpr'), array( $this, 'display_settings' ), 'at_gdpr');

        add_settings_field(
            'at_gdpr_active', //ID
            'Active', //Name
            array( $this, 'at_gdpr_active_select' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_active' );

        add_settings_field(
            'at_gdpr_text', //ID
            'Cookie Bar Text', //Name
            array( $this, 'at_gdpr_text_editor' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_text' );

        add_settings_field(
            'at_gdpr_accept_button_label', //ID
            'Accept cookies button label', //Name
            array( $this, 'at_gdpr_accept_button_label_text' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_accept_button_label' );

        add_settings_field(
            'at_gdpr_reject_button_label', //ID
            'Reject cookies button label', //Name
            array( $this, 'at_gdpr_reject_button_label_text' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_reject_button_label' );

        add_settings_field(
            'at_gdpr_domain', //ID
            'Domain', //Name
            array( $this, 'at_gdpr_domain_text' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_domain' );

        add_settings_field(
            'at_gdpr_ga_account', //ID
            'Google Analytics account', //Name
            array( $this, 'at_gdpr_ga_account_text' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_ga_account' );

        add_settings_field(
            'at_gdpr_button_color', //ID
            'Button color', //Name
            array( $this, 'at_gdpr_button_color_text' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_button_color' );

        add_settings_field(
            'at_gdpr_button_hover_color', //ID
            'Button hover color', //Name
            array( $this, 'at_gdpr_button_hover_color_text' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_button_hover_color' );

        add_settings_field(
            'at_gdpr_button_text_color', //ID
            'Button text color', //Name
            array( $this, 'at_gdpr_button_text_color_text' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_button_text_color' );

        add_settings_field(
            'at_gdpr_button_hover_text_color', //ID
            'Button hover text color', //Name
            array( $this, 'at_gdpr_button_hover_text_color_text' ), //Calback
            'at_gdpr', //Page
            'at_gdpr_settings', //Settings Section
            array() //Args
        );

        register_setting( 'at_gdpr_settings', 'at_gdpr_button_hover_text_color' );

    }

    function at_gdpr_active_select() {

        $value = $this->settings['at_gdpr_active'];

        echo $this->views->markup(
            'select',
            array(
                'options' => array( '1' => 'Yes', '0' => 'No' ),
                'value'   => $value,
                'id'      => 'at_gdpr_active'
            )
        );

    }

    function at_gdpr_text_editor() {

        $value = $this->settings['at_gdpr_text'];

        echo $this->views->markup(
            'editor',
            array(
                'value'   => $value,
                'id'      => 'at_gdpr_text'
            )
        );

    }

    function at_gdpr_accept_button_label_text() {

        $value = $this->settings['at_gdpr_accept_button_label'];

        echo $this->views->markup(
            'text',
            array(
                'value'   => $value,
                'id'      => 'at_gdpr_accept_button_label'
            )
        );

    }

    function at_gdpr_reject_button_label_text() {

        $value = $this->settings['at_gdpr_reject_button_label'];

        echo $this->views->markup(
            'text',
            array(
                'value'   => $value,
                'id'      => 'at_gdpr_reject_button_label'
            )
        );

    }

    function at_gdpr_button_color_text() {

        $value = $this->settings['at_gdpr_button_color'];

        echo $this->views->markup(
            'text',
            array(
                'value'   => $value,
                'id'      => 'at_gdpr_button_color'
            )
        );

    }

    function at_gdpr_button_hover_color_text() {

        $value = $this->settings['at_gdpr_button_hover_color'];

        echo $this->views->markup(
            'text',
            array(
                'value'   => $value,
                'id'      => 'at_gdpr_button_hover_color'
            )
        );

    }

    function at_gdpr_button_text_color_text() {

        $value = $this->settings['at_gdpr_button_text_color'];

        echo $this->views->markup(
            'text',
            array(
                'value'   => $value,
                'id'      => 'at_gdpr_button_text_color'
            )
        );

    }

    function at_gdpr_button_hover_text_color_text() {

        $value = $this->settings['at_gdpr_button_hover_text_color'];

        echo $this->views->markup(
            'text',
            array(
                'value'   => $value,
                'id'      => 'at_gdpr_button_hover_text_color'
            )
        );

    }

    function at_gdpr_domain_text() {

        $value = $this->settings['at_gdpr_domain'];

        $value = $value ? $value : $_SERVER['SERVER_NAME'];

        echo $this->views->markup(
            'text',
            array(
                'value'   => $value,
                'id'      => 'at_gdpr_domain'
            )
        );

    }

    function at_gdpr_ga_account_text() {

        $value = $this->settings['at_gdpr_ga_account'];

        echo $this->views->markup(
            'text',
            array(
                'value'   => $value,
                'id'      => 'at_gdpr_ga_account'
            )
        );

    }


}
?>
