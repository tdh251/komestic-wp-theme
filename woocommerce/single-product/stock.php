<?php
/**
 * Single Product stock.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/stock.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;

if($product->is_in_stock()) {
	return;
}
$template_id = komestic()->get_theme_opt('product_out_of_stock_template_id', ''); 
?>
<p class="stock <?php echo esc_attr( $class ); ?>">
	<span class="product-actions">
		<button disabled class="pxl-button button--primary disabled">
			<span class="button__text"><?php echo esc_html__('This item is currently unavailable', 'komestic'); ?></span>
		</button>
		<?php
		if ( class_exists( 'WPCleverWoosw' ) ) 
			pxl_print_html(do_shortcode('[woosw_btn id="'.esc_attr($product->get_id()).'"]'));
		komestic_render_compare_button_html($product->get_id()); 
		?>
	</span>
	<?php 
		if(!empty($template_id)) {
			echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display((int)$template_id);
		}else {
			echo wp_kses_post( $availability );
		}; 
	?>
</p>
