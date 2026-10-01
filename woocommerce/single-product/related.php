<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     10.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'komestic' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		<p><?php echo esc_html__('These products have captured the hearts of our community', 'komestic'); ?></p>

		<?php
		wp_enqueue_script('komestic-swiper');
		$swiper_params = [
			'effect'                 => 'slide',
			'allow_touch_move'       => true,
			'direction'              => 'horizontal',
			'autoplay'               => false,
			'delay'                  => 5000,
			'disable_on_interaction' => false,
			'loop'                   => false,
			'speed'                  => 500,
			'pagination'             => 'bullets',
			'navigation'             => true,
			'space_between'          => 30,
			'centered_slides'        => false,
			'slides_per_group'       => 1,
			'slides_per_view_xs'     => 1,
			'slides_per_view_sm'     => 2,
			'slides_per_view_md'     => 2,
			'slides_per_view_lg'     => 3,
			'slides_per_view_xl'     => 3,
			'slides_per_view_xxl'    => 4,
		];
		$swiper_params = json_encode($swiper_params); 
		?>
		<div class="pxl-swiper">
			<div class="swiper-inner">
				<div class="swiper-container" data-swiper="<?php echo esc_attr($swiper_params); ?>">
					<div class="swiper-wrapper">
						<?php foreach ( $related_products as $related_product ) : 
							$post_object = get_post( $related_product->get_id() );
							setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
							global $product;
							?>
							<div class="swiper-slide">
								<div class="product">
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
						<?php endforeach; ?>
					</div>
					<div class="swiper-pagination"></div>
					<div class="swiper-navigation">
						<div class="pxl-swiper-button swiper-button-prev">
							<svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
								<path d="M6.61332 11.75C6.47963 11.75 6.34581 11.699 6.24375 11.5969L1.01647 6.36961C0.812217 6.16535 0.812217 5.8346 1.01647 5.63047L6.24375 0.403192C6.44801 0.198936 6.77877 0.198936 6.98289 0.403192C7.18702 0.607448 7.18715 0.938204 6.98289 1.14233L2.12518 6.00004L6.98289 10.8578C7.18715 11.062 7.18715 11.3928 6.98289 11.5969C6.88083 11.699 6.74701 11.75 6.61332 11.75Z" fill="currentcolor"/>
							</svg>
						</div>
						<div class="pxl-swiper-button swiper-button-next">
							<svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
								<path d="M1.38668 11.75C1.52037 11.75 1.65419 11.699 1.75625 11.5969L6.98353 6.36961C7.18778 6.16535 7.18778 5.8346 6.98353 5.63047L1.75625 0.403192C1.55199 0.198936 1.22123 0.198936 1.01711 0.403192C0.812984 0.607448 0.812854 0.938204 1.01711 1.14233L5.87482 6.00004L1.01711 10.8578C0.812854 11.062 0.812854 11.3928 1.01711 11.5969C1.11917 11.699 1.25299 11.75 1.38668 11.75Z" fill="currentcolor"/>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;

wp_reset_postdata();
