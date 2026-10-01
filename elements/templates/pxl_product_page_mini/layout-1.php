<?php
$product = wc_get_product((int)$settings['product_id']);
if(!$product) return;

$average_rating = $product->get_average_rating();
$rating_count = $product->get_rating_count();
$rating_html = wc_get_rating_html( $average_rating, $rating_count );

$wrap_class = 'product-stock';
$stock_text = 'In Stock';
if(!$product->is_in_stock()) {
    $wrap_class .= ' out-of-stock';
    $stock_text = 'Out Of Stock';
}

$sale_from = get_post_meta( $product->get_id(), '_sale_price_dates_from', true );
$sale_to   = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
$now = time();
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

$img_dimension = $widget->get_setting('img_dimension', 'full');
if($img_dimension === 'custom') {
    $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
    $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : ['width' => 991, 'height' => 1048];
}
$thumbnail_html = komestic_get_image_by_size([
    'img_dimension' => $img_dimension,
    'attr' => [
        'class' => 'attachment-woocommerce_thumbnail'
    ]
], $product->get_id());

$title_tag = $widget->get_setting('title_tag', 'h4');
$entrance_anim = $widget->get_setting('entrance_anim', '');
?>
<div class="product-single-mini <?php echo esc_attr($entrance_anim); ?>">
    <div class="product product-type-<?php echo esc_attr($product->get_type()); ?>">
        <div class="summary">
            <div class="product-image">
                <?php pxl_print_html($thumbnail_html); ?>
            </div>
            <div class="product-main">
                <div class="product-rating">
                    <?php pxl_print_html($rating_html); ?>
                    <?php if($rating_count == 0) : ?>
                        <span><?php echo esc_html('(No reviews yet)'); ?></span>
                    <?php else: ?>
                        <span><?php echo esc_html($rating_count.' reviews'); ?></span>
                    <?php endif; ?>
                </div>
                
                <<?php echo esc_attr($title_tag); ?> class="product-title">
                    <?php echo esc_html($product->get_name());  ?>
                </<?php echo esc_attr($title_tag); ?>>
                <div class="product-price">
                    <div class="price">
                        <?php pxl_print_html($product->get_price_html()); ?>
                    </div>
                    <?php
                        pxl_print_html(komestic_display_sale_percentage_label_html($product, '', '% OFF'));
                    ?>
                </div>        
                <div class="<?php echo esc_attr($wrap_class); ?>">
                    <span class="product-label product-label--stock"><?php echo esc_html($stock_text); ?></span>
                    <p class="selled">
                        <svg class="svg--original" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M15.2766 10.9242C15.2564 10.6149 14.9243 10.4281 14.6495 10.5714C14.4105 10.6961 13.661 11.0196 13.0706 11.0196C12.6164 11.0196 12.3139 10.8694 12.3139 10.1362C12.3139 8.12636 15.0131 6.52078 12.6063 3.51218C12.3302 3.16719 11.7737 3.41746 11.8476 3.85238C11.8491 3.86145 11.9894 4.77182 11.5639 5.27582C11.3643 5.51218 11.0618 5.62711 10.6391 5.62711C9.17527 5.62711 9.27719 1.94027 11.1231 0.795793C11.5335 0.541367 11.2709 -0.0948905 10.802 0.0119845C10.6837 0.0387033 7.88757 0.701328 6.39178 3.62798C5.28109 5.80099 5.88265 7.29977 6.32189 8.39418C6.71444 9.3722 6.89356 9.81857 6.01438 10.4273C5.68324 10.6566 5.42691 10.6328 5.42691 10.6328C4.60457 10.6328 3.82562 9.42402 3.5951 8.95879C3.40786 8.57837 2.83794 8.67311 2.78387 9.09372C2.76066 9.27457 2.2413 13.5513 4.51099 16.1312C5.7615 17.5525 7.50127 18.0581 9.40815 17.9948C11.1709 17.9357 12.5776 17.3395 13.589 16.2228C15.4646 14.152 15.2851 11.0549 15.2766 10.9242Z" fill="#F2721C"/>
                            <path d="M4.44943 10.1357C4.04619 9.74669 3.72859 9.22817 3.5951 8.95877C3.40786 8.57834 2.83794 8.67309 2.78387 9.0937C2.76066 9.27454 2.2413 13.5513 4.51099 16.1312C5.28218 17.0077 6.27893 17.5784 7.48556 17.8379C4.96085 16.3506 4.24278 13.0162 4.44943 10.1357Z" fill="#FD5900"/>
                            <path d="M3.73497 4.51577C3.70555 4.49735 3.66821 4.49735 3.63879 4.51577C2.64794 5.13712 2.64495 6.58633 3.63879 7.20955C3.66772 7.22769 3.7052 7.22825 3.73497 7.20955C4.72582 6.58816 4.7287 5.13898 3.73497 4.51577Z" fill="#F2721C"/>
                            <path d="M4.12074 4.85815C4.01253 4.72508 3.88287 4.60861 3.73497 4.51583C3.70555 4.49741 3.66821 4.49741 3.63879 4.51583C2.64794 5.13718 2.64495 6.58639 3.63879 7.20961C3.66772 7.22775 3.7052 7.22831 3.73497 7.20961C3.88291 7.11683 4.01257 7.00032 4.12078 6.86726C3.64205 6.28243 3.64121 5.44392 4.12074 4.85815Z" fill="#FD5900"/>
                            <path d="M10.8024 0.0120456C10.6841 0.0387643 7.88798 0.701389 6.39218 3.62804C4.90845 6.53089 6.48285 8.24747 6.63508 9.34645L6.63525 9.34635C6.69122 9.7498 6.54691 10.0589 6.01478 10.4273C5.69514 10.6487 5.40616 10.6817 5.10156 10.5724V10.5727C5.10156 10.5727 6.17629 11.6059 7.26209 10.8973C8.33808 10.1951 8.02723 9.11815 7.86108 8.63137L7.86147 8.63109C7.46487 7.57957 7.11795 6.19033 8.09441 4.27994C8.67414 3.14563 9.44919 2.35159 10.188 1.80269C10.4272 1.38841 10.7407 1.03316 11.1235 0.795819C11.5339 0.541428 11.2713 -0.0948294 10.8024 0.0120456Z" fill="#FD5900"/>
                        </svg>
                        <?php echo esc_html(count_product_orders_for_today($product->get_id()) . ' sold in last 24 hours'); ?>
                    </p>
                </div>
                <?php if($now >= $sale_from && $sale_to && $sale_to > $now) : ?>
                    <div class="product-sale-countdown">
                        <div class="countdown-header">
                            <?php if(!empty($settings['_icon']['value'])) : ?>
                                <div class="countdown-icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($settings['title'])) : ?>
                                <<?php echo esc_attr($title_tag); ?> class="countdown-title">
                                    <?php echo esc_attr($settings['title']); ?>
                                </<?php echo esc_attr($title_tag); ?>>
                            <?php endif; ?>
                        </div>
                        <ul class="countdown" 
                        <?php if(!empty($sale_from)) : ?> data-time-start="<?php echo esc_attr(date('Y-m-d 00:00:00', $sale_from)); ?>" <?php endif; ?>
                        data-time="<?php echo esc_attr(date('Y-m-d 23:59:59', $sale_to)); ?>">
                            <li class="countdown__timer days" data-unit="Days"></li>
                            <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
                            <li class="countdown__timer hours" data-unit="Hours"></li>
                            <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
                            <li class="countdown__timer minutes" data-unit="Mins"></li>
                            <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
                            <li class="countdown__timer seconds" data-unit="Secs"></li>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="product-add-to-cart">
                    <?php echo do_shortcode('[wpcvs_archive id="'.$product->get_id().'"]'); 
                    do_action( 'woocommerce_before_add_to_cart_form' );
                    ?>
        
                    <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype="multipart/form-data">
                       <div class="quantity-wrap">
                            <div class="quantity-preview">
                                <?php echo esc_html__('Quantity: ', 'komestic'); ?>
                                <span class="quantity-number"><?php esc_html_e('1', 'komestic'); ?></span>
                            </div>
                        <?php
                                woocommerce_quantity_input( array(
                                    'input_name'  => 'quantity',
                                    'input_value' => 1,
                                    'max_value'   => $product->get_max_purchase_quantity(),
                                    'min_value'   => 1,
                                    'step'        => 1,
                                ), $product );
                            ?>
                       </div>
        
                        <div class="product-actions">
                            <a href="<?php echo esc_url( $add_to_cart_url ); ?>"
                            data-quantity="1"
                            data-price="<?php echo esc_attr($final_price); ?>"
                            class="pxl-button button--primary button--add-to-cart single_mini_add_to_cart<?php echo esc_attr($product->is_type('variable') ? ' disabled' : ''); ?>"
                            data-product_id="<?php echo esc_attr( $product->get_id() ); ?>">
                                <span class="button__text"><?php echo esc_html('Add To Bag'); ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                    <path d="M0 5.14282H12V6.85712H0V5.14282Z" fill="currentcolor"/>
                                </svg>
                                <span class="button__text--price"><?php echo wp_kses_post( $price_html ); ?></span>
                            </a>

                            <?php
                                if ( class_exists( 'WPCleverWoosw' ) ) 
                                    pxl_print_html(do_shortcode('[woosw_btn id="'.esc_attr($product->get_id()).'"]'));
                                komestic_render_compare_button_html($product->get_id()); 
                            ?>
                        </div>
                        <?php komestic_render_button_buy_now($product); ?>
                    </form>
                </div>
                <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="pxl-button product__view-full">
                    <span class="button__text">
                        <?php echo esc_html__('View full details', 'komestic'); ?>
                    </span>
                    <span class="button__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="11" viewBox="0 0 14 11">
                            <path d="M13.2459 5.08766L9.16258 1.00432C9.05256 0.898066 8.90521 0.839269 8.75226 0.840598C8.59931 0.841927 8.45301 0.903276 8.34485 1.01143C8.2367 1.11959 8.17535 1.26589 8.17402 1.41884C8.17269 1.57179 8.23149 1.71914 8.33775 1.82916L11.4253 4.91674H1.16683C1.01212 4.91674 0.863747 4.9782 0.75435 5.0876C0.644954 5.19699 0.583496 5.34537 0.583496 5.50007C0.583496 5.65478 0.644954 5.80316 0.75435 5.91255C0.863747 6.02195 1.01212 6.08341 1.16683 6.08341H11.4253L8.33775 9.17099C8.28203 9.2248 8.23759 9.28917 8.20702 9.36034C8.17645 9.43151 8.16036 9.50805 8.15968 9.58551C8.15901 9.66296 8.17377 9.73977 8.2031 9.81146C8.23243 9.88315 8.27575 9.94829 8.33052 10.0031C8.38529 10.0578 8.45042 10.1011 8.52211 10.1305C8.5938 10.1598 8.67061 10.1746 8.74806 10.1739C8.82552 10.1732 8.90206 10.1571 8.97323 10.1266C9.0444 10.096 9.10877 10.0515 9.16258 9.99583L13.2459 5.91249C13.3553 5.8031 13.4167 5.65475 13.4167 5.50007C13.4167 5.3454 13.3553 5.19705 13.2459 5.08766Z" fill="black"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>