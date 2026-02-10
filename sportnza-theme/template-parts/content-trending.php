<?php
/**
 * Template part: Trending sidebar item.
 *
 * @package Sportnza
 */
?>
<a href="<?php the_permalink(); ?>" class="trending-item">
    <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'sportnza-trending', array( 'class' => 'trending-image' ) ); ?>
    <?php endif; ?>
    <div class="trending-content">
        <?php $tag = sportnza_get_card_tag(); ?>
        <?php if ( $tag ) : ?>
            <span class="trending-tag"><?php echo $tag; ?></span>
        <?php endif; ?>
        <h4 class="trending-title"><?php the_title(); ?></h4>
    </div>
</a>
