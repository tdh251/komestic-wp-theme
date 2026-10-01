<?php

/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
$currency = ' '.get_woocommerce_currency();
$gift_wrap = komestic_get_gift_package();
$has_gift_wrap = false;
?>
<div class="woocommerce-checkout-review-order-table order-review__inner">
	<h5 class="order-review__title">
		<?php echo esc_html__('Your Cart', 'komestic'); ?>
	</h5>
	<div class="order-review__products">
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			if($gift_wrap['id'] == $product_id) {
				$has_gift_wrap = true;
				continue;
			}
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$thumbnail = komestic_get_image_by_size([
					'img_dimension' => [
						'width' => 300,
						'height' => 300,
					],
				], $_product->get_id());
				$product_name = $_product->get_title();
				$attributes = [];
				foreach ( $cart_item['variation'] as $attr_name => $attr_value ) {
					$taxonomy = str_replace( 'attribute_', '', $attr_name );
					$term = get_term_by( 'slug', $attr_value, $taxonomy );
					$attributes[] = $term ? $term->name : $attr_value;
				}
				$attributes_str = implode( ' / ', $attributes ); 
				?>
				<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> order-review__product product">
					<div class="product__thumbnail">
						<?php echo wp_kses_post($thumbnail); ?>
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <span class="product__quantity">' . sprintf( $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); ?>
					</div>
					<div class="product__content">
						<div class="product__name">
							<?php 
								if(!empty($attributes_str)) {
									printf( '<span>%s</span><span class="product-attributes">%s</span>', $product_name, $attributes_str);
								}else {
									printf( '%s', $product_name);
								}
							?>
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
						</div>
						<div class="product__subtotal">
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
						</div>
					</div>
				</div>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</div>
	<span class="divider"></span>
	<div class="order-review__calc">

		<div class="order-review__calc-item order-review__gift-wrap">
			<div class="label"><?php echo esc_html__('Gift Package:', 'komestic'); ?></div>
			<div class="price"><?php pxl_print_html(($has_gift_wrap) ? wc_price($gift_wrap['price']) : wc_price(0).' '.$currency); ?></div>
		</div>
		
		<div class="order-review__calc-item order-review__subtotal">
			<div class="label"><?php esc_html_e( 'Subtotal:', 'komestic' ); ?></div>
			<div class="value"><?php wc_cart_totals_subtotal_html();echo esc_html($currency); ?></div>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="order-review__calc-item order-review__discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<div class="label"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
				<div class="value"><?php wc_cart_totals_coupon_html( $coupon );echo esc_html($currency); ?></div>
			</div>
		<?php endforeach; ?>

		<?php
		$shipping_total = WC()->cart->get_shipping_total();
		?>

		<div class="order-review__calc-item order-review__shipping-cost">
			<div class="label"><?php esc_html_e('Shipping:', 'komestic'); ?></div>
			<div class="value pxl-shipping-cost">
				<?php echo wc_price( $shipping_total ); ?>
				<span class="currency"><?php echo esc_html($currency); ?></span>
			</div>
		</div>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="order-review__calc-item order-review__fees">
				<div class="label"><?php echo esc_html( $fee->name ); ?></div>
				<div class="value"><?php wc_cart_totals_fee_html( $fee );echo esc_html($currency); ?></div>
			</div>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<div class="order-review__calc-item order-review__tax tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<div class="label"><?php echo esc_html( $tax->label ); ?></div>
						<div class="value"><?php echo wp_kses_post( $tax->formatted_amount ).esc_html($currency); ?></div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="order-review__calc-item order-review__tax">
					<div class="label"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></div>
					<div class="value"><?php wc_cart_totals_taxes_total_html();echo esc_html($currency); ?></div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
		<span class="divider"></span>
		<div class="order-review__calc-item order-review__total">
			<div class="label"><?php esc_html_e( 'Total:', 'komestic' ); ?></div>
			<div class="value"><?php wc_cart_totals_order_total_html(); echo esc_html($currency); ?></div>
		</div>

		
		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
	</div>
</div>