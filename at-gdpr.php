<?php
/*
Plugin Name: AT GDPR
Plugin URI: https://www.tudorache.me
Description: Adds cookies bar where the visitor can accept or reject cookies.
Version: 1.0.2
Author: Adrian Emil Tudorache
Author URI: https://www.tudorache.me
License: GPL
*/

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

define( 'ATGDPRPATH', plugin_dir_path( __FILE__ ) );
define( 'ATGDPRBASE', plugin_basename( __FILE__ ) );
define( 'ATGDPRURL', plugin_dir_url( __FILE__ ) );

/**
 * Start
 */
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
