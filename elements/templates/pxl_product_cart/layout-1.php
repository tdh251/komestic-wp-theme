
<?php
// defined( 'ABSPATH' ) || exit;
if ( function_exists( 'WC' ) && WC()->cart ) { 
    $total_items = WC()->cart->get_cart_contents_count();
    ?>
    <div class="product-cart">
        <?php 
        if($total_items === 0) : ?>
            <div class="cart-empty">
                <i class="flaticon flaticon-bag"></i>
                <span><?php esc_html_e( 'Your cart is empty!', 'komestic' ); ?></span>
                <a class="pxl-button button--primary button-cart-empty" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
                    <span class="button__text">
                        <?php echo esc_html__('Browse Shop', 'komestic'); ?>
                    </span>
                </a>
            </div>
            <?php
            return;
        endif; 
            $free_shipping_opt = get_available_free_shipping_for_current_user();
            $free_shipping_progess_bar_html = komestic_shipping_progress_bar_html();
            if(!empty($free_shipping_progess_bar_html)) { ?>
                <div class="cart-header">
                    <div class="free-shipping">
                        <div class="free-shipping__title">
                            <?php 
                                echo wp_kses_post(
                                    'Spend <span class="highlight">$' . $free_shipping_opt['min_amount'] . '</span> more to get <span class="highlight">' . $free_shipping_opt['title'] . '</span>'
                                );
                            ?>
                        </div>
                        <?php pxl_print_html($free_shipping_progess_bar_html); ?>
                    </div>
                </div>
            <?php }
        ?>
        <div class="cart-body">
            <?php
            do_action( 'woocommerce_before_cart' ); ?>
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>
                <div class="cart-table shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                    <div class="cart-table-header">
                        <div class="table-title product-info"><?php esc_html_e( 'Product', 'komestic' ); ?></div>
                        <div class="table-title product-price"><?php esc_html_e( 'Price', 'komestic' ); ?></div>
                        <div class="table-title product-quantity"><?php esc_html_e( 'Quantity', 'komestic' ); ?></div>
                        <div class="table-title product-subtotal"><?php esc_html_e( 'Subtotal', 'komestic' ); ?></div>
                    </div>

                    <?php pxl_print_html(komestic_products_cart_content_html()); ?>

                    <button type="submit" class="pxl-button <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'komestic' ); ?>">
                        <span class="screen-reader-text"><?php esc_html_e( 'Update cart', 'komestic' ); ?></span>
                        <span class="button__text">
                            <?php esc_html_e( 'Update cart', 'komestic' ); ?>
                        </span>
                    </button>

                    <?php do_action( 'woocommerce_cart_actions' ); ?>

                    <p class="cart-note">
                        <?php $saved_note = WC()->session->get('komestic_order_note'); ?>
                        <label for="note"><?php echo esc_html__('Special instructions for seller', 'komestic'); ?></label>
                        <textarea name="note" class="order-note" placeholder="<?php echo esc_attr__('Instruction for seller...', 'komestic'); ?>"><?php echo esc_html($saved_note); ?></textarea>
                    </p>

                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                </div>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>

            <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

            <div class="cart-collaterals">
                <div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

                    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

                    <div class="cart_totals-box">
                        <h5 class="cart_totals-title">
                            <span class="total-title" data-title="<?php esc_attr_e( 'Total', 'komestic' ); ?>">
                                <?php esc_html_e( 'Total:', 'komestic' ); ?>
                            </span>
                            <span class="total-amount pxl-cart-subtotal">
                                <?php echo WC()->cart->get_cart_subtotal(); ?>
                            </span>
                        </h5>
                        <p class="cart_total-note">
                            <?php echo esc_html__('Taxes and shipping calculated at checkout', 'komestic'); ?>
                        </p>
                    
                    </div>
                    
                    <span class="divider"></span>

                    <?php $term_link_attrs = komestic_get_link_attributes($settings['terms_and_conditions_link_page']); ?>

                    <div class="cart_total-checkbox">
                        <label class="form-checkbox-control" for="argee_terms_and_conditions">
                            <input type="checkbox" name="argee_terms_and_conditions" id="argee_terms_and_conditions" data-alert="You need to agree to the terms and conditions.">
                            <div class="checkbox">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                    <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="white"/>
                                </svg>
                            </div>
                            <span class="label-text">
                                <?php echo esc_html__('I argee ', 'komestic'); ?>
                                <a <?php pxl_print_html($term_link_attrs); ?>><?php echo esc_html__('Terms and conditions', 'komestic'); ?></a>
                            </span>
                        </label>
                    </div>

                    <div class="wc-proceed-to-checkout">
                        <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
                    </div>

                    <?php  
                        $payment_method_imgs = $widget->get_setting('payment_method_imgs', []);
                        if(!empty($payment_method_imgs)) { 
                            $payment_method_title = $widget->get_setting('payment_method_title', '');    
                        ?>
                        <div class="payment-method">
                            <div class="payment-method__title">
                                <?php echo esc_html($payment_method_title); ?>
                            </div>
                            <div class="grid">
                                <div class="grid__inner">
                                    <?php foreach($payment_method_imgs as $img) {
                                        if (!empty($img['payment_method_img']['id'])) { ?>
                                                <div class="grid__item">
                                                    <?php echo wp_get_attachment_image($img['payment_method_img']['id'], 'full'); ?>
                                                </div> <?php
                                            }
                                        } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php do_action( 'woocommerce_after_cart_totals' ); ?>
                </div>
                <?php  
                    $testimonials = $widget->get_setting('testimonials', []);
                    if(!empty($testimonials)) :
                        $swiper_params = [
                            'effect'                 => 'slide',
                            'allow_touch_move'       => true,
                            'direction'              => 'horizontal',
                            'autoplay'               => false,
                            'delay'                  => 5000,
                            'disable_on_interaction' => false,
                            'loop'                   => false,
                            'speed'                  => 500,
                            'pagination'             => '',
                            'navigation'             => true,
                            'space_between'          => 30,
                            'centered_slides'        => false,
                            'slides_per_group'       => 1,
                            'slides_per_view_xs'     => 1,
                            'slides_per_view_sm'     => 1,
                            'slides_per_view_md'     => 1,
                            'slides_per_view_lg'     => 1,
                            'slides_per_view_xl'     => 1,
                            'slides_per_view_xxl'    => 1,
                        ];
                        $swiper_params = json_encode($swiper_params); 
                        wp_enqueue_script('komestic-swiper');
                ?>
                    <div class="cart-testimonials pxl-swiper">
                        <div class="swiper-inner">
                            <div class="swiper-container" data-swiper="<?php echo esc_attr($swiper_params); ?>">
                                <div class="swiper-wrapper">
                                    <?php foreach($testimonials as $testimonial) : ?>
                                        <div class="swiper-slide">
                                            <div class="testimonial">
                                                <div class="testimonial__header">
                                                    <div class="testimonial__icon">
                                                        <?php \Elementor\Icons_Manager::render_icon( $settings['testimonial_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                                                    </div>
                                                    <div class="testimonial__rating">
                                                        <?php if($testimonial['testimonial_rating'] > 0) : ?>
                                                            <?php for($i=0; $i<$testimonial['testimonial_rating']; $i++) : ?>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14">
                                                                    <path d="M7.49998 0L9.55801 4.95914L15 5.34753L10.83 8.80085L12.1352 14L7.49998 11.1752L2.86474 14L4.16999 8.80085L0 5.34753L5.44193 4.95914L7.49998 0Z" fill="#FD5900"/>
                                                                </svg>
                                                            <?php endfor; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <p class="testimonial__content">
                                                    <?php echo esc_html($testimonial['testimonial_content']); ?>
                                                </p>
                                                <div class="testimonial__user">
                                                    <div class="testimonial__user-avt">
                                                        <?php echo wp_get_attachment_image($testimonial['testimonial_user_avt']['id'], 'full'); ?>
                                                    </div>
                                                    <div class="testimonial__user-name">
                                                        <?php echo esc_html($testimonial['testimonial_user_name']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-navigation">
                                    <div class="pxl-swiper-button swiper-button-prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="12" viewBox="0 0 22 12">
                                            <path d="M6.03376 0L7.01371 0.974515L2.65296 5.31093H22V6.68912H2.65296L7.01371 11.0255L6.03376 12L0 5.99998L6.03376 0Z" fill="#1F1F1F"/>
                                        </svg>
                                    </div>
                                    <div class="pxl-swiper-button swiper-button-next">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="12" viewBox="0 0 22 12">
                                            <path d="M15.9662 0L14.9863 0.974515L19.347 5.31093H0V6.68912H19.347L14.9863 11.0255L15.9662 12L22 5.99998L15.9662 0Z" fill="#1F1F1F"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    endif;
                ?>
            </div>

            <?php do_action( 'woocommerce_after_cart' ); ?>
        </div>
    </div>

<?php
}