<?php
global $product;

if ( !$product ) {
    return;
}

$average_rating = $product->get_average_rating();
$rating_count = $product->get_rating_count();
$rating_html = wc_get_rating_html( $average_rating, $rating_count );
?>
<div class="product-rating">
    <?php pxl_print_html($rating_html); ?>
    <?php if($rating_count == 0) : ?>
        <span><?php echo esc_html('(No reviews yet)', 'komestic'); ?></span>
    <?php endif; ?>
</div>