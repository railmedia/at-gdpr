<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$files = array(
    'controllers/config.class.php'   => array( 'AT_GDPR_Admin_Config' ),
    'views/settings.views.class.php' => array(),
    'controllers/settings.class.php' => array( 'AT_GDPR_Admin_Settings' )
);
foreach( $files as $file => $init ) {
    require_once( $file );
    if( $init ) {
        foreach( $init as $init )
            new $init;
    }
}
?>
