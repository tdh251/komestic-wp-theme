<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image_carousel',
        'title' => esc_html__('Case Image Carousel', 'komestic' ),
        'icon' => 'eicon-carousel',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'komestic-swiper'
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Image Carousel', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'items',
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
                                        'default' => [
                                            'url' => '#',
                                        ],
                                    ),
                                    array(
                                        'name' => '_custom_img_dimension',
                                        'type' => 'image_dimensions',
                                        'separator' => 'before',
                                    ),
                                ),
                                'default' => [
                                    [
                                        'image' =>  [
                                            'url' => ''
                                        ],
                                    ],
                                    [
                                        'image' =>  [
                                            'url' => '',
                                        ],
                                    ],
                                ],
                            ),
                        ),
                        komestic_image_dimension_options(),
                    ),
                ),
                array(
                    'name' => 'tab_carousel_add_opts',
                    'label' => esc_html__('Additional Options', 'komestic' ),
                    'tab' => 'settings',
                    'controls' => array_merge(
                        array(
                            swiper_controls_options(),   
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
                            'selectors' => '{{WRAPPER}} .pxl-image-carousel .image',
                            'type' => 'basic'
                        ]),
                        array (
                            array(
                                'name' => 'image_controls',
                                'control_type' => 'tab',
                                'separator' => 'before',
                                'tabs' => [
                                    [
                                        'name' => 'image_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
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
                                                    '{{WRAPPER}} .pxl-image-carousel .image img' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'img_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-image-carousel .image img',
                                            ),
                                            array(
                                                'name' => 'img_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .pxl-image-carousel .image',
                                            ),
                                            array(
                                                'name'         => 'img_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-image-carousel .image',
                                            ),
                                            array(
                                                'name' => 'img_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-image-carousel .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'image_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'img_hover_opacity',
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
                                                    '{{WRAPPER}} .pxl-image-carousel .image:hover img' => 'opacity: {{SIZE}};',
                                                ],
                                            ),
                                            array(
                                                'name'     => 'img_hover_css_filters',
                                                'type'     => \Elementor\Group_Control_Css_Filter::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .pxl-image-carousel .image:hover img',
                                            ),
                                            array(
                                                'name' => 'img_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .pxl-image-carousel .image:hover',
                                            ),
                                            array(
                                                'name'         => 'img_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-image-carousel .image:hover',
                                            ),
                                            array(
                                                'name' => 'img_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-image-carousel .image:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                                                ],
                                            ),
                                            array(
                                                'name' => 'img_hover_style',
                                                'label' => esc_html__('Hover Style', 'komestic'),
                                                'type' => 'select',
                                                'defauult' => '',
                                                'options' => [
                                                    '' => esc_html__('None', 'komestic'),
                                                    'image--distortion-transition' => esc_html__('Distortion Transition', 'komestic'),
                                                    'image--overlay-blur'          => esc_html__('Overlay Blur', 'komestic'),
                                                ]
                                            ),
                                            array(
                                                'name' => 'img_hover_show_btn',
                                                'label' => esc_html__('Show Button', 'komestic'),
                                                'type' => 'switcher',
                                                'defauult' => '',
                                            ),
                                            array(
                                                'name' => 'btn_icon',
                                                'label' => esc_html__('Icon', 'komestic' ),
                                                'type' => 'icons',
                                                'fa4compatibility' => 'icon',
                                                'default' => [
                                                    'value' => [
                                                        'url' => content_url('/uploads/2025/07/instagram.svg'),
                                                        'id' => 255,
                                                    ],
                                                    'library' => 'svg',
                                                ],
                                                'condition' => [
                                                    'img_hover_show_btn!' => '',
                                                ],
                                            ),
                                        ],
                                    ],
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
                        'selectors' => '{{WRAPPER}} .pxl-swiper .swiper-slide',
                    ]),
                ),
                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path(),
);