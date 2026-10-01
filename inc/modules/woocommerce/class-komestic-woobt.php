<?php
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'WPCleverWoobt' ) || !class_exists( 'WC_Product' )  ) 
    return;

class Komestic_Woobt extends WPCleverWoobt {
    public static $instance = null;
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function komestic_show_items( $product = null, $custom_position = false, $is_variation = false ) {
			$product_id = 0;

			if ( ! $product ) {
				global $product;

				if ( $product ) {
					$product_id = $product->get_id();
				}
			} else {
				if ( is_a( $product, 'WC_Product' ) ) {
					$product_id = $product->get_id();
				}

				if ( is_numeric( $product ) ) {
					$product_id = absint( $product );
					$product    = wc_get_product( $product_id );
				}
			}

			if ( ! $product_id || ! $product || $product->is_type( 'grouped' ) || $product->is_type( 'external' ) ) {
				return;
			}

			if ( ! $is_variation ) {
				wp_enqueue_script( 'wc-add-to-cart-variation' );
			}

			$custom_qty  = apply_filters( 'woobt_custom_qty', get_post_meta( $product_id, 'woobt_custom_qty', true ) === 'on', $product_id );
			$sync_qty    = apply_filters( 'woobt_sync_qty', get_post_meta( $product_id, 'woobt_sync_qty', true ) === 'on', $product_id );
			$checked_all = apply_filters( 'woobt_checked_all', get_post_meta( $product_id, 'woobt_checked_all', true ) === 'on', $product_id );
			$separately  = apply_filters( 'woobt_separately', get_post_meta( $product_id, 'woobt_separately', true ) === 'on', $product_id );
			$separately  &= apply_filters( 'woobt_separately_reset_price', true, $product_id, 'view' ); // change it to false if you want to keep the discounted price
			$selection   = apply_filters( 'woobt_selection', get_post_meta( $product_id, 'woobt_selection', true ) ?: 'multiple', $product_id );

			$_position       = get_post_meta( $product_id, 'woobt_position', true ) ?: 'unset';
			$_layout         = get_post_meta( $product_id, 'woobt_layout', true ) ?: 'unset';
			$_atc_button     = get_post_meta( $product_id, 'woobt_atc_button', true ) ?: 'unset';
			$_show_this_item = get_post_meta( $product_id, 'woobt_show_this_item', true ) ?: 'unset';

			// settings
			$pricing          = WPCleverWoobt_Helper()->get_setting( 'pricing', 'sale_price' );
			$plus_minus       = WPCleverWoobt_Helper()->get_setting( 'plus_minus', 'no' ) === 'yes';
			$position         = $_position !== 'unset' ? $_position : apply_filters( 'woobt_position', WPCleverWoobt_Helper()->get_setting( 'position', apply_filters( 'woobt_default_position', 'before' ) ) );
			$layout           = apply_filters( 'woobt_layout', $_layout !== 'unset' ? $_layout : WPCleverWoobt_Helper()->get_setting( 'layout', 'default' ), $product_id );
			$show_this_item   = apply_filters( 'woobt_show_this_item', $_show_this_item !== 'unset' ? $_show_this_item : WPCleverWoobt_Helper()->get_setting( 'show_this_item', 'yes' ), $product_id );
			$atc_button       = apply_filters( 'woobt_atc_button', $_atc_button !== 'unset' ? $_atc_button : WPCleverWoobt_Helper()->get_setting( 'atc_button', 'main' ), $product_id );
			$separate_atc     = $atc_button === 'separate' || $atc_button === 'both';
			$separate_images  = $layout === 'separate';
			$hide_this_item   = apply_filters( 'woobt_hide_this_item', ! $custom_position && ! $separate_atc && ! wc_string_to_bool( $show_this_item ), $product_id );
			$ignore_this_item = apply_filters( 'woobt_separately_ignore_this_item', false, $product_id );
			$discount         = $separately ? '0' : self::get_discount( $product_id );

			if ( ! $is_variation ) {
				$wrap_class = 'woobt-wrap woobt-layout-' . esc_attr( $layout ) . ' woobt-wrap-' . esc_attr( $product_id ) . ' ' . ( WPCleverWoobt_Helper()->get_setting( 'responsive', 'yes' ) === 'yes' ? 'woobt-wrap-responsive' : '' );

				if ( $custom_position ) {
					$wrap_class .= ' woobt-wrap-custom-position';
				}

				if ( $separate_atc ) {
					$wrap_class .= ' woobt-wrap-separate-atc';
				}

				$sku        = htmlentities( $product->get_sku() );
				$weight     = htmlentities( wc_format_weight( $product->get_weight() ) );
				$dimensions = htmlentities( wc_format_dimensions( $product->get_dimensions( false ) ) );
				$price_html = htmlentities( $product->get_price_html() );

				$wrap_attrs = apply_filters( 'woobt_wrap_data_attributes', [
					'id'                   => $product_id,
					'selection'            => $selection,
					'position'             => $position,
					'atc-button'           => $atc_button,
					'this-item'            => $hide_this_item ? 'no' : 'yes',
					'ignore-this'          => $ignore_this_item ? 'yes' : 'no',
					'separately'           => $separately ? 'on' : 'off',
					'layout'               => $layout,
					'product-id'           => $product->is_type( 'variable' ) ? '0' : $product_id,
					'product-sku'          => $sku,
					'product-o_sku'        => $sku,
					'product-weight'       => $weight,
					'product-o_weight'     => $weight,
					'product-dimensions'   => $dimensions,
					'product-o_dimensions' => $dimensions,
					'product-price-html'   => $price_html,
					'product-o_price-html' => $price_html,
				], $product );

				echo '<div class="' . esc_attr( $wrap_class ) . '" ' . WPCleverWoobt_Helper()->data_attributes( $wrap_attrs ) . '>';
			}

			// get items
			$items = apply_filters( 'woobt_show_items', self::get_items( $product_id, 'view' ), $product_id );

			if ( ! empty( $items ) ) {
				// format items
				foreach ( $items as $key => $item ) {
					if ( is_array( $item ) ) {
						if ( ! empty( $item['id'] ) ) {
							$_item['id']    = $item['id'];
							$_item['price'] = $item['price'];
							$_item['qty']   = $item['qty'];
						} else {
							// heading/paragraph
							$_item = $item;
						}
					} else {
						// make it works with upsells/cross-sells/related
						$_item['id']    = absint( $item );
						$_item['price'] = WPCleverWoobt_Helper()->get_setting( 'default_price', '100%' );
						$_item['qty']   = 1;
					}

					if ( ! empty( $_item['id'] ) ) {
						if ( $_item_product = wc_get_product( $_item['id'] ) ) {
							$_item['product'] = $_item_product;
						} else {
							unset( $items[ $key ] );
							continue;
						}
					}

					if ( ! empty( $_item['product'] ) && ( ! in_array( $_item['product']->get_type(), self::$types, true ) || ( ( WPCleverWoobt_Helper()->get_setting( 'exclude_unpurchasable', 'no' ) === 'yes' ) && ( ! $_item['product']->is_purchasable() || ! $_item['product']->is_in_stock() ) ) ) ) {
						unset( $items[ $key ] );
						continue;
					}

					if ( ! empty( $_item['product'] ) && ! apply_filters( 'woobt_item_visible', $_item['product']->get_status() === 'publish', $_item ) ) {
						unset( $items[ $key ] );
						continue;
					}

					$items[ $key ] = $_item;
				}
			}

			if ( ! empty( $items ) ) {
				$before_text = apply_filters( 'woobt_before_text', self::get_text( $product, 'before' ), $product_id );
				$after_text  = apply_filters( 'woobt_after_text', self::get_text( $product, 'after' ), $product_id );

				// show items
				do_action( 'woobt_wrap_before', $product );

				if ( ! empty( $before_text ) ) {
					do_action( 'woobt_before_text_above', $product );
					echo '<div class="woobt-before-text woobt-text">' . wp_kses_post( do_shortcode( $before_text ) ) . '</div>';
					do_action( 'woobt_before_text_below', $product );
				}

				if ( $layout === 'compact' ) {
					echo '<div class="woobt-inner">';
				}

				if ( $separate_images ) {
					do_action( 'woobt_images_above', $product );
					?>
                    <div class="woobt-images">
						<?php
						do_action( 'woobt_images_before', $product );

						if ( ! $ignore_this_item ) {
							echo '<div class="woobt-image woobt-image-this woobt-image-order-0 woobt-image-' . esc_attr( $product_id ) . '">';
							do_action( 'woobt_product_thumb_before', $product, 0, 'separate' );
							echo '<span class="woobt-img woobt-img-order-0" data-img="' . esc_attr( htmlentities( $product->get_image( self::$image_size ) ) ) . '">' . $product->get_image( self::$image_size ) . '</span>';
							do_action( 'woobt_product_thumb_after', $product, 0, 'separate' );
							echo '</div>';
						}

						$order = 1;

						foreach ( $items as $item ) {
							if ( ! empty( $item['id'] ) ) {
								$item_product     = $item['product'];
								$item_image_class = 'woobt-image woobt-image-order-' . $order . ' woobt-image-' . $item['id'];

								echo '<div class="' . esc_attr( $item_image_class ) . '" data-order="' . esc_attr( $order ) . '">';

								do_action( 'woobt_product_thumb_before', $item_product, $order, 'separate', $item );

								if ( WPCleverWoobt_Helper()->get_setting( 'link', 'yes' ) !== 'no' ) {
									echo '<a class="' . esc_attr( WPCleverWoobt_Helper()->get_setting( 'link', 'yes' ) === 'yes_popup' ? 'woosq-link woobt-img woobt-img-order-' . $order : 'woobt-img woobt-img-order-' . $order ) . '" data-id="' . esc_attr( $item['id'] ) . '" data-context="woobt" href="' . $item_product->get_permalink() . '" data-img="' . esc_attr( htmlentities( $item_product->get_image( self::$image_size ) ) ) . '" ' . ( WPCleverWoobt_Helper()->get_setting( 'link', 'yes' ) === 'yes_blank' ? 'target="_blank"' : '' ) . '>' . $item_product->get_image( self::$image_size ) . '</a>';
								} else {
									echo '<span class="' . esc_attr( 'woobt-img woobt-img-order-' . $order ) . '" data-img="' . esc_attr( htmlentities( $item_product->get_image( self::$image_size ) ) ) . '">' . $item_product->get_image( self::$image_size ) . '</span>';
								}

								do_action( 'woobt_product_thumb_after', $item_product, $order, 'separate', $item );

								echo '</div>';
								$order ++;
							}
						}

						do_action( 'woobt_images_after', $product );
						?>
                    </div>
					<?php
					do_action( 'woobt_images_below', $product );
				}

				$products_class = apply_filters( 'woobt_products_class', 'woobt-products woobt-products-layout-' . $layout . ' woobt-products-' . $product_id, $product );
				$products_attrs = apply_filters( 'woobt_products_data_attributes', [
					'show-price'           => WPCleverWoobt_Helper()->get_setting( 'show_price', 'yes' ),
					'optional'             => $custom_qty ? 'on' : 'off',
					'separately'           => $separately ? 'on' : 'off',
					'sync-qty'             => $sync_qty ? 'on' : 'off',
					'variables'            => self::has_variables( $items ) ? 'yes' : 'no',
					'product-id'           => $product->is_type( 'variable' ) ? '0' : $product_id,
					'product-type'         => $product->get_type(),
					'product-price-suffix' => htmlentities( $product->get_price_suffix() ),
					'pricing'              => $pricing,
					'discount'             => $discount,
				], $product );

				do_action( 'woobt_products_above', $product );
				?>
                <div class="<?php echo esc_attr( $products_class ); ?>" <?php echo WPCleverWoobt_Helper()->data_attributes( $products_attrs ); ?>>
					<?php
					do_action( 'woobt_products_before', $product );

					if ( ! $ignore_this_item ) {
						// this item
						$this_item_quantity = apply_filters( 'woobt_this_item_quantity', false, $product );
						$this_item_name     = apply_filters( 'woobt_product_get_name', $product->get_name(), $product );
						$this_item_attrs    = apply_filters( 'woobt_this_item_data_attributes', [
							'order'         => 0,
							'qty'           => 1,
							'o_qty'         => 1,
							'id'            => $product->is_type( 'variable' ) || ! $product->is_in_stock() ? 0 : $product_id,
							'pid'           => $product_id,
							'name'          => $this_item_name,
							'price'         => apply_filters( 'woobt_item_data_price', wc_get_price_to_display( $product ), $product ),
							'regular-price' => apply_filters( 'woobt_item_data_regular_price', wc_get_price_to_display( $product, [ 'price' => $product->get_regular_price() ] ), $product ),
							'new-price'     => ! $separately && ( $discount = get_post_meta( $product_id, 'woobt_discount', true ) ) ? ( 100 - (float) $discount ) . '%' : '100%',
							'price-suffix'  => htmlentities( $product->get_price_suffix() )
						], $product );

						ob_start();

						if ( $hide_this_item ) {
							?>
                            <div class="woobt-product woobt-product-this woobt-hide-this" <?php echo WPCleverWoobt_Helper()->data_attributes( $this_item_attrs ); ?>>
                                <div class="woobt-choose">
                                    <label for="woobt_checkbox_0"><?php echo esc_html( $this_item_name ); ?></label>
                                    <input id="woobt_checkbox_0" class="woobt-checkbox woobt-checkbox-this"
                                           type="checkbox" checked disabled/>
                                    <span class="checkmark"></span>
                                </div>
                            </div>
						<?php } else { ?>
                            <div class="woobt-product woobt-product-this" <?php echo WPCleverWoobt_Helper()->data_attributes( $this_item_attrs ); ?>>

								<?php do_action( 'woobt_product_before', $product ); ?>

                                <div class="woobt-choose">
                                    <label for="woobt_checkbox_0"><?php echo esc_html( $this_item_name ); ?></label>
                                    <span class="checkmark">
										<input id="woobt_checkbox_0" class="woobt-checkbox woobt-checkbox-this"
											   type="checkbox" checked disabled/>
										<svg width="9" height="6" viewBox="0 0 9 6" xmlns="http://www.w3.org/2000/svg">
											<path d="M3.10631 4.9152L7.9158 0.105764C8.05749 -0.0359791 8.29014 -0.0345284 8.43043 0.105764L8.89478 0.57011C9.03507 0.710402 9.03507 0.94451 8.89478 1.08475L4.08535 5.89424C3.94505 6.03453 3.7124 6.03598 3.57065 5.89424L3.10631 5.42989C2.96456 5.28815 2.96456 5.05694 3.10631 4.9152Z" fill="white"/>
											<path d="M1.05308 2.10317L3.89743 4.94755C4.035 5.08517 4.03338 5.31131 3.89743 5.44726L3.44662 5.89808C3.31067 6.03397 3.08286 6.03397 2.94692 5.89808L0.102566 3.0537C-0.0333788 2.91775 -0.034996 2.69161 0.102566 2.554L0.553384 2.10317C0.690998 1.96561 0.915469 1.96561 1.05308 2.10317Z" fill="white"/>
										</svg>
									</span>
                                </div>

								<?php if ( ! $separate_images && ( WPCleverWoobt_Helper()->get_setting( 'show_thumb', 'yes' ) !== 'no' ) ) {
									echo '<div class="woobt-thumb">';
									do_action( 'woobt_product_thumb_before', $product, 0, 'default' );
									echo '<span class="woobt-img woobt-img-order-0" data-img="' . esc_attr( htmlentities( $product->get_image( self::$image_size ) ) ) . '">' . $product->get_image( self::$image_size ) . '</span>';
									do_action( 'woobt_product_thumb_after', $product, 0, 'default' );
									echo '</div>';
								} ?>
								<div class="woobt-content">
									<div class="woobt-title">
										<span class="woobt-title-inner">
											<?php echo apply_filters( 'woobt_product_this_name', '<span>' . WPCleverWoobt_Helper()->localization( 'this_item', esc_html__( 'This item:', 'komestic' ) ) . '</span> <span>' . apply_filters( 'woobt_product_get_name', $product->get_name(), $product ) . '</span>', $product ); ?>
										</span>

										<?php 
										echo '<div class="woobt-availability">' . apply_filters( 'woobt_product_availability', ! $product->is_type( 'variable' ) ? wc_get_stock_html( $product ) : '', $product ) . '</div>';
										?>
									</div>
									<?php if ( $separate_images && ( WPCleverWoobt_Helper()->get_setting( 'show_price', 'yes' ) !== 'no' ) ) { ?>
										<span class="woobt-price">
											<span class="woobt-price-new el-empty">
												<?php
												if ( ! $separately && ( $discount = get_post_meta( $product_id, 'woobt_discount', true ) ) ) {
													$sale_price = $product->get_price() * ( 100 - (float) $discount ) / 100;
													echo wc_format_sale_price( $product->get_price(), $sale_price ) . $product->get_price_suffix( $sale_price );
												} else {
													pxl_print_html($product->get_price_html());
												}
												?>
											</span>
											<span class="woobt-price-ori">
												<?php pxl_print_html($product->get_price_html()); ?>
											</span>
										</span>
									<?php
									}
									if ( ! $separate_images && ( WPCleverWoobt_Helper()->get_setting( 'show_price', 'yes' ) !== 'no' ) ) { ?>
										<div class="woobt-price">
											<div class="woobt-price-new el-empty">
												<?php
												if ( ! $separately && ( $discount = get_post_meta( $product_id, 'woobt_discount', true ) ) ) {
													$sale_price = $product->get_price() * ( 100 - (float) $discount ) / 100;
													echo wc_format_sale_price( $product->get_price(), $sale_price ) . $product->get_price_suffix( $sale_price );
												} else {
													pxl_print_html($product->get_price_html());
												}
												?>
											</div>
											<div class="woobt-price-ori">
												<?php pxl_print_html($product->get_price_html()); ?>
											</div>
										</div>
									<?php }
									if ( $product->is_type( 'variable' ) && class_exists( 'Komestic_Woovr' ) ) {
										echo '<div class="wpc_variations_form">';
											Komestic_Woovr::komestic_woovr_variations_form( $product, false, 'woobt', [], true );
										echo '</div>';
									} ?>
								</div>

								<?php do_action( 'woobt_product_after', $product ); ?>
                            </div><!-- /.woobt-product-this -->
							<?php
						}

						echo apply_filters( 'woobt_product_this_output', ob_get_clean(), $product, $custom_position );
					}

					// other items
					$order = 1;

					// store global $product
					$global_product = $product;

					foreach ( $items as $item_key => $item ) {
						if ( ! empty( $item['id'] ) ) {
							$item['key'] = $item_key;
							$product     = $item['product'];
							$item_id     = $item['id'];
							$item_price  = $item['price'];
							$item_qty    = $item['qty'];
							$item_min    = 1;
							$item_max    = 1000;

							if ( $custom_qty ) {
								if ( get_post_meta( $product_id, 'woobt_limit_each_min_default', true ) === 'on' ) {
									$item_min = $item_qty;
								} else {
									$item_min = absint( get_post_meta( $product_id, 'woobt_limit_each_min', true ) ?: 0 );
								}

								$item_min = absint( apply_filters( 'woobt_limit_each_min', $item_min, $item, $product_id ) );
								$item_max = absint( apply_filters( 'woobt_limit_each_max', get_post_meta( $product_id, 'woobt_limit_each_max', true ) ?: 1000, $item, $product_id ) );

								if ( ( $max_purchase = $product->get_max_purchase_quantity() ) && ( $max_purchase > 0 ) && ( $max_purchase < $item_max ) ) {
									// get_max_purchase_quantity can return -1
									$item_max = $max_purchase;
								}

								if ( $item_qty < $item_min ) {
									$item_qty = $item_min;
								}

								if ( ( $item_max > $item_min ) && ( $item_qty > $item_max ) ) {
									$item_qty = $item_max;
								}
							}

							$item_price         = apply_filters( 'woobt_item_price', ! $separately ? $item_price : '100%', $item, $product_id );
							$item_name          = apply_filters( 'woobt_product_get_name', $product->get_name(), $product );
							$checked_individual = apply_filters( 'woobt_checked_individual', false, $item, $product_id, $order );
							$item_checked       = apply_filters( 'woobt_item_checked', $product->is_in_stock() && ( $checked_individual || ( $checked_all && ( $selection === 'multiple' ) ) || ( $checked_all && ( $selection === 'single' ) && ( $order === 1 ) ) ), $item, $product_id, $order );
							$item_disabled      = apply_filters( 'woobt_item_disabled', ! $product->is_in_stock(), $item, $product_id, $order );
							$item_attrs         = apply_filters( 'woobt_item_data_attributes', [
								'key'           => $item_key,
								'order'         => $order,
								'id'            => $product->is_type( 'variable' ) || ! $product->is_in_stock() ? 0 : $item_id,
								'pid'           => $item_id,
								'name'          => $item_name,
								'new-price'     => $item_price,
								'price-suffix'  => htmlentities( $product->get_price_suffix() ),
								'price'         => apply_filters( 'woobt_item_data_price', ( $pricing === 'sale_price' ) ? wc_get_price_to_display( $product ) : wc_get_price_to_display( $product, [ 'price' => $product->get_regular_price() ] ), $product ),
								'regular-price' => apply_filters( 'woobt_item_data_regular_price', wc_get_price_to_display( $product, [ 'price' => $product->get_regular_price() ] ), $product ),
								'qty'           => $item_qty,
								'o_qty'         => $item_qty,
							], $item, $product_id, $order );

							ob_start();
							?>
                            <div class="woobt-product woobt-product-together" <?php echo WPCleverWoobt_Helper()->data_attributes( $item_attrs ); ?>>

								<?php do_action( 'woobt_product_before', $product, $order ); ?>

                                <div class="woobt-choose checkbox-custom">
                                    <label for="<?php echo esc_attr( 'woobt_checkbox_' . $order ); ?>"><?php echo esc_html( $item_name ); ?></label>
                                    <span class="checkmark">
										<input id="<?php echo esc_attr( 'woobt_checkbox_' . $order ); ?>"
											   class="woobt-checkbox" type="checkbox"
											   value="<?php echo esc_attr( $item_id ); ?>" <?php echo esc_attr( $item_disabled ? 'disabled' : '' ); ?> <?php echo esc_attr( $item_checked ? 'checked' : '' ); ?>/>
										<svg width="9" height="6" viewBox="0 0 9 6" xmlns="http://www.w3.org/2000/svg">
											<path d="M3.10631 4.9152L7.9158 0.105764C8.05749 -0.0359791 8.29014 -0.0345284 8.43043 0.105764L8.89478 0.57011C9.03507 0.710402 9.03507 0.94451 8.89478 1.08475L4.08535 5.89424C3.94505 6.03453 3.7124 6.03598 3.57065 5.89424L3.10631 5.42989C2.96456 5.28815 2.96456 5.05694 3.10631 4.9152Z" fill="white"/>
											<path d="M1.05308 2.10317L3.89743 4.94755C4.035 5.08517 4.03338 5.31131 3.89743 5.44726L3.44662 5.89808C3.31067 6.03397 3.08286 6.03397 2.94692 5.89808L0.102566 3.0537C-0.0333788 2.91775 -0.034996 2.69161 0.102566 2.554L0.553384 2.10317C0.690998 1.96561 0.915469 1.96561 1.05308 2.10317Z" fill="white"/>
										</svg>
									</span>
                                </div>

								<?php if ( ! $separate_images && ( WPCleverWoobt_Helper()->get_setting( 'show_thumb', 'yes' ) !== 'no' ) ) {
									echo '<div class="woobt-thumb">';

									do_action( 'woobt_product_thumb_before', $product, $order, 'default', $item );

									if ( WPCleverWoobt_Helper()->get_setting( 'link', 'yes' ) !== 'no' ) {
										echo '<a class="' . esc_attr( WPCleverWoobt_Helper()->get_setting( 'link', 'yes' ) === 'yes_popup' ? 'woosq-link woobt-img woobt-img-order-' . $order : 'woobt-img woobt-img-order-' . $order ) . '" data-id="' . esc_attr( $item_id ) . '" data-context="woobt" href="' . $product->get_permalink() . '" data-img="' . esc_attr( htmlentities( $product->get_image( self::$image_size ) ) ) . '" ' . ( WPCleverWoobt_Helper()->get_setting( 'link', 'yes' ) === 'yes_blank' ? 'target="_blank"' : '' ) . '>' . $product->get_image( self::$image_size ) . '</a>';
									} else {
										echo '<span class="' . esc_attr( 'woobt-img woobt-img-order-' . $order ) . '" data-img="' . esc_attr( htmlentities( $product->get_image( self::$image_size ) ) ) . '">' . $product->get_image( self::$image_size ) . '</span>';
									}

									do_action( 'woobt_product_thumb_after', $product, $order, 'default', $item );

									echo '</div>';
								} ?>

								<div class="woobt-content">
									<div class="woobt-title">
										<?php
										echo '<span class="woobt-title-inner">';
	
										do_action( 'woobt_product_name_before', $product, $order );
	
										// if ( ! $custom_qty ) {
										// 	$product_qty = '<span class="woobt-qty-num"><span class="woobt-qty">' . $item_qty . '</span> × </span>';
										// } else {
										// 	$product_qty = '';
										// }
	
										// echo apply_filters( 'woobt_product_qty', $product_qty, $item_qty, $product );
	
										if ( $product->is_in_stock() ) {
											$product_name = apply_filters( 'woobt_product_get_name', $product->get_name(), $product );
										} else {
											$product_name = '<s>' . apply_filters( 'woobt_product_get_name', $product->get_name(), $product ) . '</s>';
										}
	
										if ( WPCleverWoobt_Helper()->get_setting( 'link', 'yes' ) !== 'no' ) {
											$product_name = '<a ' . ( WPCleverWoobt_Helper()->get_setting( 'link', 'yes' ) === 'yes_popup' ? 'class="woosq-link" data-id="' . $item_id . '" data-context="woobt"' : '' ) . ' href="' . $product->get_permalink() . '" ' . ( WPCleverWoobt_Helper()->get_setting( 'link', 'yes' ) === 'yes_blank' ? 'target="_blank"' : '' ) . '>' . $product_name . '</a>';
										} else {
											$product_name = '<span>' . $product_name . '</span>';
										}
										echo apply_filters( 'woobt_product_name', $product_name, $product );
	
										do_action( 'woobt_product_name_after', $product, $order );
										echo '</span>';
										if ( WPCleverWoobt_Helper()->get_setting( 'show_description', 'no' ) === 'yes' ) {
											echo '<div class="woobt-description">' . apply_filters( 'woobt_product_short_description', $product->is_type( 'variation' ) ? $product->get_description() : $product->get_short_description(), $product ) . '</div>';
										}
	
										echo '<div class="woobt-availability">' . apply_filters( 'woobt_product_availability', ! $product->is_type( 'variable' ) ? wc_get_stock_html( $product ) : '', $product ) . '</div>';
										?>
									</div>
									<?php if ( $separate_images && ( WPCleverWoobt_Helper()->get_setting( 'show_price', 'yes' ) !== 'no' ) ) {
										echo '<span class="woobt-price">';

										do_action( 'woobt_product_price_before', $product, $order );

										if ( ! $separately && ( $item_price !== '100%' ) ) {
											if ( $product->is_type( 'variable' ) ) {
												$item_ori_price_min = apply_filters( 'woobt_product_price_ori', ( $pricing === 'sale_price' ) ? $product->get_variation_price( 'min', true ) : $product->get_variation_regular_price( 'min', true ), $item, 'min' );
												$item_ori_price_max = apply_filters( 'woobt_product_price_ori', ( $pricing === 'sale_price' ) ? $product->get_variation_price( 'max', true ) : $product->get_variation_regular_price( 'max', true ), $item, 'max' );
												$item_new_price_min = WPCleverWoobt_Helper()->new_price( $item_ori_price_min, $item_price );
												$item_new_price_max = WPCleverWoobt_Helper()->new_price( $item_ori_price_max, $item_price );

												if ( $item_new_price_min < $item_new_price_max ) {
													$product_price = wc_format_price_range( $item_new_price_min, $item_new_price_max );
												} else {
													$product_price = wc_format_sale_price( $item_ori_price_min, $item_new_price_min );
												}
											} else {
												$item_ori_price = apply_filters( 'woobt_product_price_ori', ( $pricing === 'sale_price' ) ? wc_get_price_to_display( $product, [ 'price' => $product->get_price() ] ) : wc_get_price_to_display( $product, [ 'price' => $product->get_regular_price() ] ), $item );
												$item_new_price = WPCleverWoobt_Helper()->new_price( $item_ori_price, $item_price );

												if ( $item_new_price < $item_ori_price ) {
													$product_price = wc_format_sale_price( $item_ori_price, $item_new_price );
												} else {
													$product_price = wc_price( $item_new_price );
												}
											}

											$product_price .= $product->get_price_suffix();
										} else {
											$product_price = $product->get_price_html();
										}

										echo apply_filters( 'woobt_product_price', $product_price, $product, $item );

										echo '</span>';
									}


									if ( $custom_qty ) {
										echo '<div class="' . esc_attr( ( $plus_minus ? 'woobt-quantity woobt-quantity-plus-minus' : 'woobt-quantity' ) ) . '">';

										do_action( 'woobt_product_qty_before', $product, $order );

										if ( $plus_minus ) {
											echo '<div class="woobt-quantity-input">';
											echo '<div class="woobt-quantity-input-minus">-</div>';
										}

										$qty_args = [
											'classes'     => [
												'input-text',
												'woobt-qty',
												'woobt_qty',
												'qty',
												'text'
											],
											'input_name'  => 'woobt_qty_' . $order,
											'input_value' => $item_qty,
											'min_value'   => $item_min,
											'max_value'   => $item_max,
											'woobt_qty'   => [
												'input_value' => $item_qty,
												'min_value'   => $item_min,
												'max_value'   => $item_max
											]
											// compatible with WPC Product Quantity
										];

										if ( apply_filters( 'woobt_use_woocommerce_quantity_input', true ) ) {
											woocommerce_quantity_input( $qty_args, $product );
										} else {
											echo apply_filters( 'woobt_quantity_input', '<input type="number" class="input-text woobt-qty woobt_qty qty text" name="' . esc_attr( 'woobt_qty_' . $order ) . '" value="' . esc_attr( $item_qty ) . '" min="' . esc_attr( $item_min ) . '" max="' . esc_attr( $item_max ) . '" />', $qty_args, $product );
										}

										if ( $plus_minus ) {
											echo '<div class="woobt-quantity-input-plus">+</div>';
											echo '</div>';
										}

										do_action( 'woobt_product_qty_after', $product, $order );

										echo '</div>';
									}

									if ( ! $separate_images && ( WPCleverWoobt_Helper()->get_setting( 'show_price', 'yes' ) !== 'no' ) ) {
										echo '<div class="woobt-price">';

										do_action( 'woobt_product_price_before', $product, $order );

										echo '<div class="woobt-price-new el-empty"></div>';
										echo '<div class="woobt-price-ori">';

										if ( ! $separately && ( $item_price !== '100%' ) ) {
											if ( $product->is_type( 'variable' ) ) {
												$item_ori_price_min = apply_filters( 'woobt_product_price_ori', ( $pricing === 'sale_price' ) ? $product->get_variation_price( 'min', true ) : $product->get_variation_regular_price( 'min', true ), $item, 'min' );
												$item_ori_price_max = apply_filters( 'woobt_product_price_ori', ( $pricing === 'sale_price' ) ? $product->get_variation_price( 'max', true ) : $product->get_variation_regular_price( 'max', true ), $item, 'max' );
												$item_new_price_min = WPCleverWoobt_Helper()->new_price( $item_ori_price_min, $item_price );
												$item_new_price_max = WPCleverWoobt_Helper()->new_price( $item_ori_price_max, $item_price );

												if ( $item_new_price_min < $item_new_price_max ) {
													$product_price = wc_format_price_range( $item_new_price_min, $item_new_price_max );
												} else {
													$product_price = wc_format_sale_price( $item_ori_price_min, $item_new_price_min );
												}
											} else {
												$item_ori_price = apply_filters( 'woobt_product_price_ori', ( $pricing === 'sale_price' ) ? wc_get_price_to_display( $product, [ 'price' => $product->get_price() ] ) : wc_get_price_to_display( $product, [ 'price' => $product->get_regular_price() ] ), $item );
												$item_new_price = WPCleverWoobt_Helper()->new_price( $item_ori_price, $item_price );

												if ( $item_new_price < $item_ori_price ) {
													$product_price = wc_format_sale_price( $item_ori_price, $item_new_price );
												} else {
													$product_price = wc_price( $item_new_price );
												}
											}

											$product_price .= $product->get_price_suffix();
										} else {
											$product_price = $product->get_price_html();
										}

										echo apply_filters( 'woobt_product_price', $product_price, $product, $item );

										echo '</div>';

										do_action( 'woobt_product_price_after', $product, $order );

										echo '</div><!-- /.woobt-price -->';
									}
									if ( $product->is_type( 'variable' ) && class_exists( 'Komestic_Woovr' ) ) {
										echo '<div class="wpc_variations_form">';
											Komestic_Woovr::komestic_woovr_variations_form( $product, false, 'woobt' );
										echo '</div>';
									} 
								?>
								</div>



								<?php do_action( 'woobt_product_after', $product, $order ); ?>

                            </div><!-- /.woobt-product-together -->

							<?php echo apply_filters( 'woobt_product_output', ob_get_clean(), $item, $product_id, $order );

							$order ++;
						} else {
							// heading/paragraph
							echo self::text_output( $item, $item_key, $product_id );
						}
					}

					// restore global $product
					$product = $global_product;

					do_action( 'woobt_products_after', $product );
					?>
                </div><!-- /woobt-products -->
				<?php
				do_action( 'woobt_products_below', $product );

				do_action( 'woobt_summary_above', $product );

				echo '<div class="woobt-summary">';

				// echo '<div class="woobt-additional woobt-text"></div>';

				do_action( 'woobt_total_above', $product );


				$total = 0;
				if($product->is_type('simple')) {
					if($product->is_on_sale()){
						$total = $product->get_sale_price();
					}else{
						$total = $product->get_regular_price();
					}
					
				}

				echo '<div class="pxl-woobt-price"><span class="total-label">'.esc_html__('Total Price: ', 'komestic').'</span><span class="price">'.wc_price($total).'</span></div>';

				do_action( 'woobt_alert_above', $product );

				echo '<div class="woobt-alert woobt-text"></div>';

				if ( $custom_position || $separate_atc ) {
					do_action( 'woobt_actions_above', $product );
					echo '<div class="woobt-actions">';
					do_action( 'woobt_actions_before', $product );
					echo '<div class="woobt-form">';
					echo '<input type="hidden" name="woobt_ids" class="woobt-ids woobt-ids-' . esc_attr( $product_id ) . '" data-id="' . esc_attr( $product_id ) . '"/>';
					echo '<input type="hidden" name="quantity" value="1"/>';
					echo '<input type="hidden" name="product_id" value="' . esc_attr( $product_id ) . '">';
					echo '<input type="hidden" name="variation_id" class="variation_id" value="0">';
					echo '<button type="submit" class="pxl-button button--primary single_add_to_cart_button button alt">'.
								'<span class="button__text">' . WPCleverWoobt_Helper()->localization( 'add_all_to_cart', esc_html__( 'Add Selected To Cart', 'komestic' ) ) . '</span>'.
								'<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
									<path d="M0 5.14282H12V6.85712H0V5.14282Z" fill="currentcolor"></path>
								</svg>'.
								'<span class="pxl-woobt-total"></span>'.
							'</button>';
					echo '</div>';
					do_action( 'woobt_actions_after', $product );
					echo '</div><!-- /woobt-actions -->';
					do_action( 'woobt_actions_below', $product );
				}

				echo '</div><!-- /woobt-summary -->';

				do_action( 'woobt_summary_below', $product );

				if ( $layout === 'compact' ) {
					echo '</div><!-- /woobt-inner -->';
				}

				if ( ! empty( $after_text ) ) {
					do_action( 'woobt_after_text_above', $product );
					echo '<div class="woobt-after-text woobt-text">' . wp_kses_post( do_shortcode( $after_text ) ) . '</div>';
					do_action( 'woobt_after_text_below', $product );
				}

				do_action( 'woobt_wrap_after', $product );
			}

			if ( ! $is_variation ) {
				echo '</div><!-- /woobt-wrap -->';
			}
		}
}

