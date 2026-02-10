<?php
/**
 * Front page template -- the homepage.
 * Renders hero, feature cards, our stories, shape the game, and go beyond sections.
 * No sidebar on the homepage.
 *
 * @package Sportnza
 */

get_header();
get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/feature-cards' );
?>

<section class="our-stories-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php esc_html_e( 'Our Stories', 'sportnza' ); ?></h2>
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn-outline-green"><?php esc_html_e( 'View More', 'sportnza' ); ?></a>
        </div>

        <?php
        $stories = new WP_Query( array(
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        if ( $stories->have_posts() ) :
        ?>
            <div class="stories-grid">
                <?php
                while ( $stories->have_posts() ) :
                    $stories->the_post();
                    get_template_part( 'template-parts/content', 'card' );
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_template_part( 'template-parts/shape-the-game' );
get_template_part( 'template-parts/go-beyond' );
get_footer();
?>
