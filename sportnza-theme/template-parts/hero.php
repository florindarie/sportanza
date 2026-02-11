<?php
/**
 * Template part: Hero section (Customizer-driven).
 *
 * @package Sportnza
 */

$hero_bg       = get_theme_mod( 'sportnza_hero_bg', '' );
$hero_title    = get_theme_mod( 'sportnza_hero_title', 'Claim Your Welcome Bonus' );
$hero_subtitle = get_theme_mod( 'sportnza_hero_subtitle', 'Join the Fun at Sportaza' );
$cta1_text     = get_theme_mod( 'sportnza_hero_cta_primary_text', 'Join Now' );
$cta1_url      = get_theme_mod( 'sportnza_hero_cta_primary_url', '#' );

$default_bg = SPORTNZA_URI . '/assets/images/hero-banner.jpg';
if ( empty( $hero_bg ) || false !== strpos( $hero_bg, 'hero-banner.' ) ) {
    $hero_bg = $default_bg;
}
?>
<section class="hero">
    <div class="hero-background">
        <img src="<?php echo esc_url( $hero_bg ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="hero-image">
    </div>
    <div class="container">
        <div class="hero-content">
            <span class="hero-subtitle-top"><?php echo esc_html( sportnza_t( $hero_subtitle ) ); ?></span>
            <h1 class="hero-title"><?php echo esc_html( sportnza_t( $hero_title ) ); ?></h1>
            <p class="hero-offer"><?php echo esc_html( sportnza_t( 'Sports: Up to €100, Casino: Up to €500' ) ); ?></p>
            <div class="hero-cta">
                <a href="<?php echo esc_url( $cta1_url ); ?>" class="btn btn-green btn-large btn-skew"><span><?php echo esc_html( sportnza_t( $cta1_text ) ); ?></span></a>
            </div>
        </div>
    </div>
</section>
