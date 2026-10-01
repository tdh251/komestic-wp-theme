<?php
    $product_categories_html = get_product_categories_to_product_id($product->get_id());
    $image_html = komestic_get_image_by_size([
        'img_dimension' => $img_dimension,
    ], $product->get_id());
    $features = get_post_meta($product->get_id(), 'product_features', true);
    $sale_from = get_post_meta( $product->get_id(), '_sale_price_dates_from', true );
    $sale_to   = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
    $now = time();
    $href_link = $product->get_permalink();
    $quick_add_modal = komestic()->get_theme_opt('quick_add_modal', 0);
    if ( $quick_add_modal > 0 ) {
        $href_link = '#template-' . $quick_add_modal;
    }
?>
<div class="product" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
    <div class="product__featured">
        <a href="<?php echo get_permalink( $product->get_id() ); ?>">
            <?php pxl_print_html($image_html); ?>
        </a>
    </div>
    <div class="product__content">
        <?php if($show_category) { 
            pxl_print_html($product_categories_html);
        } ?>
        <<?php echo esc_attr( $title_tag ); ?> class="product__name">
            <a href="<?php echo get_permalink( $product->get_id() ); ?>">
                <?php echo esc_html($product->get_name()); ?>
            </a>
        </<?php echo esc_attr( $title_tag ); ?>>
        <div class="product__price">
            <?php echo wp_kses_post( $product->get_price_html() ); ?>
        </div>
        <?php if($now >= $sale_from && $sale_to && $sale_to > $now) : ?>
            <div class="product__sale-coundown">
                <div class="title">
                    <?php echo esc_html__('Hurry! Sale ends in', 'komestic'); ?>
                </div>
                <ul class="pxl-countdown"
                <?php if(!empty($sale_from)) : ?> data-time-start="<?php echo esc_attr(date('Y-m-d 00:00:00', $sale_from)); ?>" <?php endif; ?>
                data-time="<?php echo esc_attr(date('Y-m-d 23:59:59', $sale_to)); ?>">
                    <li class="countdown__timer hours split"></li>
                    <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
                    <li class="countdown__timer seconds split"></li>
                </ul>
            </div>
        <?php endif; ?>
        <?php if($product->is_in_stock()) : 
            $stock_quantity = $product->get_stock_quantity();    
        ?>
            <?php if($stock_quantity > 0) : ?>
                <div class="product__is-in-stock stock"><?php pxl_print_html('Only <span class="number-of-products-in-stock">'.$stock_quantity.'</span> left in stock') ?></div>
            <?php else: ?>
                <div class="product__is-in-stock stock"><?php pxl_print_html('In Stock') ?></div>
            <?php endif; ?>
        <?php else: ?>
            <div class="product__is-in-stock out-of-stock"><?php pxl_print_html('Out of Stock') ?></div>
        <?php endif; ?>
        <div class="divider"></div>
        <?php if(!empty($features)) : ?>
            <ul class="product__features">
                <?php foreach($features as $key=>$feature) : ?>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M8.99984 17.3332C4.40539 17.3332 0.666504 13.5943 0.666504 8.99984C0.666504 4.40539 4.40539 0.666504 8.99984 0.666504C13.5943 0.666504 17.3332 4.40539 17.3332 8.99984C17.3332 13.5943 13.5943 17.3332 8.99984 17.3332ZM8.99984 1.9165C5.09428 1.9165 1.9165 5.09428 1.9165 8.99984C1.9165 12.9054 5.09428 16.0832 8.99984 16.0832C12.9054 16.0832 16.0832 12.9054 16.0832 8.99984C16.0832 5.09428 12.9054 1.9165 8.99984 1.9165ZM8.629 11.5457L12.4207 7.754C12.6651 7.50956 12.6651 7.11373 12.4207 6.87067C12.1762 6.62761 11.7804 6.62623 11.5373 6.87067L8.18734 10.2207L6.46234 8.49567C6.21789 8.25123 5.82206 8.25123 5.579 8.49567C5.33595 8.74012 5.33456 9.13595 5.579 9.379L7.74567 11.5457C7.86789 11.6679 8.02761 11.729 8.18734 11.729C8.34706 11.729 8.50678 11.6679 8.629 11.5457Z" fill="#FD5900"/>
                        </svg>
                        <?php echo esc_html($feature); ?>
                    </li>
                <?php endforeach; ?> 
            </ul>
        <?php endif; ?>
        <a href="<?php echo esc_url($href_link); ?>" class="pxl-button button--quickadd button--primary" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
            <span class="button__text">
                <?php echo esc_html__('Quick Add', 'komestic'); ?>
            </span>
        </a>
    </div>
</div>

    