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
 * @class AT_GDPR_Admin_Config - Main admin config
 */
class AT_GDPR_Admin_Config {

    /**
     * Constructor
     * @return void
     */
    function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
    }

    /**
     * @method scripts() - Adds all required scripts and stylesheets as well as Google Analytics if applicable
     * @return void
     */
    function scripts( $hook_suffix ) {

        if( $hook_suffix == 'settings_page_at-gdpr-settings' ) {

            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'at-gdpr-admin', ATGDPRURL . 'admin/assets/js/admin.js', array( 'wp-color-picker', 'jquery' ), null, true );

        }

    }

}
?>
