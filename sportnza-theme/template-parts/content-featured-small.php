<?php
/**
 * Template part: Small featured card (no excerpt).
 *
 * @package Sportnza
 */
?>
<article class="featured-card">
    <a href="<?php the_permalink(); ?>" class="card-link">
        <div class="card-image">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'sportnza-card' ); ?>
            <?php endif; ?>
            <?php $tag = sportnza_get_card_tag(); ?>
            <?php if ( $tag ) : ?>
                <span class="card-tag"><?php echo $tag; ?></span>
            <?php endif; ?>
        </div>
        <div class="card-content">
            <h3 class="card-title"><?php the_title(); ?></h3>
            <span class="card-date"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></span>
        </div>
    </a>
</article>
