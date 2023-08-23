<?php
/*
Plugin Name: AT GDPR
Plugin URI: https://www.tudorache.me
Description: Adds cookies bar where the visitor can accept or reject cookies.
Version: 1.0.1
Author: Adrian Emil Tudorache
Author URI: https://www.tudorache.me
License: GPL
*/

define( 'ATGDPRPATH', plugin_dir_path( __FILE__ ) );
define( 'ATGDPRBASE', plugin_basename( __FILE__ ) );
define( 'ATGDPRURL', plugin_dir_url( __FILE__ ) );

class AT_GDPR_Fire {

    public static function init() {
        require_once( __DIR__ . '/frontend/init.php' );
        if( is_admin() ) {
        require_once( __DIR__ . '/admin/init.php' );
        }
    }

}

AT_GDPR_Fire::init();

?>
