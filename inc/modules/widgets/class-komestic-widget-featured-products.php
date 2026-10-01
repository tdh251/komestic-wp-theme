<?php
/**
 * Custom Widget: Featured Products
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Komestic_Widget_Featured_Products extends WP_Widget {
    function __construct() {
        parent::__construct(
            'komestic_widget_featured_products',
            esc_html__('Komestic Suggest Products', 'komestic'),
            array('description' => esc_html__('Widget Base', 'komestic')),
        );
    }

    public function widget( $args, $instance ) {
        pxl_print_html($args['before_widget']); 

        $title = !empty($instance['title']) ? $instance['title'] : '';
        $product_type = !empty( $instance['product_type'] ) ? $instance['product_type'] : '';
        $limit = ! empty( $instance['limit'] ) ? intval( $instance['limit'] ) : 3;

        if ( ! empty( $title ) ) {
            pxl_print_html( $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'] ); 
        }
        $product_ids = explode('-', do_shortcode('[komestic_recent_products limit="' . $limit . '"]'));
        if(!empty($product_ids)) { ?>
            <div class="pxl-products">
                <?php foreach($product_ids as $product_id) { 
                    global $product;
                    $product = wc_get_product($product_id);
                    if ( !$product ){
                        continue;
                    }    
                ?>
                    <?php 
                    wc_get_template(
                    'template-parts/woocommerce/content-product/list.php',
                        array(
                            'product'  => $product,
                            'show_category' => true,
                            'title_tag' => 'div',
                        ),
                    );   
                    ?>
                <?php } ?>
            </div>
        <?php }
        pxl_print_html( $args['after_widget'] );
    }

    public function form( $instance ) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Products';
        $product_type = !empty( $instance['product_type'] ) ? $instance['product_type'] : '';
        $limit = ! empty( $instance['limit'] ) ? intval( $instance['limit'] ) : 3;
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'komestic' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'product_type' ) ); ?>"><?php echo esc_html__( 'Product Type:', 'komestic' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'product_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'product_type' ) ); ?>">
                <option value="recent" <?php selected( $product_type, 'recent' ); ?>><?php esc_html_e( 'Recent', 'komestic' ); ?></option>
                <option value="sale" <?php selected( $product_type, 'sale' ); ?>><?php esc_html_e( 'On Sale', 'komestic' ); ?></option>
                <option value="best_selling" <?php selected( $product_type, 'best_selling' ); ?>><?php esc_html_e( 'Best Selling', 'komestic' ); ?></option>
                <option value="top_rated" <?php selected( $product_type, 'top_rated' ); ?>><?php esc_html_e( 'Top Rated', 'komestic' ); ?></option>
                <option value="featured" <?php selected( $product_type, 'featured' ); ?>><?php esc_html_e( 'Featured', 'komestic' ); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php echo esc_html__( 'Limit:', 'komestic' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="number" step="1" min="0" value="<?php echo esc_attr( $limit ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['product_type'] = ( ! empty( $new_instance['product_type'] ) ) ? strip_tags( $new_instance['product_type'] ) : '';
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? intval( $new_instance['limit'] ) : 3;
        return $instance;
    }
}

add_action( 'widgets_init', 'komestic_register_featured_products_widget' );
function komestic_register_featured_products_widget(){
    if(function_exists('pxl_register_wp_widget')){
        pxl_register_wp_widget( 'Komestic_Widget_Featured_Products' );
    }
}