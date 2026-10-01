<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

$layout = $args['layout'] ?? 'grid';
if ($layout === 'grid') : ?>
	<li <?php wc_product_class( '', $product ); ?>> 
		<?php
		wc_get_template(
		'template-parts/woocommerce/content-product/default.php',
			array(
				'product'  => $product,
			),
		);  
		?>
	</li>
<?php else : ?>
	<div class="swiper-slide"> 
		<div <?php wc_product_class( '', $product ); ?>>
			<?php
			wc_get_template(
			'template-parts/woocommerce/content-product/default.php',
				array(
					'product'  => $product,
				),
			);  
			?>
		</div>
	</div>
<?php endif;
