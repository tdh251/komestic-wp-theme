<?php
if ( ! class_exists( 'Komestic_Filter_Widget' ) ) {
    class Komestic_Filter_Widget extends WP_Widget {

        public function __construct() {
            parent::__construct(
                'komestic_widget_filter',
                esc_html__( 'Komestic Product Filter', 'komestic' ),
                array(
                    'description' => esc_html__( 'Display product filter.', 'komestic' )
                )
            );
        }

        public function widget( $args, $instance ) {
            pxl_print_html($args['before_widget'].'<div>');

            $show_category     = ! empty( $instance['show_category'] ) ? (bool) $instance['show_category'] : true;
            $show_availability = ! empty( $instance['show_availability'] ) ? (bool) $instance['show_availability'] : true;
            $show_brand        = ! empty( $instance['show_brand'] ) ? (bool) $instance['show_brand'] : true;
            $show_price_slider = ! empty( $instance['show_price_slider'] ) ? (bool) $instance['show_price_slider'] : true;
            $pa_attrs          = ! empty( $instance['pa_attrs'] ) ? (array) $instance['pa_attrs'] : [];

            wc_get_template(
                'filter.php',
                array(
                    'show_category'     => $show_category,
                    'show_availability' => $show_availability,
                    'show_brand'        => $show_brand,
                    'show_price_slider' => $show_price_slider,
                    'pa_attrs'          => $pa_attrs,
                )
            );

            pxl_print_html( $args['after_widget'] );
        }

        public function form( $instance ) {
            $show_category     = isset( $instance['show_category'] ) ? (bool) $instance['show_category'] : true;
            $show_availability = isset( $instance['show_availability'] ) ? (bool) $instance['show_availability'] : true;
            $show_brand        = isset( $instance['show_brand'] ) ? (bool) $instance['show_brand'] : true;
            $show_price_slider = isset( $instance['show_price_slider'] ) ? (bool) $instance['show_price_slider'] : true;
            $pa_attrs          = isset( $instance['pa_attrs'] ) ? (array) $instance['pa_attrs'] : [];

            // Danh sách attr product
            $all_attrs = komestic_get_product_attributes_option();
            ?>
            <p>
                <input class="checkbox" type="checkbox"
                       <?php checked( $show_category ); ?>
                       id="<?php echo esc_attr($this->get_field_id( 'show_category' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'show_category' )); ?>" />
                <label for="<?php echo esc_attr($this->get_field_id( 'show_category' )); ?>">
                    <?php esc_html_e( 'Show Category', 'komestic' ); ?>
                </label>
            </p>
            <p>
                <input class="checkbox" type="checkbox"
                       <?php checked( $show_availability ); ?>
                       id="<?php echo esc_attr($this->get_field_id( 'show_availability' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'show_availability' )); ?>" />
                <label for="<?php echo esc_attr($this->get_field_id( 'show_availability' )); ?>">
                    <?php esc_html_e( 'Show Availability', 'komestic' ); ?>
                </label>
            </p>
            <p>
                <input class="checkbox" type="checkbox"
                       <?php checked( $show_brand ); ?>
                       id="<?php echo esc_attr($this->get_field_id( 'show_brand' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'show_brand' )); ?>" />
                <label for="<?php echo esc_attr($this->get_field_id( 'show_brand' )); ?>">
                    <?php esc_html_e( 'Show Brand', 'komestic' ); ?>
                </label>
            </p>
            <p>
                <input class="checkbox" type="checkbox"
                       <?php checked( $show_price_slider ); ?>
                       id="<?php echo esc_attr($this->get_field_id( 'show_price_slider' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'show_price_slider' )); ?>" />
                <label for="<?php echo esc_attr($this->get_field_id( 'show_price_slider' )); ?>">
                    <?php esc_html_e( 'Show Price Slider', 'komestic' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'pa_attrs' )); ?>">
                    <?php esc_html_e( 'Product Attributes:', 'komestic' ); ?>
                </label>
                <select multiple class="widefat"
                        id="<?php echo esc_attr($this->get_field_id( 'pa_attrs' )); ?>"
                        name="<?php echo esc_attr($this->get_field_name( 'pa_attrs' )); ?>[]">
                    <?php foreach ( $all_attrs as $key => $label ) : ?>
                        <option value="<?php echo esc_attr( $key ); ?>"
                            <?php selected( in_array( $key, $pa_attrs ) ); ?>>
                            <?php echo esc_html( $label ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <?php
        }

        /**
         * Lưu option
         */
        public function update( $new_instance, $old_instance ) {
            $instance                        = [];
            $instance['show_category']       = ! empty( $new_instance['show_category'] ) ? 1 : 0;
            $instance['show_availability']   = ! empty( $new_instance['show_availability'] ) ? 1 : 0;
            $instance['show_brand']          = ! empty( $new_instance['show_brand'] ) ? 1 : 0;
            $instance['show_price_slider']   = ! empty( $new_instance['show_price_slider'] ) ? 1 : 0;
            $instance['pa_attrs']            = ! empty( $new_instance['pa_attrs'] ) ? (array) $new_instance['pa_attrs'] : [];
            return $instance;
        }
    }
}

add_action( 'widgets_init', 'komestic_register_filter_widget' );
function komestic_register_filter_widget(){
    if(function_exists('pxl_register_wp_widget')){
        pxl_register_wp_widget( 'Komestic_Filter_Widget' );
    }
}