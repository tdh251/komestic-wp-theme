<?php 
$items = $widget->get_setting('items', []);
if(!empty($items)) :
    $allow_touch_move = $widget->get_setting('allow_touch_move', '');
    $autoplay = $widget->get_setting('autoplay', false);
    $delay = $widget->get_setting('delay', 5000);
    $disable_on_interaction = $widget->get_setting('disable_on_interaction', false);
    $loop  = $widget->get_setting('loop', false);
    $speed = $widget->get_setting('speed', 500);
    $space_between = $widget->get_setting('space_between', 0);
    $pagination = $widget->get_setting('swiper_pagination', '');
    $navigation = (bool)$widget->get_setting('swiper_navigation', false);
    $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 1);
    $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 1);
    $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 2);
    $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 2);
    $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 3);
    $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 4);
    $swiper_params = [
        'effect'                 => 'slide',
        'allow_touch_move'       => (bool)$allow_touch_move,
        'direction'              => 'horizontal',
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
    $swiper_params = json_encode($swiper_params); 
    $swiper_boxshadow = $widget->get_setting('swiper_boxshadow', '');
    $nav_widget_id = $widget->get_setting('nav_widget_id', '');
    $navigation_hidden_class = !empty($nav_widget_id) ? 'swiper-navigation-hidden' : null;
    $nav_btn_icon_prev = $widget->get_settings('nav_btn_icon_prev', []);
    $nav_btn_icon_next = $widget->get_settings('nav_btn_icon_next', []);
    $img_dimension = $widget->get_setting('img_dimension', 'full');
    if($img_dimension === 'custom') {
        $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
        $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
    }
    
    $img_hover_style = $widget->get_setting('img_hover_style', '');
    $img_hover_show_btn = (bool)$widget->get_setting('img_hover_show_btn', '');
    $entrance_anim = $widget->get_setting('entrance_anim', '');
    $anim_delay = $widget->get_setting('anim_delay', 0);
?>
    <div class="pxl-swiper pxl-image-carousel <?php echo esc_attr($swiper_boxshadow); ?>" >
        <div class="swiper-inner">
            <div class="swiper-container" data-swiper="<?php echo esc_attr($swiper_params); ?>">
                <div class="swiper-wrapper">
                    <?php foreach($items as $key => $item) : 
                        $img_dimension_tmp = ( !empty($item['_custom_img_dimension']['width']) && !empty($item['_custom_img_dimension']['height']) ) ? 
                                                $item['_custom_img_dimension'] : $img_dimension;
                        $image_html = komestic_get_image_by_size([
                            'img_id' => $item['image']['id'],
                            'img_dimension' => $img_dimension_tmp,
                        ]);
                        $image_link_attrs = komestic_get_link_attributes($item['link_url']);
                        $tag = !is_null($image_link_attrs) ? 'a' : 'span';
                    ?>
                    <div class="swiper-slide <?php echo esc_attr($entrance_anim); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                        <<?php echo esc_attr($tag); pxl_print_html(' '.$image_link_attrs);?> class="image <?php echo esc_attr($img_hover_style); ?>">
                            <?php 
                                pxl_print_html($image_html); 
                                if($img_hover_show_btn) { ?>
                                    <span class="pxl-button button--only-icon">
                                        <?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                                    </span>
                                <?php }
                            ?>
                        </<?php echo esc_attr($tag); ?>>
                    </div>
                    <?php endforeach; ?>
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