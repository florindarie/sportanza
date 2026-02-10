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

if ( empty( $hero_bg ) ) {
    $hero_bg = SPORTNZA_URI . '/assets/images/hero-banner.webp';
}
?>
<section class="hero">
    <div class="hero-background">
        <img src="<?php echo esc_url( $hero_bg ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="hero-image">
    </div>
    <div class="container">
        <div class="hero-content">
            <span class="hero-subtitle-top"><?php echo esc_html( $hero_subtitle ); ?></span>
            <h1 class="hero-title"><?php echo wp_kses_post( $hero_title ); ?></h1>
            <p class="hero-offer"><?php echo esc_html( 'Sports: Up to €100, Casino: Up to €500' ); ?></p>
            <div class="hero-cta">
                <a href="<?php echo esc_url( $cta1_url ); ?>" class="btn btn-outline-green btn-large"><?php echo esc_html( $cta1_text ); ?></a>
            </div>
        </div>
    </div>
</section>
