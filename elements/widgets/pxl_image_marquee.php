<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image_marquee',
        'title' => esc_html__('Case Image Marquee', 'komestic' ),
        'icon' => 'eicon-photo-library',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_image_content',
                    'label' => esc_html__('Images', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        komestic_image_dimension_options(),
                        array(
                            array(
                                'name' => 'images',
                                'label' => esc_html__('Images', 'komestic' ),
                                'type' => 'repeater',
                                'controls' => array(
                                    array(
                                        'name' => 'image',
                                        'label' => esc_html__('Image', 'komestic' ),
                                        'type' => 'media',
                                    ),
                                    array(
                                        'name' => 'link_url',
                                        'label' => esc_html__('Link URL', 'komestic' ),
                                        'type' => 'url',
                                    ),
                                    array(
                                        'name' => 'current_img_dimension',
                                        'label' => esc_html__( 'Dimension Custom', 'komestic' ),
                                        'type' => 'image_dimensions',
                                        'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'komestic' ),
                                    ),
                                ),
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'tab_add_options',
                    'label' => esc_html__('Addtional Options', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'direction',
                            'label' => esc_html__('Direction', 'komestic'),
                            'type' => 'select',
                            'options' => [
                                'rtl' => esc_html__('RTL', 'komestic'),
                                'ltr' => esc_html__('LTR', 'komestic'),
                            ],
                            'default' => 'rtl',
                        ),
                        array(
                            'name' => 'duration',
                            'label' => esc_html__('Duration', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['ms', 's', 'custom'],
                            'default' => [
                                'unit' => 's',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-marquee .image-marquee__item' => '--pxl-duration: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Gap', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-marquee' => '--pxl-spacing: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'komestic'),
                            'type' => 'select',
                            'options' => [
                                ''       => esc_html__('Off', 'komestic'),
                                'paused' => esc_html__('On', 'komestic'),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-marquee:hover .image-marquee__item' => 'animation-play-state: {{VALUE}};-webkit-animation-play-state: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_image_style',
                    'label' => esc_html__('Image', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'image',
                            'selectors' => '{{WRAPPER}} .pxl-image-marquee .image-marquee__item img',
                        ]),
                        array(
                            array(
                                'name' => 'img_opacity',
                                'label' => esc_html__('Opacity', 'komestic' ),
                                'type' => 'slider',
                                'control_type' => 'responsive',
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1,
                                        'step' => 0.01,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-image-marquee .image-marquee__item img' => 'opacity: {{SIZE}};',
                                ],
                            ),
                            array(
                                'name'     => 'img_css_filters',
                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-image-marquee .image-marquee__item img',
                            ),
                            array(
                                'name' => 'img_border',
                                'type' => \Elementor\Group_Control_Border::get_type(),
                                'control_type' => 'group', 
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .pxl-image-marquee .image-marquee__item img',
                            ),
                            array(
                                'name'         => 'img_box_shadow',
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-image-marquee .image-marquee__item img',
                            ),
                            array(
                                'name' => 'img_border_radius',
                                'label' => esc_html__('Border Radius', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', '%', 'custom' ],
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-image-marquee .image-marquee__item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-image-marquee .pxl-image-marquee-image',
                    ]),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);