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
 * Include dependencies
 */
$files = array(
    'controllers/main.class.php' => array( 'AT_GDPR_Main' )
);
foreach( $files as $file => $init ) {
    require_once( $file );
    if( $init ) {
        foreach( $init as $init )
            new $init;
    }
}
?>
