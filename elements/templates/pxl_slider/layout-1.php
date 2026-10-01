<?php 
    $slides = $widget->get_setting('slides', []);
    if(!empty($slides)) : 
        $autoplay = $widget->get_setting('autoplay', false);
        $disable_on_interaction = $widget->get_setting('disable_on_interaction', false);
        $allow_touch_move = $widget->get_setting('allow_touch_move', '');
        $delay = $widget->get_setting('delay', 3000);
        $loop  = $widget->get_setting('loop', false);
        $speed = $widget->get_setting('speed', 300);
        $pagination = $widget->get_setting('swiper_pagination', '');
        $navigation = (bool)$widget->get_setting('swiper_navigation', false);
        $swiper_params = [
            'effect'                 => 'fade',
            'autoplay'               => (bool)$autoplay,
            'disable_on_interaction' => (bool)$disable_on_interaction,
            'allow_touch_move'       => (bool)$allow_touch_move,
            'delay'                  => $delay,
            'loop'                   => (bool)$loop,
            'speed'                  => $speed,
            'space_between'          => 0,
            'pagination'             => $pagination,
            'navigation'             => $navigation,
            'slides_per_view_xs'     => 1,
            'slides_per_view_sm'     => 1,
            'slides_per_view_md'     => 1,
            'slides_per_view_lg'     => 1,
            'slides_per_view_xl'     => 1,
            'slides_per_view_xxl'    => 1,
        ];
        $swiper_params = json_encode($swiper_params); 
        $nav_widget_id = $widget->get_setting('nav_widget_id', '');
        $navigation_hidden_class = !empty($nav_widget_id) ? 'swiper-navigation-hidden' : null;
        $nav_btn_icon_prev = $widget->get_settings('nav_btn_icon_prev', []);
        $nav_btn_icon_next = $widget->get_settings('nav_btn_icon_next', []);

        // Animated 
        $title_animated = $widget->get_setting('title_entrance_anim', '');
        $button_animated = $widget->get_setting('button_entrance_anim', '');
        $desc_animated  = $widget->get_setting('desc_entrance_anim', '');
    ?>
        <div class="pxl-slider" data-layout="1">
            <div class="swiper-inner">
                <div class="swiper-container" data-swiper="<?php 
                echo esc_attr($swiper_params); ?>">
                    <div class="swiper-wrapper">
                        <?php foreach($slides as $key => $slide) : 
                            $title = $widget->parse_text_editor( $slide['title'] ?? '' );
                            $title_tag = $slide['title_tag'] ?? 'div';
                            $btn_link_attr = komestic_get_link_attributes($slide['btn_link']);
                        ?>                    
                            <div class="swiper-slide <?php echo esc_attr('elementor-repeater-item-'.$slide['_id']); ?>">
                                <div class="slide">
                                    <div class="slide__background"></div>
                                    <div class="slide__container">
                                        <div class="slide__inner">
                                            <div class="slide__content">
                                                <<?php echo esc_attr($title_tag); ?> class="slide__title <?php echo esc_attr($title_animated); ?>">
                                                    <?php pxl_print_html($title); ?>
                                                </<?php echo esc_attr($title_tag); ?>>
                                                <p class="slide__description <?php echo esc_attr($desc_animated); ?>">
                                                    <?php echo esc_html($slide['description']); ?>
                                                </p>
                                                <div class="slide__button-wrap <?php echo esc_attr($button_animated); ?>">
                                                    <a <?php pxl_print_html($btn_link_attr) ?> class="pxl-button button--quaternary">
                                                        <?php get_template_part( 'template-parts/button/button', 'quaternary', ['btn_text' => $slide['btn_text']] ); ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php if(isset($settings['layers'][$key])) {
                                                $image_html = komestic_get_image_by_size([
                                                    'img_id' => $settings['layers'][$key]['layer']['id'],
                                                    'attr' => [
                                                        'class' => 'slide__image elementor-repeater-item-'.$settings['layers'][$key]['_id'].' '.$settings['layers'][$key]['layer_entrance_anim'],
                                                    ],
                                                ]);
                                                pxl_print_html($image_html);
                                            } ?>
                                        </div>
                                    </div>
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
<?php 
    endif;