<?php
    global $product;

    if ( !$product ) {
        return;
    }
?>
    <div class="product-meta">
        <?php woocommerce_template_single_meta(); 
        woocommerce_template_single_sharing(); ?>  
    </div>