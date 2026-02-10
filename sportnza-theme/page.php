<?php
/**
 * Generic page template.
 *
 * @package Sportnza
 */

get_header();
?>

<main class="single-page">
    <div class="container">
        <article class="single-article">
            <?php while ( have_posts() ) : the_post(); ?>
                <header class="single-header">
                    <h1 class="hero-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        </article>
    </div>
</main>

<?php get_footer(); ?>
