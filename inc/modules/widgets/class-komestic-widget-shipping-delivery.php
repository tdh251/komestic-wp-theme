<?php
/**
 * Custom Widget: Shipping & Delivery Info
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Komestic_Widget_Shipping_Delivery
 * Widget to display custom shipping, support and returns information.ưidget
 */
class Komestic_Widget_Shipping_Delivery extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'komestic_widget_shipping_delivery',
            esc_html__( 'Komestic Shipping Delivery', 'komestic' ), 
            array( 'description' => esc_html__( 'Displays information about conversions, support, and custom content changes.', 'komestic' ), ) 
        );
    }

    public function widget( $args, $instance ) {
        pxl_print_html($args['before_widget']); 
        $title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Shipping & Delivery', 'komestic' );
        if ( ! empty( $title ) ) {
            pxl_print_html( $args['before_title'] . $title . $args['after_title'] );
        }

        $info_items = array(
            array(
                'image_id' => ! empty( $instance['item1_image'] ) ? $instance['item1_image'] : '', 
                'title' => ! empty( $instance['item1_title'] ) ? $instance['item1_title'] : esc_html__( 'Free Shipping', 'komestic' ),
                'desc'  => ! empty( $instance['item1_desc'] ) ? $instance['item1_desc'] : esc_html__( 'Free iconbox for all US order', 'komestic' ),
            ),
            array(
                'image_id' => ! empty( $instance['item2_image'] ) ? $instance['item2_image'] : '',
                'title' => ! empty( $instance['item2_title'] ) ? $instance['item2_title'] : esc_html__( 'Premium Support', 'komestic' ),
                'desc'  => ! empty( $instance['item2_desc'] ) ? $instance['item2_desc'] : esc_html__( 'Support 24 hours a day', 'komestic' ),
            ),
            array(
                'image_id' => ! empty( $instance['item3_image'] ) ? $instance['item3_image'] : '',
                'title' => ! empty( $instance['item3_title'] ) ? $instance['item3_title'] : esc_html__( '30 Days Return', 'komestic' ),
                'desc'  => ! empty( $instance['item3_desc'] ) ? $instance['item3_desc'] : esc_html__( 'You have 30 days to return', 'komestic' ),
            ),
        );
        ?>
        <div class="shipping-delivery">
            <?php foreach ( $info_items as $item ) : ?>
                <div class="shipping-delivery__item">
                    <?php if ( ! empty( $item['image_id'] ) ) :
                        $image_url = wp_get_attachment_image_url($item['image_id'], 'thumbnail');
                        if ( ! $image_url ) {
                            $image_url = wp_get_attachment_image_url($item['image_id'], 'full');
                        }
                        ?>
                        <div class="shipping-delivery__item-icon">
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="shipping-delivery__item-content">
                        <?php if ( ! empty( $item['title'] ) ) : ?>
                            <h6 class="shipping-delivery__item-title"><?php echo esc_html( $item['title'] ); ?></h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $item['desc'] ) ) : ?>
                            <p class="shipping-delivery__item-desc"><?php echo esc_html( $item['desc'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php

        pxl_print_html( $args['after_widget'] );
    }

   public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        $instance['item1_image'] = ( ! empty( $new_instance['item1_image'] ) ) ? absint( $new_instance['item1_image'] ) : '';
        $instance['item1_title'] = ( ! empty( $new_instance['item1_title'] ) ) ? sanitize_text_field( $new_instance['item1_title'] ) : '';
        $instance['item1_desc']  = ( ! empty( $new_instance['item1_desc'] ) ) ? sanitize_text_field( $new_instance['item1_desc'] ) : '';

        $instance['item2_image'] = ( ! empty( $new_instance['item2_image'] ) ) ? absint( $new_instance['item2_image'] ) : '';
        $instance['item2_title'] = ( ! empty( $new_instance['item2_title'] ) ) ? sanitize_text_field( $new_instance['item2_title'] ) : '';
        $instance['item2_desc']  = ( ! empty( $new_instance['item2_desc'] ) ) ? sanitize_text_field( $new_instance['item2_desc'] ) : '';

        $instance['item3_image'] = ( ! empty( $new_instance['item3_image'] ) ) ? absint( $new_instance['item3_image'] ) : '';
        $instance['item3_title'] = ( ! empty( $new_instance['item3_title'] ) ) ? sanitize_text_field( $new_instance['item3_title'] ) : '';
        $instance['item3_desc']  = ( ! empty( $new_instance['item3_desc'] ) ) ? sanitize_text_field( $new_instance['item3_desc'] ) : '';
        
        return $instance;
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Shipping & Delivery', 'komestic' );

        $item1_image_id = ! empty( $instance['item1_image'] ) ? $instance['item1_image'] : '';
        $item1_title = ! empty( $instance['item1_title'] ) ? $instance['item1_title'] : esc_html__( 'Free Shipping', 'komestic' );
        $item1_desc  = ! empty( $instance['item1_desc'] ) ? $instance['item1_desc'] : esc_html__( 'Free iconbox for all US order', 'komestic' );

        $item2_image_id = ! empty( $instance['item2_image'] ) ? $instance['item2_image'] : '';
        $item2_title = ! empty( $instance['item2_title'] ) ? $instance['item2_title'] : esc_html__( 'Premium Support', 'komestic' );
        $item2_desc  = ! empty( $instance['item2_desc'] ) ? $instance['item2_desc'] : esc_html__( 'Support 24 hours a day', 'komestic' );

        $item3_image_id = ! empty( $instance['item3_image'] ) ? $instance['item3_image'] : '';
        $item3_title = ! empty( $instance['item3_title'] ) ? $instance['item3_title'] : esc_html__( '30 Days Return', 'komestic' );
        $item3_desc  = ! empty( $instance['item3_desc'] ) ? $instance['item3_desc'] : esc_html__( 'You have 30 days to return', 'komestic' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'komestic' ); ?></label>
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
            <label for="<?php echo esc_attr( $this->get_field_id( 'item1_title' ) ); ?>"><?php echo esc_html__( 'Title:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item1_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item1_title' ) ); ?>" type="text" value="<?php echo esc_attr( $item1_title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item1_desc' ) ); ?>"><?php echo esc_html__( 'Description:', 'komestic' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item1_desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item1_desc' ) ); ?>" rows="3"><?php echo esc_textarea( $item1_desc ); ?></textarea>
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
            <label for="<?php echo esc_attr( $this->get_field_id( 'item2_title' ) ); ?>"><?php echo esc_html__( 'Title:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item2_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item2_title' ) ); ?>" type="text" value="<?php echo esc_attr( $item2_title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item2_desc' ) ); ?>"><?php echo esc_html__( 'Description:', 'komestic' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item2_desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item2_desc' ) ); ?>" rows="3"><?php echo esc_textarea( $item2_desc ); ?></textarea>
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
            <label for="<?php echo esc_attr( $this->get_field_id( 'item3_title' ) ); ?>"><?php echo esc_html__( 'Title:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item3_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item3_title' ) ); ?>" type="text" value="<?php echo esc_attr( $item3_title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item3_desc' ) ); ?>"><?php echo esc_html__( 'Description:', 'komestic' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item3_desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item3_desc' ) ); ?>" rows="3"><?php echo esc_textarea( $item3_desc ); ?></textarea>
        </p>
        <?php
    }
}

add_action( 'widgets_init', 'komestic_register_shipping_delivery_widget' );
function komestic_register_shipping_delivery_widget(){
    if(function_exists('pxl_register_wp_widget')){
        pxl_register_wp_widget( 'Komestic_Widget_Shipping_Delivery' );
    }
}