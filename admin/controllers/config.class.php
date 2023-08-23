<?php
class AT_GDPR_Admin_Config {

    function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
    }


    function scripts( $hook_suffix ) {
        if( $hook_suffix == 'settings_page_at-gdpr-settings' ) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'at-gdpr-admin', ATGDPRURL . 'admin/assets/js/admin.js', array( 'wp-color-picker', 'jquery' ), null, true );
        }
    }

}
?>
