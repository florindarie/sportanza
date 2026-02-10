<?php
/**
 * 404 page template.
 *
 * @package Sportnza
 */

get_header();
?>

<main class="main-content" style="margin-top: 72px;">
    <div class="container">
        <div class="error-404">
            <h1>404</h1>
            <p><?php esc_html_e( 'Oops! The page you\'re looking for doesn\'t exist.', 'sportnza' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-large"><?php esc_html_e( 'Back to Home', 'sportnza' ); ?></a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
