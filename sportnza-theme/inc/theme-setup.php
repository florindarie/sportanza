<?php
/**
 * Theme setup: supports, menus, image sizes, categories, widget areas.
 *
 * @package Sportnza
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function sportnza_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    // Custom image sizes matching the design
    add_image_size( 'sportnza-featured-large', 1920, 1080, true );
    add_image_size( 'sportnza-card', 800, 450, true );
    add_image_size( 'sportnza-hero', 1173, 400, true );

    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    add_theme_support( 'custom-logo', array(
        'height'      => 40,
        'width'       => 40,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'sportnza' ),
    ) );

    add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'sportnza_theme_setup' );

/**
 * Pre-create the categories matching the site navigation.
 */
function sportnza_create_default_categories() {
    $categories = array(
        'Sports'     => 'sports',
        'Academy'    => 'academy',
        'Promotions' => 'promotions',
        'News'       => 'news',
    );

    foreach ( $categories as $name => $slug ) {
        if ( ! term_exists( $slug, 'category' ) ) {
            wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'after_switch_theme', 'sportnza_create_default_categories' );

/**
 * Allow SVG uploads.
 */
function sportnza_allow_svg( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'sportnza_allow_svg' );
