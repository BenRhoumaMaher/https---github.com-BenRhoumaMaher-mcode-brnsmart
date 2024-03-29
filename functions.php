<?php

/**
 * Rishi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rishi
 */

$rishi_theme_data = wp_get_theme();
if (!defined('RISHI_VERSION')) define('RISHI_VERSION', $rishi_theme_data->get('Version'));

// Theme directory constant.
defined( 'RISHI_DIR__' ) || define( 'RISHI_DIR__', get_template_directory() );

// Customizer Builder assets directory.
defined( 'THEME_CUSTOMIZER_BUILDER_DIR__' ) || define( 'THEME_CUSTOMIZER_BUILDER_DIR__', RISHI_DIR__ . '/customizer-builder' );
/**
 * Query if Elementor Page Builder plugin is activated
*/
function is_elementor_activated(){
    return class_exists( 'Elementor\\Plugin' ) ? true : false; 
}

/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Standalone Functions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Dynamic Styles
 */
require get_template_directory() . '/inc/style.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Notices
 */
require get_template_directory() . '/inc/notice/notice.php';

/**
 * Elementor – Header, Footer & Blocks Template compatibility
 */
if (defined('HFE_VER')) {
	require get_template_directory() . '/inc/hfe-compatibility.php';
}

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Add theme compatibility function for woocommerce if active
 */
if ( is_elementor_activated() ) {
	require get_template_directory() . '/inc/elementor-compatibility.php';
}

/**
 * Add theme compatibility function for woocommerce if active
 */
if (rishi_is_woocommerce_activated()) {
	require get_template_directory() . '/inc/woocommerce-functions.php';
}
/**
 * Add theme compatibility function for Demo Importer Plus
 */
require get_template_directory() . '/inc/demo-importer.php';

/**
 * Theme Updater
*/
require get_template_directory() . '/updater/theme-updater.php';

/**
 * Upgrader Class
*/
require get_template_directory() . '/inc/upgrade/110.php';