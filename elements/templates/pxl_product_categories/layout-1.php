<?php
    $orderby = $widget->get_setting('orderby', 'date');
    $order = $widget->get_setting('order', 'desc');
    $limit = $widget->get_setting('limit', 6);
    $hide_cat_empty = (bool)$widget->get_setting('hide_cat_empty', '');
    $include_ids = $widget->get_setting('include_ids', []);
    $cat_arr = komestic_get_product_categories([
        'orderby' => $orderby,
        'order'  => $order,
        'limit' => $limit,
        'hide_cat_empty' => $hide_cat_empty,
        'include_ids' => $include_ids,
    ]);

    $layout_type = $widget->get_setting('layout_type', 'grid');
    $img_dimension = $widget->get_setting('img_dimension', 'custom');
    if($img_dimension === 'custom') {
        $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
        $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : ['width' => 500, 'height' => 500];
    }
    $title_tag = $widget->get_setting('title_tag', 'h6');
    $entrance_anim = $widget->get_setting('entrance_anim', '');
    $anim_delay    = $widget->get_setting('anim_delay', 0);

    $pagination = $widget->get_setting('grid_pagination', '');

    $query_settings = [
        'orderby' => $orderby,
        'order'  => $order,
        'limit' => $limit,
        'hide_cat_empty' => $hide_cat_empty,
        'include_ids' => $include_ids,
    ];
    $display_settings = [
        'template' => 'default',
        'anim_delay' => $anim_delay,
        'event' => $pagination,
        'img_dimension' => $img_dimension,
        'title_tag' => $title_tag,
        'categories' => $cat_arr['categories'],
        'layout' => $layout_type,
        'entrance_anim' => $entrance_anim,
    ];
    $grid_settings = json_encode(array_merge($query_settings, $display_settings));
?>
<?php if($layout_type === 'grid') : ?>
    <div class="grid pxl-product-categories" data-layout="1" data-settings = "<?php echo esc_attr($grid_settings); ?>" data-max-pages = "<?php echo esc_attr($cat_arr['max_pages']); ?>">
        <div class="grid__inner">
            <?php komestic_render_product_categories_html($display_settings); ?>
        </div>
        <?php if ( $pagination === 'pagination' ) : ?>
            <div class="pagination paginaion--grid">
                <?php echo komestic()->page->get_pagination($cat_arr['query'], true); ?>
            </div>
        <?php endif; ?>
        <?php if ( $pagination === 'loadmore' ) : ?>
            <div class="load-more">
                <div class="load-more__inner">
                    <button class="button button--only-text load-more__button">
                        <span class="button__text">
                            <?php echo esc_html('Load More', 'komestic'); ?>
                        </span>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php else : 
    wp_enqueue_script('komestic-swiper');
    $allow_touch_move = $widget->get_setting('allow_touch_move', '');
    $autoplay = $widget->get_setting('autoplay', false);
    $delay = $widget->get_setting('delay', 5000);
    $disable_on_interaction = $widget->get_setting('disable_on_interaction', false);
    $loop  = $widget->get_setting('loop', false);
    $space_between  = $widget->get_setting('space_between', 0);
    $speed = $widget->get_setting('speed', 500);
    $pagination = $widget->get_setting('swiper_pagination', '');
    $navigation = (bool)$widget->get_setting('swiper_navigation', false);
    $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 1);
    $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 2);
    $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 3);
    $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 3);
    $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 4);
    $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 5);
    $swiper_params = [
        'effect'                 => 'slide',
        'allow_touch_move'       => (bool)$allow_touch_move,
        'direction'              => 'horizontal',
        'autoplay'               => (bool)$autoplay,
        'delay'                  => $delay,
        'disable_on_interaction' => (bool)$disable_on_interaction,
        'loop'                   => (bool)$loop,
        'speed'                  => $speed,
        'space_between'          => $space_between,
        'pagination'             => $pagination,
        'navigation'             => $navigation,
        'slides_per_view_xs'     => (int)$slides_per_view_xs,
        'slides_per_view_sm'     => (int)$slides_per_view_sm,
        'slides_per_view_md'     => (int)$slides_per_view_md,
        'slides_per_view_lg'     => (int)$slides_per_view_lg,
        'slides_per_view_xl'     => (int)$slides_per_view_xl,
        'slides_per_view_xxl'    => (int)$slides_per_view_xxl,
    ];
    $swiper_params = json_encode($swiper_params); 
    $swiper_boxshadow = $widget->get_setting('swiper_boxshadow', '');
    $nav_widget_id = $widget->get_setting('nav_widget_id', '');
    $navigation_hidden_class = !empty($nav_widget_id) ? 'swiper-navigation-hidden' : null;
    $nav_btn_icon_prev = $widget->get_settings('nav_btn_icon_prev', []);
    $nav_btn_icon_next = $widget->get_settings('nav_btn_icon_next', []);
?>
    <div class="pxl-widget pxl-swiper pxl-product-categories" data-layout="1">
        <div class="swiper-inner">
            <div class="swiper-container" data-swiper="<?php echo esc_attr($swiper_params); ?>">
                <div class="swiper-wrapper">
                    <?php komestic_render_product_categories_html($display_settings); ?>
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
