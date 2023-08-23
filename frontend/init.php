<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

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
