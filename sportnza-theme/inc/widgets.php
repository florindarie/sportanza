<?php
/**
 * Custom widgets: Promo Banner and Trending Posts.
 *
 * @package Sportnza
 */

/**
 * Promo Banner Widget — displays an image, title, text, and CTA button.
 */
class Sportnza_Promo_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'sportnza_promo',
            __( 'Sportnza Promo Banner', 'sportnza' ),
            array( 'description' => __( 'Promotional banner with image, text, and CTA button.', 'sportnza' ) )
        );
    }

    public function widget( $args, $instance ) {
        $image_url = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
        $title     = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $text      = ! empty( $instance['text'] ) ? $instance['text'] : '';
        $btn_text  = ! empty( $instance['btn_text'] ) ? $instance['btn_text'] : '';
        $btn_url   = ! empty( $instance['btn_url'] ) ? $instance['btn_url'] : '#';
        $btn_style = ! empty( $instance['btn_style'] ) ? $instance['btn_style'] : 'primary';

        echo '<div class="promo-card">';
        if ( $image_url ) {
            echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $title ) . '" class="promo-image">';
        }
        echo '<div class="promo-content">';
        if ( $title ) {
            echo '<h3 class="promo-title">' . esc_html( $title ) . '</h3>';
        }
        if ( $text ) {
            echo '<p class="promo-text">' . esc_html( $text ) . '</p>';
        }
        if ( $btn_text ) {
            echo '<a href="' . esc_url( $btn_url ) . '" class="btn btn-' . esc_attr( $btn_style ) . ' btn-full">' . esc_html( $btn_text ) . '</a>';
        }
        echo '</div></div>';
    }

    public function form( $instance ) {
        $image_url = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
        $title     = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $text      = ! empty( $instance['text'] ) ? $instance['text'] : '';
        $btn_text  = ! empty( $instance['btn_text'] ) ? $instance['btn_text'] : '';
        $btn_url   = ! empty( $instance['btn_url'] ) ? $instance['btn_url'] : '';
        $btn_style = ! empty( $instance['btn_style'] ) ? $instance['btn_style'] : 'primary';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>"><?php esc_html_e( 'Image URL:', 'sportnza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" type="url" value="<?php echo esc_url( $image_url ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'sportnza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Text:', 'sportnza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>"><?php esc_html_e( 'Button Text:', 'sportnza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_text' ) ); ?>" type="text" value="<?php echo esc_attr( $btn_text ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>"><?php esc_html_e( 'Button URL:', 'sportnza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_url' ) ); ?>" type="url" value="<?php echo esc_url( $btn_url ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btn_style' ) ); ?>"><?php esc_html_e( 'Button Style:', 'sportnza' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_style' ) ); ?>">
                <option value="primary" <?php selected( $btn_style, 'primary' ); ?>><?php esc_html_e( 'Primary (Blue)', 'sportnza' ); ?></option>
                <option value="outline" <?php selected( $btn_style, 'outline' ); ?>><?php esc_html_e( 'Outline', 'sportnza' ); ?></option>
            </select>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance              = array();
        $instance['image_url'] = ! empty( $new_instance['image_url'] ) ? esc_url_raw( $new_instance['image_url'] ) : '';
        $instance['title']     = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['text']      = ! empty( $new_instance['text'] ) ? sanitize_text_field( $new_instance['text'] ) : '';
        $instance['btn_text']  = ! empty( $new_instance['btn_text'] ) ? sanitize_text_field( $new_instance['btn_text'] ) : '';
        $instance['btn_url']   = ! empty( $new_instance['btn_url'] ) ? esc_url_raw( $new_instance['btn_url'] ) : '';
        $instance['btn_style'] = ! empty( $new_instance['btn_style'] ) ? sanitize_text_field( $new_instance['btn_style'] ) : 'primary';
        return $instance;
    }
}

/**
 * Trending Posts Widget — displays recent posts with thumbnails.
 */
class Sportnza_Trending_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'sportnza_trending',
            __( 'Sportnza Trending Posts', 'sportnza' ),
            array( 'description' => __( 'Displays recent trending posts with thumbnails.', 'sportnza' ) )
        );
    }

    public function widget( $args, $instance ) {
        $count = ! empty( $instance['count'] ) ? absint( $instance['count'] ) : 3;
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Trending Now', 'sportnza' );

        $query = new WP_Query( array(
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        if ( ! $query->have_posts() ) {
            wp_reset_postdata();
            return;
        }

        echo '<div class="trending-section">';
        echo '<h3 class="sidebar-title">' . esc_html( $title ) . '</h3>';
        echo '<div class="trending-list">';

        while ( $query->have_posts() ) :
            $query->the_post();
            get_template_part( 'template-parts/content', 'trending' );
        endwhile;
        wp_reset_postdata();

        echo '</div></div>';
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Trending Now', 'sportnza' );
        $count = ! empty( $instance['count'] ) ? absint( $instance['count'] ) : 3;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'sportnza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'sportnza' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" min="1" max="10" value="<?php echo esc_attr( $count ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance          = array();
        $instance['title'] = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['count'] = ! empty( $new_instance['count'] ) ? absint( $new_instance['count'] ) : 3;
        return $instance;
    }
}

/**
 * Register custom widgets.
 */
function sportnza_register_widgets() {
    register_widget( 'Sportnza_Promo_Widget' );
    register_widget( 'Sportnza_Trending_Widget' );
}
add_action( 'widgets_init', 'sportnza_register_widgets' );
