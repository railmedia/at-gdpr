<?php
/**
* @package AT GDPR
* @author  Adrian Emil Tudorache
* @license GPL-2.0+
* @link    https://www.tudorache.me/
**/

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * @class AT_GDPR_Admin_Settings - Main admin settings
 */
class AT_GDPR_Admin_Settings {

    /**
     * @var $views - Holds views for the admin settings page
     */
    private $views;

    /**
     * @var $settings - Holds settings saved in the DB
     */
    private $settings;

    /**
     * Constructor
     * @return void
     */
    function __construct() {

        $this->settings = $this->get_settings();
        $this->views = new AT_GDPR_Admin_Settings_Views;

        add_action( 'admin_menu', array( $this, 'menu' ) );
        add_action( 'admin_init', array( $this, 'display' ) );

    }

    /**
     * @method get_settings() - Fetches all existing settings from DB
     * @return array
     */
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

    /**
     * @method menu() - Adds AT GDPR admin menu item user the main Settings menu item
     * @return void
     */
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

    /**
     * @method settings() - Callback for the add_submenu_page() function declared in the menu() method
     * @return void
     */
    function settings() {
        echo $this->views->settings();
    }

    /**
     * @method display_settings() - Callback for the add_settings_section() function declared in the display() method
     * @return void
     */
    function display_settings() {
    }

    /**
     * @method display() - Registers all available settings
     * @return void
     */
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

    /**
     * @method at_gdpr_active_select() - Select box markup for at_gdpr_active settings
     * @return void
     */
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

    /**
     * @method at_gdpr_text_editor() - Editor markup for at_gdpr_active settings
     * @return void
     */
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

    /**
     * @method at_gdpr_accept_button_label_text() - Select box markup for at_gdpr_accept_button_label setting
     * @return void
     */
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

    /**
     * @method at_gdpr_reject_button_label_text() - Select box markup for at_gdpr_reject_button_label setting
     * @return void
     */
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

    /**
     * @method at_gdpr_button_color_text() - Select box markup for at_gdpr_button_color setting
     * @return void
     */
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

    /**
     * @method at_gdpr_button_hover_color_text() - Select box markup for at_gdpr_button_hover_color setting
     * @return void
     */
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

    /**
     * @method at_gdpr_button_text_color_text() - Select box markup for at_gdpr_button_text_color setting
     * @return void
     */
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

    /**
     * @method at_gdpr_button_hover_text_color_text() - Select box markup for at_gdpr_button_hover_text_color setting
     * @return void
     */
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

    /**
     * @method at_gdpr_domain_text() - Select box markup for at_gdpr_domain setting
     * @return void
     */
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

    /**
     * @method at_gdpr_ga_account_text() - Select box markup for at_gdpr_ga_account setting
     * @return void
     */
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
