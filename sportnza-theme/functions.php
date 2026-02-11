<?php
/**
 * Sportnza Theme Functions
 *
 * @package Sportnza
 * @version 1.0.0
 */

// Constants
define( 'SPORTNZA_VERSION', '2.1.0' );
define( 'SPORTNZA_DIR', get_template_directory() );
define( 'SPORTNZA_URI', get_template_directory_uri() );

// Include modular files
require_once SPORTNZA_DIR . '/inc/theme-setup.php';
require_once SPORTNZA_DIR . '/inc/customizer.php';
require_once SPORTNZA_DIR . '/inc/widgets.php';
require_once SPORTNZA_DIR . '/inc/template-tags.php';

// Content setup script (one-time use, access via ?sportnza_setup=1)
require_once SPORTNZA_DIR . '/setup-content.php';

/**
 * Enqueue styles and scripts.
 */
function sportnza_enqueue_assets() {
    // Google Fonts - Inter
    wp_enqueue_style(
        'sportnza-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'sportnza-style',
        get_stylesheet_uri(),
        array( 'sportnza-google-fonts' ),
        SPORTNZA_VERSION
    );

    // Mobile menu CSS
    wp_enqueue_style(
        'sportnza-mobile-menu',
        SPORTNZA_URI . '/assets/css/mobile-menu.css',
        array( 'sportnza-style' ),
        SPORTNZA_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'sportnza-main',
        SPORTNZA_URI . '/assets/js/main.js',
        array(),
        SPORTNZA_VERSION,
        true
    );

    // Pass theme data to JS
    wp_localize_script( 'sportnza-main', 'sportnzaData', array(
        'themeUri' => SPORTNZA_URI,
        'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'sportnza_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'sportnza_enqueue_assets' );

/**
 * Dequeue default WordPress block library CSS on the front end for cleaner styling.
 */
function sportnza_dequeue_block_styles() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'sportnza_dequeue_block_styles', 100 );
