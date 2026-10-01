<?php
wp_enqueue_script( 'komestic-swiper' );
$suggest = 'komestic_' . $widget->get_setting('suggest', 'recent') . '_products';
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);

$layout_type = $widget->get_setting('layout_type', 'grid');

$title_tag = $widget->get_setting('title_tag', 'div');
$img_dimension = $widget->get_setting('img_dimension', 'custom');
if($img_dimension === 'custom') {
    $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
    $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : ['width' => 300, 'height' => 300];
}
$entrance_anim = $widget->get_setting('entrance_anim', '');
$anim_delay = $widget->get_setting('anim_delay', 0);

$show_category = (bool)$widget->get_setting('show_category', '');

if($settings['suggest'] === 'package') {
    $product_id   = (int) $settings['product_id'] ?: 0;
    $product_ids  = komestic_get_woobt_ids($product_id);
}elseif($settings['suggest'] === 'custom'){
    $product_ids = $settings['product_ids'];
}else {
    $product_ids = explode('-', do_shortcode('['.$suggest.' limit="' . $limit . '" orderby="' . $orderby . '" order="' . $order . '"]'));
}

if($layout_type === 'grid') : ?>
    <div id="<?php echo esc_html($settings['html_id'] ?: pxl_get_element_id($settings)); ?>" class="grid product-suggested" data-layout="4">
        <div class="grid__inner">
            <?php if(!empty($product_ids)) : ?>
                <?php foreach($product_ids as $product_id) :
                    // global $product; 
                    $product = wc_get_product( $product_id );
                    if ( ! $product ) continue;
                ?>
                    <div class="grid__item <?php echo esc_attr($entrance_anim); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                        <?php  
                        wc_get_template(
                        'template-parts/woocommerce/content-product/style-1.php',
                            array(
                                'product'  => $product,
                                'img_dimension' => $img_dimension,
                                'title_tag' => $title_tag,
                            ),
                        );     
                        ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
<?php else : 
    $allow_touch_move = $widget->get_setting('allow_touch_move', '');
    $autoplay = $widget->get_setting('autoplay', false);
    $delay = $widget->get_setting('delay', 5000);
    $disable_on_interaction = $widget->get_setting('disable_on_interaction', false);
    $loop  = $widget->get_setting('loop', false);
    $speed = $widget->get_setting('speed', 500);
    $pagination = $widget->get_setting('swiper_pagination', '');
    $navigation = (bool)$widget->get_setting('swiper_navigation', false);
    $space_between = $widget->get_setting('space_between', 0);
    $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 1);
    $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 1);
    $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 1);
    $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 2);
    $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 2);
    $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 2);

    $swiper_params = [
        'effect'                 => 'slide',
        'allow_touch_move'       => (bool)$allow_touch_move,
        'autoplay'               => (bool)$autoplay,
        'delay'                  => $delay,
        'disable_on_interaction' => (bool)$disable_on_interaction,
        'loop'                   => (bool)$loop,
        'speed'                  => $speed,
        'pagination'             => $pagination,
        'navigation'             => $navigation,
        'space_between'          => $space_between,
        'slides_per_view_xs'     => (int)$slides_per_view_xs,
        'slides_per_view_sm'     => (int)$slides_per_view_sm,
        'slides_per_view_md'     => (int)$slides_per_view_md,
        'slides_per_view_lg'     => (int)$slides_per_view_lg,
        'slides_per_view_xl'     => (int)$slides_per_view_xl,
        'slides_per_view_xxl'    => (int)$slides_per_view_xxl,
    ];
    $swiper_params = json_encode( $swiper_params );

    $swiper_boxshadow = $widget->get_setting('swiper_boxshadow', '');
    $nav_widget_id = $widget->get_setting('nav_widget_id', '');
    $navigation_hidden_class = !empty($nav_widget_id) ? 'swiper-navigation-hidden' : null;
    $nav_btn_icon_prev = $widget->get_settings('nav_btn_icon_prev', []);
    $nav_btn_icon_next = $widget->get_settings('nav_btn_icon_next', []);
?>
    <div id="<?php echo esc_html($settings['html_id'] ?: pxl_get_element_id($settings)); ?>" class="pxl-swiper product-suggested <?php echo esc_attr($swiper_boxshadow); ?>" data-layout="4">
        <div class="swiper-inner">
            <div class="swiper-container" data-swiper="<?php echo esc_attr($swiper_params); ?>">
                <div class="swiper-wrapper">
                    <?php if(!empty($product_ids)) : ?>
                        <?php foreach($product_ids as $key => $product_id) : 
                            global $product;
                            $product = wc_get_product( $product_id );
                            if ( ! $product ) continue;
                        ?>
                            <div class="swiper-slide <?php echo esc_attr($entrance_anim); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                                <?php 
                                wc_get_template(
                                'template-parts/woocommerce/content-product/style-1.php',
                                    array(
                                        'product'  => $product,
                                        'img_dimension' => $img_dimension,
                                        'title_tag' => $title_tag,
                                    ),
                                );     
                                ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php if(!empty($pagination)) : ?>
                    <div class="swiper-pagination"></div>
                <?php endif; ?>
                <?php if($navigation) : ?>
                    <div class="swiper-navigation <?php echo esc_attr($navigation_hidden_class); ?>" <?php if(!empty($nav_widget_id)) : ?> data-navigation-id="<?php echo esc_attr($nav_widget_id); ?>" <?php endif; ?>>
                        <div class="pxl-swiper-button swiper-button-prev">
                            <?php \Elementor\Icons_Manager::render_icon( $nav_btn_icon_prev, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                        </div>
                        <div class="pxl-swiper-button swiper-button-next">
                            <?php \Elementor\Icons_Manager::render_icon( $nav_btn_icon_next, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>