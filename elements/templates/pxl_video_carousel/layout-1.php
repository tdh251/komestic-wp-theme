<?php 
    $items = $widget->get_setting('items', []);
    if(!empty($items)) : 
        $effect = $widget->get_setting('effect', 'slide');
        $autoplay = $widget->get_setting('autoplay', false);
        $disable_on_interaction = $widget->get_setting('disable_on_interaction', false);
        $allow_touch_move = $widget->get_setting('allow_touch_move', '');
        $delay = $widget->get_setting('delay', 5000);
        $loop  = $widget->get_setting('loop', false);
        $speed = $widget->get_setting('speed', 500);
        $space_between = $widget->get_setting('space_between', 24);
        $pagination = $widget->get_setting('swiper_pagination', '');
        $navigation = (bool)$widget->get_setting('swiper_navigation', false);
        $slides_per_view     = $widget->get_setting('slides_per_view', 'auto');
        $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 1);
        $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 2);
        $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 2);
        $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 3);
        $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 3);
        $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 4);
        $swiper_params = [
            'effect'                 => $effect,
            'autoplay'               => (bool)$autoplay,
            'disable_on_interaction' => (bool)$disable_on_interaction,
            'allow_touch_move'       => (bool)$allow_touch_move,
            'delay'                  => $delay,
            'loop'                   => (bool)$loop,
            'speed'                  => $speed,
            'pagination'             => $pagination,
            'navigation'             => $navigation,
            'space_between'          => $space_between,
            'slides_per_view'        => $slides_per_view,
            'slides_per_view_xs'     => (int)$slides_per_view_xs,
            'slides_per_view_sm'     => (int)$slides_per_view_sm,
            'slides_per_view_md'     => (int)$slides_per_view_md,
            'slides_per_view_lg'     => (int)$slides_per_view_lg,
            'slides_per_view_xl'     => (int)$slides_per_view_xl,
            'slides_per_view_xxl'    => (int)$slides_per_view_xxl,
        ];
        $swiper_params = json_encode($swiper_params); 
        $swiper_boxshadow = $widget->get_setting('slide_boxshadow', '');
        $nav_widget_id = $widget->get_setting('nav_widget_id', '');
        $navigation_hidden_class = !empty($nav_widget_id) ? 'swiper-navigation-hidden' : null;
        $nav_btn_icon_prev = $widget->get_settings('nav_btn_icon_prev', []);
        $nav_btn_icon_next = $widget->get_settings('nav_btn_icon_next', []);

        $entrance_anim = $widget->get_setting('entrance_anim', '');
        $anim_delay = $widget->get_setting('anim_delay', 0);

        $product_ids = array_column($items, 'product_id');
        $products = [];
        if(!empty($product_ids)) {
            foreach($product_ids as $id) {
                $product_obj = wc_get_product((int)$id);
                $products[] = $product_obj;
            }
        }
    ?>
    <div class="pxl-video-carousel pxl-swiper <?php echo esc_attr($swiper_boxshadow); ?>" data-layout="1">
        <div class="swiper-inner">
            <div class="swiper-container" data-swiper = "<?php echo esc_attr($swiper_params); ?>">
                <div class="swiper-wrapper">
                    <?php foreach($items as $key => $item) : 
                        $product = $products[$key];
                    ?>
                        <div class="swiper-slide <?php echo esc_attr($entrance_anim); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                            <div class="video">
                                <video class="video__play" src="<?php echo esc_attr($item['src']['url']); ?>" muted loop preload="metadata"></video>
                                <div class="video__content">
                                    <?php if($product) : ?>
                                        <div class="product">
                                            <?php 
                                                $product_image_html = komestic_get_image_by_size([
                                                    'img_id' => $product->get_image_id(),
                                                    'img_dimension' => 'thumbnail',
                                                    'attr' => [
                                                        'class' => 'product__thumbnail',
                                                    ],
                                                ]);
                                                pxl_print_html($product_image_html);
                                            ?>
                                            <div class="product__content">
                                                <a class="product__name" href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
                                                    <?php echo esc_html($product->get_name()); ?>
                                                </a>
                                                <div class="product__price">
                                                    <?php pxl_print_html($product->get_price_html()); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
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
<?php endif; ?>




