<?php
/**
 * Template Name: About Us
 *
 * About Us page template with hero banner, text content, and sidebar navigation.
 *
 * @package Sportnza
 */

get_header();
?>

<section class="about-hero">
    <div class="hero-background">
        <img src="<?php echo esc_url( SPORTNZA_URI . '/assets/images/hero-banner.webp' ); ?>" alt="<?php esc_attr_e( 'About Sportaza', 'sportnza' ); ?>">
    </div>
    <div class="about-hero-content">
        <h1><?php esc_html_e( 'Where Every Game is Yours to Command.', 'sportnza' ); ?></h1>
        <a href="#" class="btn btn-outline-green btn-large"><?php esc_html_e( 'Play Now', 'sportnza' ); ?></a>
    </div>
</section>

<div class="about-page-content">
    <div class="container">
        <div class="about-layout">

            <div class="about-main">
                <h2 class="about-section-title"><?php esc_html_e( 'About Us', 'sportnza' ); ?></h2>

                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php if ( get_the_content() ) : ?>
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        <?php else : ?>
                            <p class="about-text">
                                <?php esc_html_e( 'Sportaza was born from a passion for sports and a belief that every fan deserves a front-row seat to the action. We set out to build a platform that combines the excitement of live sports with cutting-edge technology, creating an experience that is as thrilling as the games themselves.', 'sportnza' ); ?>
                            </p>
                            <p class="about-text">
                                <?php esc_html_e( 'Our team of sports enthusiasts, data scientists, and developers work tirelessly to deliver a platform that is fast, reliable, and packed with features. From real-time odds and in-depth statistics to live streaming and fantasy leagues, Sportaza is your all-in-one destination for sports entertainment.', 'sportnza' ); ?>
                            </p>
                            <p class="about-text">
                                <?php esc_html_e( 'We believe in fair play, responsible gaming, and putting our users first. Every feature we build, every update we ship, and every decision we make is guided by a simple principle: make the experience better for the people who love sports.', 'sportnza' ); ?>
                            </p>
                            <p class="about-text">
                                <?php esc_html_e( 'Whether you are here to follow your favorite team, test your knowledge in fantasy leagues, or explore the world of live casino gaming, Sportaza welcomes you. Join our growing community and discover what it means to truly shape the game your way.', 'sportnza' ); ?>
                            </p>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <aside class="about-sidebar">
                <nav class="about-sidebar-nav">
                    <h3><?php esc_html_e( 'Pages', 'sportnza' ); ?></h3>
                    <ul>
                        <li><a href="#"><?php esc_html_e( 'FAQ', 'sportnza' ); ?></a></li>
                        <li><a href="<?php echo esc_url( get_permalink() ); ?>" class="active"><?php esc_html_e( 'About Us', 'sportnza' ); ?></a></li>
                    </ul>
                </nav>
            </aside>

        </div>
    </div>
</div>

<?php get_footer(); ?>
