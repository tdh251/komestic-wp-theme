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
        $space_between = $widget->get_setting('space_between', 30);
        $pagination = $widget->get_setting('swiper_pagination', '');
        $navigation = (bool)$widget->get_setting('swiper_navigation', false);
        $slides_per_view     = $widget->get_setting('slides_per_view', 'auto');
        $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 1);
        $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 1);
        $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 1);
        $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 1);
        $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 1);
        $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 1);
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
        
        $show_icon = (bool)$widget->get_setting('show_icon', '');
        $show_user = (bool)$widget->get_setting('show_user', '');
        $entrance_anim = $widget->get_setting('entrance_anim', '');

        $product_ids = array_column($items, 'product_id');
        $products = [];
        if(!empty($product_ids)) {
            foreach($product_ids as $id) {
                $product_obj = wc_get_product((int)$id);
                $products[] = $product_obj;
            }
        }

        $img_dimension = $widget->get_setting('img_dimension', 'full');
        if($img_dimension === 'custom') {
            $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
            $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
        }
    ?>
    <div class="pxl-swiper pxl-testimonial-carousel <?php echo esc_attr($swiper_boxshadow.' '.$entrance_anim); ?>" data-layout="3">
        <div class="images">
            <?php foreach($items as $key => $item) : 
                $img_class = '';
                if($key === 0) {
                    $img_class = 'active';
                }elseif($key === 1 ) {
                    $img_class = 'next';
                }
                $feature_image_html = komestic_get_image_by_size([
                    'img_id' => $item['featured']['id'],
                    'img_dimension' => $img_dimension,
                    'attr' => [
                        'class' => $img_class,
                    ]
                ]);
            ?>
                <?php pxl_print_html($feature_image_html); ?>
            <?php endforeach; ?>
        </div>
        <div class="swiper-inner">
            <div class="swiper-container" data-swiper = "<?php echo esc_attr($swiper_params); ?>">
                <div class="swiper-wrapper">
                    <?php foreach($items as $key => $item) : 
                        $user_image = komestic_get_image_by_size([
                            'img_id' => $item['image']['id'],
                            'img_dimension' => 'full',
                            'attr' => [
                                'class' => 'user__image no-lazyload',
                            ]
                        ]); 
                        $product = $products[$key];
                    ?>
                        <div class="swiper-slide">
                            <div class="testimonial">
                                <?php if($show_icon) : ?>
                                    <div class="testimonial__icon">
                                        <?php \Elementor\Icons_Manager::render_icon( $settings['_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="testimonial__body">
                                    <h4 class="testimonial__title">
                                        <?php echo esc_html($item['title']); ?>
                                    </h4>
                                    <p class="testimonial__content">
                                        <?php echo esc_html($item['content']); ?>
                                    </p>
                                </div>
                                <div class="divider"></div>
                                <?php if($show_user) : ?>
                                    <div class="testimonial__footer">
                                        <div class="testimonial__user user">
                                            <?php pxl_print_html($user_image); ?>
                                            <div class="user__content">
                                                <div class="user__name">
                                                    <?php echo esc_html($item['name']); ?>
                                                </div>
                                                <?php if($product) : ?>
                                                    <div class="user__product-review">
                                                        <span class="product-review-label">
                                                            <?php echo esc_html__('Purchased Product: ', 'komestic'); ?>
                                                        </span>
                                                        <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
                                                            <span class="text-underline">
                                                                <?php echo esc_html($product->get_name()); ?>
                                                            </span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12">
                                                                <path d="M9.16987 3.62403L1.2939 11.5L0 10.2061L7.87505 2.33013H0.934282V0.5H11V10.5657H9.16987V3.62403Z" fill="#FF6333"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
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