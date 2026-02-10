<?php
/**
 * Single post template.
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
                    <?php $tag = sportnza_get_card_tag(); ?>
                    <?php if ( $tag ) : ?>
                        <span class="card-tag"><?php echo $tag; ?></span>
                    <?php endif; ?>
                    <h1 class="hero-title"><?php the_title(); ?></h1>
                    <span class="card-date"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></span>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="single-featured-image">
                        <?php the_post_thumbnail( 'sportnza-featured-large' ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <nav class="post-navigation">
                    <?php
                    the_post_navigation( array(
                        'prev_text' => '&larr; %title',
                        'next_text' => '%title &rarr;',
                    ) );
                    ?>
                </nav>
            <?php endwhile; ?>
        </article>
    </div>
</main>

<?php get_footer(); ?>
