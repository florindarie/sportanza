<?php
/**
 * The sidebar template.
 *
 * @package Sportnza
 */

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
    return;
}
?>

<aside class="sidebar">
    <?php dynamic_sidebar( 'sidebar-main' ); ?>
</aside>
