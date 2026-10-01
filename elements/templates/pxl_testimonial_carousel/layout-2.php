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
        $pagination = $widget->get_setting('swiper_pagination', '');
        $navigation = (bool)$widget->get_setting('swiper_navigation', false);
        $slides_per_view     = $widget->get_setting('slides_per_view', 'auto');
        $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 1);
        $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 1);
        $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 2);
        $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 2);
        $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 3);
        $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 3);
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
            'space_between'          => 30,
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
        
        $show_rating = (bool)$widget->get_setting('show_rating', '');
        $show_user = (bool)$widget->get_setting('show_user', '');
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
    <div class="pxl-swiper pxl-testimonial-carousel <?php echo esc_attr($swiper_boxshadow); ?>" data-layout="2">
        <div class="swiper-inner">
            <div class="swiper-container" data-swiper = "<?php echo esc_attr($swiper_params); ?>">
                <div class="swiper-wrapper">
                    <?php foreach($items as $key => $item) :  
                        $product = $products[$key];

                    ?>
                        <div class="swiper-slide <?php echo esc_attr($entrance_anim); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                            <div class="testimonial">
                                <?php if($show_rating || $show_user) : ?>
                                    <div class="testimonial__header">
                                        <?php if($show_rating) : ?>
                                            <div class="testimonial__rating">
                                                <?php for($i=0; $i<$item['rating']; $i++): ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14">
                                                        <path d="M7.49998 0L9.55801 4.95914L15 5.34753L10.83 8.80085L12.1352 14L7.49998 11.1752L2.86474 14L4.16999 8.80085L0 5.34753L5.44193 4.95914L7.49998 0Z" fill="#E69600"/>
                                                    </svg>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($show_user) : ?>
                                        <div class="testimonial__user user">
                                            <div class="testimonial__user-name user__name">
                                                <?php echo esc_html($item['name']); ?>
                                            </div>
                                            <div class="testimonial__<?php echo esc_attr($item['is_verified']); ?>">
                                                <span class="tick">
                                                    <svg width="10" height="8" viewBox="0 0 10 8" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.30219 5.96231L8.23526 1.02924C8.30551 0.959232 8.40065 0.919922 8.49983 0.919922C8.59901 0.919922 8.69414 0.959232 8.76439 1.02924L9.24392 1.50877C9.31393 1.57902 9.35324 1.67416 9.35324 1.77334C9.35324 1.87251 9.31393 1.96765 9.24392 2.0379L4.30534 6.97097C4.23533 7.03932 4.14137 7.07757 4.04353 7.07757C3.94569 7.07757 3.85173 7.03932 3.78172 6.97097L3.30219 6.49145C3.23218 6.42119 3.19287 6.32606 3.19287 6.22688C3.19287 6.1277 3.23218 6.03256 3.30219 5.96231Z" fill="white"/>
                                                        <path d="M1.76447 2.95293L4.7684 5.96238C4.83841 6.03263 4.87772 6.12776 4.87772 6.22694C4.87772 6.32612 4.83841 6.42126 4.7684 6.49151L4.29439 6.96553C4.22413 7.03554 4.129 7.07485 4.02982 7.07485C3.93064 7.07485 3.8355 7.03554 3.76525 6.96553L0.755804 3.96159C0.685795 3.89134 0.646484 3.7962 0.646484 3.69702C0.646484 3.59784 0.685795 3.50271 0.755804 3.43246L1.23533 2.95844C1.30558 2.88843 1.40072 2.84912 1.4999 2.84912C1.59908 2.84912 1.69421 2.88292 1.76447 2.95293Z" fill="white"/>
                                                    </svg>
                                                </span>
                                                <?php echo esc_html($item['is_verified']); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="divider"></div>
                                <?php endif; ?>
                                <div class="testimonial__body">
                                    <h6 class="testimonial__title">
                                        <?php echo esc_html($item['title']); ?>
                                    </h6>
                                    <p class="testimonial__content">
                                        <?php echo esc_html($item['content']); ?>
                                    </p>
                                </div>
                                <?php if($product) : ?>
                                    <div class="testimonial__footer">
                                        <div class="product">
                                            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="product__featured">
                                                <?php
                                                    $product_image_html = komestic_get_image_by_size([
                                                        'img_id' => $product->get_image_id(),
                                                        'img_dimension' => ['width' => '150', 'height' => '150'],
                                                        'attr' => [
                                                            'class' => 'product__thumbnail',
                                                        ],
                                                    ]); 
                                                    pxl_print_html($product_image_html); 
                                                ?>
                                            </a>
                                            <div class="product__content">
                                                <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="product__name">
                                                    <?php echo esc_html($product->get_name()); ?>
                                                </a>
                                                <div class="product__price">
                                                    <?php pxl_print_html($product->get_price_html()); ?>
                                                </div>
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




