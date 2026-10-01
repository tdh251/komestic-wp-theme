<?php 
if(class_exists('Woocommerce')) {
?>
<div class="my-account">
    <?php pxl_print_html(do_shortcode('[woocommerce_my_account]')); ?>
</div>
<?php
}
?>