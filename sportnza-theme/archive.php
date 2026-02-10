<?php
/**
 * Category / archive template.
 * Displays breadcrumbs, category title, featured article, 3-column grid, and pagination.
 *
 * @package Sportnza
 */

get_header();

$archive_title = '';
if ( is_category() ) {
    $archive_title = single_cat_title( '', false );
} elseif ( is_tag() ) {
    $archive_title = single_tag_title( '', false );
} elseif ( is_author() ) {
    $archive_title = get_the_author();
} else {
    $archive_title = __( 'Archives', 'sportnza' );
}
?>

<main class="archive-page">
    <div class="container">

        <nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportnza' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportnza' ); ?></a>
            <?php if ( is_category() ) : ?>
                <?php
                $current_cat = get_queried_object();
                if ( $current_cat && $current_cat->parent ) :
                    $parent_cat = get_category( $current_cat->parent );
                    if ( $parent_cat && ! is_wp_error( $parent_cat ) ) :
                ?>
                    <span class="separator">&gt;</span>
                    <a href="<?php echo esc_url( get_category_link( $parent_cat->term_id ) ); ?>"><?php echo esc_html( $parent_cat->name ); ?></a>
                <?php
                    endif;
                endif;
                ?>
                <span class="separator">&gt;</span>
                <span class="current"><?php echo esc_html( $archive_title ); ?></span>
            <?php else : ?>
                <span class="separator">&gt;</span>
                <span class="current"><?php echo esc_html( $archive_title ); ?></span>
            <?php endif; ?>
        </nav>

        <h1 class="archive-title"><?php echo esc_html( $archive_title ); ?></h1>

        <?php if ( have_posts() ) : ?>

            <?php
            // Featured article: show the first post in a large 2-column layout.
            the_post();
            ?>
            <article class="featured-article">
                <div class="featured-image">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'sportnza-featured-large' ); ?></a>
                    <?php elseif ( $fallback = sportnza_get_fallback_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $fallback ); ?>" alt="<?php the_title_attribute(); ?>"></a>
                    <?php endif; ?>
                </div>
                <div class="featured-content">
                    <?php $tag = sportnza_get_card_tag(); ?>
                    <?php if ( $tag ) : ?>
                        <span class="card-tag" style="position:static;display:inline-block;margin-bottom:1rem;align-self:flex-start;"><?php echo $tag; ?></span>
                    <?php endif; ?>
                    <h2 class="featured-title"><?php the_title(); ?></h2>
                    <p class="featured-excerpt"><?php echo esc_html( sportnza_get_excerpt( 30 ) ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-green"><?php esc_html_e( 'Explore More', 'sportnza' ); ?></a>
                </div>
            </article>

            <?php if ( have_posts() ) : ?>
                <div class="archive-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', 'card' );
                    endwhile;
                    ?>
                </div>

                <?php the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ) ); ?>
            <?php endif; ?>

        <?php else : ?>
            <p class="text-muted"><?php esc_html_e( 'No posts found in this category.', 'sportnza' ); ?></p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
