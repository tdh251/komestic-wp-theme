<?php
/**
 * Custom Widget: Socials
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


class Komestic_Widget_Socials extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'komestic_widget_socials',
            esc_html__( 'Komestic Socials', 'komestic' ), 
            array( 'description' => esc_html__( '.', 'komestic' ), ) 
        );
    }

    public function widget( $args, $instance ) {
        pxl_print_html($args['before_widget']); 
        $title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Follow Us', 'komestic' );
        if ( ! empty( $title ) ) {
            pxl_print_html( $args['before_title'] . $title . $args['after_title'] );
        }

        $items = array(
            array(
                'image_id' => ! empty( $instance['item1_image'] ) ? $instance['item1_image'] : '', 
                'link' => ! empty( $instance['item1_link'] ) ? $instance['item1_link'] : '#',
            ),
            array(
                'image_id' => ! empty( $instance['item2_image'] ) ? $instance['item2_image'] : '',
                'link' => ! empty( $instance['item2_link'] ) ? $instance['item2_link'] : '#',
            ),
            array(
                'image_id' => ! empty( $instance['item3_image'] ) ? $instance['item3_image'] : '',
                'link' => ! empty( $instance['item3_link'] ) ? $instance['item3_link'] : '#',
            ),
            array(
                'image_id' => ! empty( $instance['item4_image'] ) ? $instance['item4_image'] : '',
                'link' => ! empty( $instance['item4_link'] ) ? $instance['item4_link'] : '#',
            ),
            array(
                'image_id' => ! empty( $instance['item5_image'] ) ? $instance['item5_image'] : '',
                'link' => ! empty( $instance['item5_link'] ) ? $instance['item5_link'] : '#',
            ),
        );
        ?>
        <ul class="social">
            <?php foreach ( $items as $key => $item ) : 
                $image_html = komestic_get_image_html_or_svg_content($item['image_id']);
            ?>
                <li class="social__item">
                    <a href="<?php echo esc_url($item['link']); ?>" class="social__item-link">
                        <?php pxl_print_html($image_html); ?>                            
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php

        pxl_print_html( $args['after_widget'] );
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        $instance['item1_image'] = ( ! empty( $new_instance['item1_image'] ) ) ? absint( $new_instance['item1_image'] ) : '';
        $instance['item1_link'] = ( ! empty( $new_instance['item1_link'] ) ) ? sanitize_text_field( $new_instance['item1_link'] ) : '';

        $instance['item2_image'] = ( ! empty( $new_instance['item2_image'] ) ) ? absint( $new_instance['item2_image'] ) : '';
        $instance['item2_link'] = ( ! empty( $new_instance['item2_link'] ) ) ? sanitize_text_field( $new_instance['item2_link'] ) : '';

        $instance['item3_image'] = ( ! empty( $new_instance['item3_image'] ) ) ? absint( $new_instance['item3_image'] ) : '';
        $instance['item3_link'] = ( ! empty( $new_instance['item3_link'] ) ) ? sanitize_text_field( $new_instance['item3_link'] ) : '';
        
        $instance['item4_image'] = ( ! empty( $new_instance['item4_image'] ) ) ? absint( $new_instance['item4_image'] ) : '';
        $instance['item4_link'] = ( ! empty( $new_instance['item4_link'] ) ) ? sanitize_text_field( $new_instance['item4_link'] ) : '';

        $instance['item5_image'] = ( ! empty( $new_instance['item5_image'] ) ) ? absint( $new_instance['item5_image'] ) : '';
        $instance['item5_link'] = ( ! empty( $new_instance['item5_link'] ) ) ? sanitize_text_field( $new_instance['item5_link'] ) : '';
        return $instance;
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Follow Us', 'komestic' );

        $item1_image_id = ! empty( $instance['item1_image'] ) ? $instance['item1_image'] : '';
        $item1_link = ! empty( $instance['item1_link'] ) ? $instance['item1_link'] : '#';

        $item2_image_id = ! empty( $instance['item2_image'] ) ? $instance['item2_image'] : '';
        $item2_link = ! empty( $instance['item2_link'] ) ? $instance['item2_link'] : '#';

        $item3_image_id = ! empty( $instance['item3_image'] ) ? $instance['item3_image'] : '';
        $item3_link = ! empty( $instance['item3_link'] ) ? $instance['item3_link'] : '#';

        $item4_image_id = ! empty( $instance['item4_image'] ) ? $instance['item4_image'] : '';
        $item4_link = ! empty( $instance['item4_link'] ) ? $instance['item4_link'] : '#';

        $item5_image_id = ! empty( $instance['item5_image'] ) ? $instance['item5_image'] : '';
        $item5_link = ! empty( $instance['item5_link'] ) ? $instance['item5_link'] : '#';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Link:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <h3><?php esc_html_e( 'Item 1:', 'komestic' ); ?></h3>
        <div class="author-image-wrap"> <label for="<?php echo esc_attr($this->get_field_id('item1_image')); ?>"><?php esc_html_e('Image:', 'komestic'); ?></label>
            <input type="hidden" class="widefat hide-image-url" id="<?php echo esc_attr($this->get_field_id('item1_image')); ?>"
                name="<?php echo esc_attr($this->get_field_name('item1_image')); ?>"
                value="<?php echo esc_attr($item1_image_id); ?>"/>
            <div class="pxl-show-image"> <?php if ( ! empty( $item1_image_id ) ) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($item1_image_id, 'thumbnail')); ?>" alt="" style="max-width:100px; height:auto; display:block;">
                <?php endif; ?>
            </div>
            <a href="#" class="pxl-select-image button" style="<?php echo esc_attr($item1_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Select Image', 'komestic'); ?></a>
            <a href="#" class="pxl-remove-image button" style="<?php echo empty($item1_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Remove Image', 'komestic'); ?></a>
        </div>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item1_link' ) ); ?>"><?php echo esc_html__( 'Link:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item1_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item1_link' ) ); ?>" type="text" value="<?php echo esc_attr( $item1_link ); ?>">
        </p>


        <h3><?php esc_html_e( 'Item 2:', 'komestic' ); ?></h3>
        <div class="author-image-wrap">
            <label for="<?php echo esc_attr($this->get_field_id('item2_image')); ?>"><?php esc_html_e('Image:', 'komestic'); ?></label>
            <input type="hidden" class="widefat hide-image-url"
                id="<?php echo esc_attr($this->get_field_id('item2_image')); ?>"
                name="<?php echo esc_attr($this->get_field_name('item2_image')); ?>"
                value="<?php echo esc_attr($item2_image_id); ?>"/>
            <div class="pxl-show-image">
                <?php if ( ! empty( $item2_image_id ) ) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($item2_image_id, 'thumbnail')); ?>" alt="" style="max-width:100px; height:auto; display:block;">
                <?php endif; ?>
            </div>
            <a href="#" class="pxl-select-image button" style="<?php echo esc_attr($item2_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Select Image', 'komestic'); ?></a>
            <a href="#" class="pxl-remove-image button" style="<?php echo empty($item2_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Remove Image', 'komestic'); ?></a>
        </div>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item2_link' ) ); ?>"><?php echo esc_html__( 'Link:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item2_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item2_link' ) ); ?>" type="text" value="<?php echo esc_attr( $item2_link ); ?>">
        </p>

        <h3><?php esc_html_e( 'Item 3:', 'komestic' ); ?></h3>
        <div class="author-image-wrap">
            <label for="<?php echo esc_attr($this->get_field_id('item3_image')); ?>"><?php esc_html_e('Image:', 'komestic'); ?></label>
            <input type="hidden" class="widefat hide-image-url"
                id="<?php echo esc_attr($this->get_field_id('item3_image')); ?>"
                name="<?php echo esc_attr($this->get_field_name('item3_image')); ?>"
                value="<?php echo esc_attr($item3_image_id); ?>"/>
            <div class="pxl-show-image">
                <?php if ( ! empty( $item3_image_id ) ) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($item3_image_id, 'thumbnail')); ?>" alt="" style="max-width:100px; height:auto; display:block;">
                <?php endif; ?>
            </div>
            <a href="#" class="pxl-select-image button" style="<?php echo esc_attr($item3_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Select Image', 'komestic'); ?></a>
            <a href="#" class="pxl-remove-image button" style="<?php echo empty($item3_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Remove Image', 'komestic'); ?></a>
        </div>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item3_link' ) ); ?>"><?php echo esc_html__( 'Link:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item3_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item3_link' ) ); ?>" type="text" value="<?php echo esc_attr( $item3_link ); ?>">
        </p>

        <h3><?php esc_html_e( 'Item 4:', 'komestic' ); ?></h3>
        <div class="author-image-wrap">
            <label for="<?php echo esc_attr($this->get_field_id('item4_image')); ?>"><?php esc_html_e('Image:', 'komestic'); ?></label>
            <input type="hidden" class="widefat hide-image-url"
                id="<?php echo esc_attr($this->get_field_id('item4_image')); ?>"
                name="<?php echo esc_attr($this->get_field_name('item4_image')); ?>"
                value="<?php echo esc_attr($item4_image_id); ?>"/>
            <div class="pxl-show-image">
                <?php if ( ! empty( $item4_image_id ) ) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($item4_image_id, 'thumbnail')); ?>" alt="" style="max-width:100px; height:auto; display:block;">
                <?php endif; ?>
            </div>
            <a href="#" class="pxl-select-image button" style="<?php echo esc_attr($item4_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Select Image', 'komestic'); ?></a>
            <a href="#" class="pxl-remove-image button" style="<?php echo empty($item4_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Remove Image', 'komestic'); ?></a>
        </div>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item4_link' ) ); ?>"><?php echo esc_html__( 'Link:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item4_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item4_link' ) ); ?>" type="text" value="<?php echo esc_attr( $item4_link ); ?>">
        </p>

        <h3><?php esc_html_e( 'Item 5:', 'komestic' ); ?></h3>
        <div class="author-image-wrap">
            <label for="<?php echo esc_attr($this->get_field_id('item5_image')); ?>"><?php esc_html_e('Image:', 'komestic'); ?></label>
            <input type="hidden" class="widefat hide-image-url"
                id="<?php echo esc_attr($this->get_field_id('item5_image')); ?>"
                name="<?php echo esc_attr($this->get_field_name('item5_image')); ?>"
                value="<?php echo esc_attr($item5_image_id); ?>"/>
            <div class="pxl-show-image">
                <?php if ( ! empty( $item5_image_id ) ) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($item5_image_id, 'thumbnail')); ?>" alt="" style="max-width:100px; height:auto; display:block;">
                <?php endif; ?>
            </div>
            <a href="#" class="pxl-select-image button" style="<?php echo esc_attr($item5_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Select Image', 'komestic'); ?></a>
            <a href="#" class="pxl-remove-image button" style="<?php echo empty($item5_image_id) ? 'display:none;' : ''; ?>"><?php esc_html_e('Remove Image', 'komestic'); ?></a>
        </div>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item5_link' ) ); ?>"><?php echo esc_html__( 'Title:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item5_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item5_link' ) ); ?>" type="text" value="<?php echo esc_attr( $item5_link ); ?>">
        </p>
        <?php
    }
}
add_action( 'widgets_init', 'komestic_register_socials_widget' );
function komestic_register_socials_widget(){
    if(function_exists('pxl_register_wp_widget')){
        pxl_register_wp_widget( 'Komestic_Widget_Socials' );
    }
}