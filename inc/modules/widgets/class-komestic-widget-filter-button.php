<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Komestic_Filter_Button_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'filter_button',
            __( 'Komestic Filter Button', 'komestic' ),
            [ 'description' => __( 'A button with filter icon', 'komestic' ) ]
        );
    }

    public function widget( $args, $instance ) {
        pxl_print_html($args['before_widget']. ' <div class="widget__content"><div class="widget__content-inner">');
        $text = ! empty( $instance['text'] ) ? $instance['text'] : __( 'Filter', 'komestic' );
        $icon = ! empty( $instance['icon'] ) ? $instance['icon'] : '';
        $template_html_id = komestic_get_template_shop_filter_id();
        ?>
        <a href="<?php echo esc_url($template_html_id); ?>" class="pxl-button button--primary button--toggle button--shop-filter">
            <span class="button__icon">
                <?php if(!empty($icon)) : ?>
                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22">
                        <path d="M1.3166 3.13318H19.6793C20.4053 3.13318 20.9959 3.7238 20.9959 4.44978C20.9959 5.17576 20.4053 5.76638 19.6793 5.76638H1.3166C0.590625 5.77048 0 5.17986 0 4.44978C0 3.7238 0.590625 3.13318 1.3166 3.13318Z" fill="currentcolor"/>
                        <path d="M4.63887 9.68335H16.357C17.083 9.68335 17.6736 10.274 17.6736 11C17.6736 11.7259 17.083 12.3166 16.357 12.3166H4.63887C3.91289 12.3166 3.32227 11.7259 3.32227 11C3.32227 10.274 3.91289 9.68335 4.63887 9.68335Z" fill="currentcolor"/>
                        <path d="M7.96113 16.2295H13.0348C13.7607 16.2295 14.3514 16.8201 14.3514 17.5461C14.3514 18.2721 13.7607 18.8627 13.0348 18.8627H7.96113C7.23516 18.8627 6.64453 18.2721 6.64453 17.5461C6.64453 16.8201 7.23516 16.2295 7.96113 16.2295Z" fill="currentcolor"/>
                    </svg>
                <?php endif; ?>
            </span>
            <span class="button__text"><?php echo esc_html( $text ); ?></span>
        </a>
        <?php
        
        pxl_print_html( $args['after_widget'] );
    }

    public function form( $instance ) {
        $text = ! empty( $instance['text'] ) ? $instance['text'] : __( 'Filter', 'komestic' );
        $icon = ! empty( $instance['icon'] ) ? $instance['icon'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'text' )); ?>"><?php __( 'Button Text:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'text' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'text' )); ?>" type="text"
                   value="<?php echo esc_attr( $text ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'icon' )); ?>"><?php __( 'Icon Class (FontAwesome):', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'icon' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>" type="text"
                   value="<?php echo esc_attr( $icon ); ?>">
            <small><?php _e( 'Ex: fas fa-bars', 'komestic' ); ?></small>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['text'] = ! empty( $new_instance['text'] ) ? sanitize_text_field( $new_instance['text'] ) : '';
        $instance['icon'] = ! empty( $new_instance['icon'] ) ? sanitize_text_field( $new_instance['icon'] ) : '';
        return $instance;
    }
}

add_action( 'widgets_init', 'komestic_register_filter_button_widget' );
function komestic_register_filter_button_widget(){
    if(function_exists('pxl_register_wp_widget')){
        pxl_register_wp_widget( 'Komestic_Filter_Button_Widget' );
    }
}