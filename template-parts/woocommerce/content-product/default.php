<?php
	$show_selling_fast_bar = (bool)get_post_meta( $product->get_id(), 'show_selling_fast_bar', true);
    $is_trending = (bool)get_post_meta($product->get_id(), 'is_product_trending', true);
    $product_categories_html = get_product_categories_to_product_id($product->get_id());
    $date_time_trending = $is_trending ? get_post_meta($product->get_id(), 'date_time_trending', true) : '';
    $target = DateTime::createFromFormat('m-d-Y h:i A O', $date_time_trending);
    $now = new DateTime("now", new DateTimeZone("UTC"));

    $pa_id = komestic()->get_theme_opt('pa_display_in_box_thumbnail', '');
    $pa_html = ($product->is_type('variable')) ? komestic_get_pa_term_display_in_box_thumbnail($product, $pa_id) : '';
?>
<div class="product__featured">
    <a href="<?php echo get_permalink( $product->get_id() ); ?>">
        <?php 
            $image_html = komestic_get_image_by_size([
                'img_dimension' => $img_dimension ?? ['width' => 576, 'height' => 726],
                'attr' => [
                    'class' => 'attachment-woocommerce_thumbnail'
                ]
            ], $product->get_id());
            pxl_print_html($image_html); 
        ?>
    </a>
    <div class="product__actions">
        <?php 
            if ( class_exists('WPCleverWoosw') ) 
                echo do_shortcode('[woosw id="'.$product->get_id().'"]'); 
            woocommerce_template_loop_add_to_cart(); 
        ?>
        <?php 
        komestic_render_quick_view_button_html($product->get_id());
        komestic_render_compare_button_html($product->get_id()); 
        ?>
    </div>
    <?php if(!empty($date_time_trending) && $now < $target) : ?>
        <ul class="countdown" data-time="<?php echo esc_attr($date_time_trending); ?>">
            <li class="countdown__timer days" data-unit="D"></li>
            <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
            <li class="countdown__timer hours" data-unit="H"></li>
            <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
            <li class="countdown__timer minutes" data-unit="M"></li>
            <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
            <li class="countdown__timer seconds" data-unit="S"></li>
        </ul>
    <?php endif; ?>
    <?php if($show_selling_fast_bar && $product->is_on_sale()) : 
        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price();
        $percent = $regular_price > 0 && $sale_price < $regular_price ? round((($regular_price - $sale_price) / $regular_price) * 100) : 0;  
    ?>
        <div class="selling-bar">
            <?php selling_fast_bar_html($percent); ?>
        </div>
    <?php endif; ?>
    <?php if(!empty($pa_html)) : 
        pxl_print_html($pa_html);
    endif; ?>
</div>
<div class="product__content">
    <div class="product__content-group">
        <?php
            if(isset($show_category) && $show_category == true) {
                pxl_print_html($product_categories_html); 
            }
        ?>
        <h6 class="product__name">
            <a href="<?php echo get_permalink( $product->get_id() ); ?>">
                <?php echo esc_html($product->get_name()); ?>
            </a>
        </h6>
    </div>
    <div class="product__price">
        <?php woocommerce_template_loop_price(); ?>
    </div>
</div>
<div class="product__label">
    <?php if(!empty($date_time_trending) && $now < $target) : ?>
        <div class="product-label product-label--trending">
            <?php echo esc_html__('Trending', 'komestic'); ?>
        </div>
    <?php  endif; ?>
    <?php 
        pxl_print_html(komestic_display_sale_percentage_label_html($product, '-', '%'));
        pxl_print_html(display_new_product_label($product)); 
    ?>
</div>
<div class="product__attributes">
    <?php echo do_shortcode('[wpcvs_archive id="'.$product->get_id().'"]') ?>
</div>