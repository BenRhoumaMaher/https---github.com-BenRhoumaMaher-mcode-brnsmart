<?php
/**
 * Demo Importer Plus compatibility settings
 */

add_filter( 'demo_importer_plus_api_url', function( $api_url ) {
    return 'https://rishidemos.com/';
} );
