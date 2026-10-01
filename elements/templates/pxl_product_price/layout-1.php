<?php
    global $product;

    if ( !$product ) {
        return;
    }
?>
<div class="product-price">
    <div class="price">
        <?php pxl_print_html($product->get_price_html()); ?>
    </div>
    <?php
        pxl_print_html(komestic_display_sale_percentage_label_html($product, '', '% OFF'));
    ?>
</div>