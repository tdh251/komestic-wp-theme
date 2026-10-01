<?php
    $product_categories_html = get_product_categories_to_product_id($product->get_id());
    $image_html = komestic_get_image_by_size([
        'img_dimension' => $img_dimension ?? ['width' => 300, 'height' => 300],
    ], $product->get_id());
?>
<div class="product" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
    <div class="product__featured">
        <a href="<?php echo get_permalink( $product->get_id() ); ?>">
            <?php pxl_print_html($image_html); ?>
        </a>
    </div>
    <div class="product__content">
        <?php if(isset($show_category) && $show_category == true) { 
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
    </div>
</div>

    