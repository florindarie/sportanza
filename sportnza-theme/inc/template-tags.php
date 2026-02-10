<?php
/**
 * Template helper functions.
 *
 * @package Sportnza
 */

/**
 * Get the first tag of a post for the card badge.
 * Falls back to the first category name.
 *
 * @return string The tag/category name.
 */
function sportnza_get_card_tag() {
    $tags = get_the_tags();
    if ( $tags && ! is_wp_error( $tags ) ) {
        return esc_html( $tags[0]->name );
    }

    $categories = get_the_category();
    if ( $categories ) {
        return esc_html( $categories[0]->name );
    }

    return '';
}

/**
 * Get a trimmed excerpt of a specific word length.
 *
 * @param int $length Number of words.
 * @return string The trimmed excerpt.
 */
function sportnza_get_excerpt( $length = 20 ) {
    $excerpt = get_the_excerpt();
    $words   = explode( ' ', $excerpt );

    if ( count( $words ) > $length ) {
        return implode( ' ', array_slice( $words, 0, $length ) ) . '...';
    }

    return $excerpt;
}

/**
 * Get a fallback thumbnail URL if no featured image is set.
 * Maps article images from the theme's articles directory.
 *
 * @return string|false The fallback image URL or false.
 */
function sportnza_get_fallback_thumbnail() {
    $slug = get_post_field( 'post_name', get_the_ID() );
    $map  = array(
        'nba-analytics-breaking-down-the-numbers-that-matter'          => 'nba.jpg',
        'nfl-conference-championships-complete-betting-guide'          => 'nfl.jpg',
        'nhl-stanley-cup-futures-early-value-picks'                    => 'stanley-cup.jpg',
        'fantasy-hockey-finding-sleeper-picks-for-value'               => 'fantasy-nhl.jpg',
        'identifying-sell-high-candidates-in-your-fantasy-lineup'      => 'fantasy-sell-high.jpg',
        'saturday-night-hockey-special-best-bets-bonuses'              => 'saturday-hockey.jpg',
        'the-rivalry-that-defined-a-nation-senators-vs-maple-leafs'    => 'local-hubs.jpg',
        'pga-tour-analytics-data-driven-approach-to-golf-betting'      => 'pga.jpg',
        'regional-betting-insights-know-your-local-teams'              => 'rivalry.jpg',
    );

    if ( isset( $map[ $slug ] ) ) {
        return SPORTNZA_URI . '/assets/images/articles/' . $map[ $slug ];
    }

    return false;
}

/**
 * Output the site logo.
 *
 * Uses the custom logo if set in the Customizer. Otherwise, outputs the
 * SPORTAZA text logo with a green lightning-bolt SVG icon.
 */
function sportnza_logo() {
    if ( has_custom_logo() ) {
        echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="logo">';
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo_image     = wp_get_attachment_image_src( $custom_logo_id, 'full' );
        if ( $logo_image ) {
            echo '<img src="' . esc_url( $logo_image[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="logo-icon">';
        }
        echo '<span class="logo-text">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
        echo '</a>';
    } else {
        echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="logo">';
        echo '<img src="' . esc_url( SPORTNZA_URI . '/assets/images/logo.svg' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="logo-img">';
        echo '</a>';
    }
}
