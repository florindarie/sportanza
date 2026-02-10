<?php
/**
 * Customizer settings for hero section.
 *
 * @package Sportnza
 */

/**
 * Register Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function sportnza_customize_register( $wp_customize ) {

    // --- Hero Section ---------------------------------------------------------
    $wp_customize->add_section( 'sportnza_hero', array(
        'title'    => __( 'Hero Section', 'sportnza' ),
        'priority' => 30,
    ) );

    // Hero background image
    $wp_customize->add_setting( 'sportnza_hero_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sportnza_hero_bg', array(
        'label'   => __( 'Hero Background Image', 'sportnza' ),
        'section' => 'sportnza_hero',
    ) ) );

    // Hero title
    $wp_customize->add_setting( 'sportnza_hero_title', array(
        'default'           => 'Claim Your Welcome Bonus',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'sportnza_hero_title', array(
        'label'   => __( 'Hero Title', 'sportnza' ),
        'section' => 'sportnza_hero',
        'type'    => 'textarea',
    ) );

    // Hero subtitle (green text above the title)
    $wp_customize->add_setting( 'sportnza_hero_subtitle', array(
        'default'           => 'Join the Fun at Sportaza',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'sportnza_hero_subtitle', array(
        'label'   => __( 'Hero Subtitle (green text above title)', 'sportnza' ),
        'section' => 'sportnza_hero',
        'type'    => 'text',
    ) );

    // Primary CTA text
    $wp_customize->add_setting( 'sportnza_hero_cta_primary_text', array(
        'default'           => 'Join Now',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'sportnza_hero_cta_primary_text', array(
        'label'   => __( 'Primary Button Text', 'sportnza' ),
        'section' => 'sportnza_hero',
        'type'    => 'text',
    ) );

    // Primary CTA URL
    $wp_customize->add_setting( 'sportnza_hero_cta_primary_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'sportnza_hero_cta_primary_url', array(
        'label'   => __( 'Primary Button URL', 'sportnza' ),
        'section' => 'sportnza_hero',
        'type'    => 'url',
    ) );

    // Secondary CTA text
    $wp_customize->add_setting( 'sportnza_hero_cta_secondary_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'sportnza_hero_cta_secondary_text', array(
        'label'   => __( 'Secondary Button Text (optional)', 'sportnza' ),
        'section' => 'sportnza_hero',
        'type'    => 'text',
    ) );

    // Secondary CTA URL
    $wp_customize->add_setting( 'sportnza_hero_cta_secondary_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'sportnza_hero_cta_secondary_url', array(
        'label'   => __( 'Secondary Button URL', 'sportnza' ),
        'section' => 'sportnza_hero',
        'type'    => 'url',
    ) );
}
add_action( 'customize_register', 'sportnza_customize_register' );
