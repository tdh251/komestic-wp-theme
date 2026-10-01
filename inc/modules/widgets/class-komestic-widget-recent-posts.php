<?php defined( 'ABSPATH' ) or exit( -1 );
/**
 * Recent Posts widgets
 * @package Case-Themes
 */

class Komestic_Widget_Recent_Posts extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'pxl_recent_posts',
            esc_html__( 'Komestic Recent Posts', 'komestic' ),
            array(
                'description' => esc_html__( 'Your site’s most recent Posts.', 'komestic' ),
                'customize_selective_refresh' => true,
            )
        );
    }

    function widget( $args, $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'         => '',
            'number'        => 3,
            'post_in'        => '',
        ) );

        $title = $instance['title'];
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo wp_kses_post($args['before_widget']);

        echo wp_kses_post($args['before_title']) . wp_kses_post($title) . wp_kses_post($args['after_title']);

        $number = absint( $instance['number'] );
        if ( $number <= 0 || $number > 10)
        {
            $number = 4;
        }
        $post_in = $instance['post_in'];
        $sticky = '';
        if($post_in == 'featured') {
            $sticky = get_option( 'sticky_posts' );
        }
        $r = new WP_Query( array(
            'post_type'           => 'post',
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'post__in'  => $sticky,
            'post__not_in' => [get_the_ID()],
        ) );
        $i = 0;

        if ( $r->have_posts() ) : ?>
            <div class="post-list">
                <?php while ( $r->have_posts() ) :
                    $r->the_post();
                    global $post; 
                    $thumbnail = komestic_get_image_by_size([
                        'img_dimension' => [
                            'width' => 767,
                            'height' => 767,
                        ] ,
                        'attr' => [
                            'class' => 'no-lazyload'
                        ]
                    ], $post->ID);
                    $comment_number = get_comments_number();
                    $comment_show = ($comment_number == 0) ? 'No Comment' :  $comment_number.' Comment';
                    ?>
                    <div class="post-list__item">
                        <div class="post-list__featured">
                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        </div>
                        <div class="post-list__content">
                            <div class="post-list__meta">
                                <div class="post-list__date">
                                    <?php echo get_the_date('d M, Y'); ?>
                                </div>
                                <?php echo __('/', 'komestic'); ?>
                                <div class="post-list__comment">
                                    <?php echo esc_html($comment_show); ?>
                                </div>
                            </div>
                            <div class="post-list__title">
                                <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_html(get_the_title()); ?>">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php  $i++; endwhile; ?>
            </div>
        <?php 
            wp_reset_postdata();
            wp_reset_query();
            else : ?>
                <p class="post-list--null"><?php echo esc_html__('No posts found!', 'komestic'); ?></p>
        <?php 
            endif;
        echo wp_kses_post($args['after_widget']);
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title']         = sanitize_text_field( $new_instance['title'] );
        $instance['number']        = absint( $new_instance['number'] );
        $instance['post_in'] = strip_tags($new_instance['post_in']);
        return $instance;
    }

    function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'         => esc_html__( 'Recent Posts', 'komestic' ),
            'number'        => 4,
        ) );

        $title         = $instance['title'];
        $number        = absint( $instance['number'] );
        $post_in = isset($instance['post_in']) ? esc_attr($instance['post_in']) : '';

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p><label for="<?php echo esc_url($this->get_field_id('post_in')); ?>"><?php esc_html_e( 'Post in', 'komestic' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_in') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_in') ); ?>">
                <option value="recent"<?php if( $post_in == 'recent' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Recent', 'komestic'); ?></option>
                <option value="featured"<?php if( $post_in == 'featured' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Featured', 'komestic'); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'komestic' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>

        <?php
    }
}

add_action( 'widgets_init', 'komestic_register_recent_posts_widget' );
function komestic_register_recent_posts_widget(){
    if(function_exists('pxl_register_wp_widget')){
        pxl_register_wp_widget( 'Komestic_Widget_Recent_Posts' );
    }
}