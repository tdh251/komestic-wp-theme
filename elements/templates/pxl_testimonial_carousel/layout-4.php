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
        $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 1);
        $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 1);
        $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 2);
        $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 2);
        $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 2);
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
        
        $show_rating = (bool)$widget->get_setting('show_rating', '');
        $show_icon = (bool)$widget->get_setting('show_icon', '');
        $show_user = (bool)$widget->get_setting('show_user', '');

        $entrance_anim = $widget->get_setting('entrance_anim', '');
        $anim_delay = $widget->get_setting('anim_delay', 0);


        $img_dimension = $widget->get_setting('img_dimension', 'custom');
        if($img_dimension === 'custom') {
            $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
            $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : ['width' => 767, 'height' => 778];
        }

        $product_ids = array_column($items, 'product_id');
        $products = [];
        if(!empty($product_ids)) {
            foreach($product_ids as $id) {
                $product_obj = wc_get_product((int)$id);
                $products[] = $product_obj;
            }
        }
    ?>
    <div class="pxl-swiper pxl-testimonial-carousel <?php echo esc_attr($swiper_boxshadow); ?>" data-layout="4">
        <div class="swiper-inner">
            <div class="swiper-container" data-swiper = "<?php echo esc_attr($swiper_params); ?>">
                <div class="swiper-wrapper">
                    <?php foreach($items as $key => $item) : 
                        $featured_image = komestic_get_image_by_size([
                            'img_id' => $item['featured']['id'],
                            'img_dimension' => $img_dimension,
                            'attr' => [
                                'class' => 'pxl-image no-lazyload',
                            ],
                        ]);
                        $user_image = komestic_get_image_by_size([
                            'img_id' => $item['image']['id'],
                            'img_dimension' => 'full',
                            'attr' => [
                                'class' => 'user__image no-lazyload',
                            ]
                        ]);    
                        $product = $products[$key];
                    ?>
                        <div class="swiper-slide <?php echo esc_attr($entrance_anim); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                            <div class="testimonial">
                                <div class="testimonial__image">
                                    <?php pxl_print_html($featured_image); ?>
                                </div>
                                <div class="testimonial__main">
                                    <?php if($show_rating) : ?>
                                        <div class="testimonial__rating">
                                            <?php for($i=1; $i<=5; $i++): 
                                                $star_active = ($i <= $item['rating']) ? 'active' : '';    
                                            ?>
                                                <svg class="<?php echo esc_attr($star_active); ?>" xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                                                    <path d="M7.49998 0L9.55801 4.95914L15 5.34753L10.83 8.80085L12.1352 14L7.49998 11.1752L2.86474 14L4.16999 8.80085L0 5.34753L5.44193 4.95914L7.49998 0Z" fill="#E69600"/>
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                    <?php endif; ?>
                                    <h5 class="testimonial__title">
                                        <?php echo esc_html($item['title']); ?>
                                    </h5>
                                    <p class="testimonial__content">
                                        <?php echo esc_html($item['content']); ?>
                                    </p>
                                    <div class="divider"></div>
                                    <?php if($show_user) : ?>
                                        <div class="testimonial__user user">
                                            <?php pxl_print_html($user_image); ?>
                                            <div class="user__content">
                                                <div class="user__name">
                                                    <span>
                                                        <?php echo esc_html($item['name']); ?>
                                                    </span>
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
                                                <?php if($product) : ?>
                                                    <div class="user__product-review">
                                                        <span class="product-review-label">
                                                            <?php echo esc_html__('Item purchased:', 'komestic'); ?>
                                                        </span>
                                                        <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
                                                            <span class="text-underline">
                                                                <?php echo wp_trim_words( $product->get_name(), 3, $more = null); ?>
                                                            </span>
                                                            <svg class="icon--main" xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11">
                                                                <path d="M2.72017 0.752869L2.72037 1.30902C2.7204 1.37607 2.74705 1.44038 2.79446 1.48779C2.84188 1.53521 2.90618 1.56186 2.97324 1.56189L8.18722 1.56178L0.073992 9.67501C0.0265952 9.72247 -1.9048e-05 9.7868 1.02285e-08 9.85386C1.90685e-05 9.92093 0.0266696 9.98524 0.0740934 10.0327L0.467422 10.426C0.56611 10.5247 0.726286 10.5247 0.825076 10.4259L8.93831 2.31266L8.9381 7.52695C8.93813 7.59401 8.96478 7.65831 9.0122 7.70573C9.05961 7.75315 9.12391 7.7798 9.19097 7.77982L9.74712 7.77982C9.81418 7.7798 9.87848 7.75315 9.92589 7.70573C9.97331 7.65831 9.99996 7.59401 9.99999 7.52695L10.0001 0.752869C10.0001 0.685813 9.97341 0.621511 9.92599 0.574095C9.87858 0.526679 9.81428 0.500028 9.74722 0.500001L2.97303 0.500002C2.90598 0.500029 2.84168 0.526679 2.79426 0.574096C2.74684 0.621511 2.72019 0.685814 2.72017 0.752869Z" fill="#1F1F1F"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
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




