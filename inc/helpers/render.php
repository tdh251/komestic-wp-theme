<?php
function komestic_render_product_categories_html($settings) {
    extract($settings);
    ob_start();
    $template_file = get_template_directory() . '/template-parts/category/product/' . sanitize_file_name($template) . '.php';
    if(!is_array($categories)) return;
    $item_class = $layout == 'grid' ? 'grid__item' : 'swiper-slide';
    $item_class .= ' '.$entrance_anim;
    foreach ( $categories as $key => $category ) : ?>
        <?php include $template_file; ?>
    <?php endforeach;
    return pxl_print_html(ob_get_clean());
}