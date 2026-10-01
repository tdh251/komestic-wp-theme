<?php
/**
 * Remove all action
 */

/**
 * Custom Form Quantity
 */
add_action( 'woocommerce_before_add_to_cart_quantity', function() {
	?>
	<div class="quantity-wrap">
	<span class="quantity-preview">
		<?php esc_html_e('Quantity: ', 'komestic') ?><span class="quantity-number">1</span></span>
	<?php
});
add_action( 'woocommerce_before_quantity_input_field', function() {
	?>
	<span class="quantity-icon icon-minus"></span>
	<?php
});
add_action( 'woocommerce_after_quantity_input_field', function() {
	?>
	<span class="quantity-icon icon-plus"></span>
	<?php
});

add_action( 'woocommerce_after_add_to_cart_quantity', function() {
	global $product;
	?>
	</div> 
	<div class="product-actions">
	<?php
		$add_to_cart_url = $product->add_to_cart_url();
		$price_html = wc_price(0);
		$final_price = 0;
		if ( $product->is_type('simple') || $product->is_type('external') ) {
			$regular_price = wc_get_price_to_display( $product, [ 'price' => $product->get_regular_price() ] );
			$sale_price = wc_get_price_to_display( $product, [ 'price' => $product->get_sale_price() ] );
			$price_html = wc_price( $regular_price );
			$final_price = $regular_price;
			if ( $product->is_on_sale() ) {
				$final_price = $sale_price;
				$price_html = wc_price( $sale_price );
			} 
		}
        echo '<a href="' . esc_url( $add_to_cart_url ) . '" data-quantity="1" data-price="'.esc_attr($final_price).'" class="pxl-button button--single-action button--primary button--add-to-cart single_add_to_cart_button button alt" data-product_id="' . esc_attr( $product->get_id() ) . '">
		<span class="button__text">'.esc_html('Add To Bag').'</span>
		<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
			<path d="M0 5.14282H12V6.85712H0V5.14282Z" fill="currentcolor"/>
		</svg>
		<span class="button__text--price" >'.wp_kses_post( $price_html ).'</span>
		</a>';
		if ( class_exists( 'WPCleverWoosw' ) ) 
			pxl_print_html(do_shortcode('[woosw_btn id="'.esc_attr($product->get_id()).'"]'));
		komestic_render_compare_button_html($product->get_id()); 
		?>
		</div>
		<?php komestic_render_button_buy_now($product); ?>
	<?php
});

/**
 * Custom Button Submit Form Comment
 */
add_filter('comment_form_defaults', 'custom_comment_submit_button');
function custom_comment_submit_button($defaults) {
    $defaults['submit_button'] = '<button type="submit" class="pxl-button button--primary">
        <span class="button__text">
            Submit
        </span>
    </button>';
    return $defaults;
}

/**
 * Custom Related Products Columns and Product Per Page
 */
add_filter( 'woocommerce_output_related_products_args', 'komestic_related_products_args', 20 );
  function komestic_related_products_args( $args ) {
	$related_product_columns = komestic()->get_theme_opt('related_product_columns', 4);
	$related_products_per_page = komestic()->get_theme_opt('related_products_per_page', 4);
	$args['posts_per_page'] = $related_products_per_page;
	$args['columns'] = $related_product_columns;
	return $args;
}


if ( ! function_exists( 'komestic_woocommerce_comments' ) ) {

	function komestic_woocommerce_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		get_template_part(
			'template-parts/woocommerce/review', 
			null,
			array(
				'comment' => $comment,
				'args'    => $args,
				'depth'   => $depth,
			)
		);
		
	}
}