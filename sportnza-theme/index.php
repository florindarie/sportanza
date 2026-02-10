<?php
/**
 * The main template file (required fallback).
 *
 * @package Sportnza
 */

get_header();
?>

<main class="archive-page">
    <div class="container">
        <h1 class="archive-title"><?php esc_html_e( 'Latest Posts', 'sportnza' ); ?></h1>

        <?php if ( have_posts() ) : ?>
            <div class="archive-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/content', 'card' ); ?>
                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
            ) ); ?>
        <?php else : ?>
            <p class="text-muted"><?php esc_html_e( 'No posts found.', 'sportnza' ); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
