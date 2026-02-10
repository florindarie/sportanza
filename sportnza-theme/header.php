<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header">
    <div class="container">
        <div class="header-content">
            <?php sportnza_logo(); ?>

            <nav class="main-nav">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link<?php if ( is_front_page() ) echo ' active'; ?>">
                    <?php esc_html_e( 'Home', 'sportnza' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/category/sports/' ) ); ?>" class="nav-link<?php if ( is_category( 'sports' ) ) echo ' active'; ?>">
                    <?php esc_html_e( 'Sports', 'sportnza' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/category/academy/' ) ); ?>" class="nav-link<?php if ( is_category( 'academy' ) ) echo ' active'; ?>">
                    <?php esc_html_e( 'Academy', 'sportnza' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/category/promotions/' ) ); ?>" class="nav-link<?php if ( is_category( 'promotions' ) ) echo ' active'; ?>">
                    <?php esc_html_e( 'Promotions', 'sportnza' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/category/news/' ) ); ?>" class="nav-link<?php if ( is_category( 'news' ) ) echo ' active'; ?>">
                    <?php esc_html_e( 'News', 'sportnza' ); ?>
                </a>
            </nav>

            <div class="header-actions">
                <a href="#" class="btn btn-green"><?php esc_html_e( 'Join Now', 'sportnza' ); ?></a>
            </div>

            <button class="mobile-menu-btn" aria-label="<?php esc_attr_e( 'Toggle menu', 'sportnza' ); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>
