<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_swiper_navigation',
        'title' => esc_html__('Case Swiper Navigation', 'komestic' ),
        'icon' => 'eicon-post-navigation',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Navigation', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'nav_id',
                            'label' => esc_html__('ID', 'komestic'),
                            'type' => 'text',
                            'placeholder' => esc_html__('nav-260301', 'komestic'),
                            'description' => esc_html__('This ID must be unique and can include letters, numbers, hyphens, or underscores. You will need to copy and paste this ID into the navigation option, replacing the "Additional Options" in the carousel widget.', 'komestic'),
                        ),
                        array(
                            'name' => 'nav_btn_icon_prev',
                            'label' => esc_html__('Button Icon Prev', 'komestic' ),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'flaticon flaticon-chevron-left',
                                'library' => 'Flaticon',
                            ],
                        ),
                        array(
                            'name' => 'nav_btn_icon_next',
                            'label' => esc_html__('Button Icon Next', 'komestic' ),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'flaticon flaticon-chevron-right',
                                'library' => 'Flaticon',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'max_width',
                                'label' => esc_html__('Max Width', 'komestic'),
                                'type' => 'slider',
                                'size_units' => ['px', 'custom', 'custom'],
                                'control_type' => 'responsive',
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}} !important;',
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
                                    '{{WRAPPER}} .pxl-swiper-navigation' => 'gap: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'button_position',
                                'label' => esc_html__('Layout Position', 'komestic'),
                                'type' => 'select',
                                'options' => [
                                    '' => esc_html__('Default', 'komestic'),
                                    'relative' => esc_html__('Relative', 'komestic'),
                                    'absolute' => esc_html__('Absolute', 'komestic'),
                                    'static'   => esc_html__('Static', 'komestic')
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper-navigation' => 'position: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'swiper_nav_css_hidden',
                                'type' => 'hidden',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper-navigation' => 'top: 0; left: 0; transform: translate(0, 0); width: auto;'
                                ],
                                'condition' => [
                                    'button_position' => 'relative',
                                ],
                            ),
                            array(
                                'name' => 'direction',
                                'label' => esc_html__('Direction', 'komestic'),
                                'type' => 'choose',
                                'control_type' => 'responsive',
                                'options' => array(
                                    'row' => [
                                        'title' => esc_html__('Row', 'komestic' ),
                                        'icon' => 'eicon-arrow-right',
                                    ],
                                    'column' => [
                                        'title' => esc_html__('Column', 'komestic' ),
                                        'icon' => 'eicon-arrow-down',
                                    ],
                                ),
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper-navigation' => 'flex-direction: {{VALUE}};'
                                ],
                                'condition' => [
                                    'button_position!' => 'absolute',
                                ]
                            ),
                            array(
                                'name' => 'justify_content_row',
                                'label' => esc_html__('Justify Content', 'komestic'),
                                'type' => 'choose',
                                'control_type' => 'responsive',
                                'options' => array(
                                    'start' => [
                                        'title' => esc_html__('Start', 'komestic' ),
                                        'icon' => 'eicon-justify-start-h',
                                    ],
                                    'center' => [
                                        'title' => esc_html__('Center', 'komestic' ),
                                        'icon' => 'eicon-justify-center-h',
                                    ],
                                    'end' => [
                                        'title' => esc_html__('End', 'komestic' ),
                                        'icon' => 'eicon-justify-end-h',
                                    ],
                                    'space-around' => [
                                        'title' => esc_html__('Space Around', 'komestic'),
                                        'icon' => 'eicon-justify-space-around-h',
                                    ],
                                    'space-evenly' => [
                                        'title' => esc_html__('Space Evenly', 'komestic'),
                                        'icon' => 'eicon-justify-space-evenly-h',
                                    ],
                                    'space-between' =>  [
                                        'title' => esc_html__('Space Between', 'komestic'),
                                        'icon' => 'eicon-justify-space-between-h',
                                    ],
                                ),
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper-navigation' => 'justify-content: {{VALUE}};'
                                ],
                                'condition' => [
                                    'direction!' => 'column',
                                    'button_position!' => 'absolute',
                                ]
                            ),
                            array(
                                'name' => 'justify_content_column',
                                'label' => esc_html__('Justify Content', 'komestic'),
                                'type' => 'choose',
                                'control_type' => 'responsive',
                                'options' => array(
                                    'start' => [
                                        'title' => esc_html__('Start', 'komestic' ),
                                        'icon' => 'eicon-justify-start-v',
                                    ],
                                    'center' => [
                                        'title' => esc_html__('Center', 'komestic' ),
                                        'icon' => 'eicon-justify-center-v',
                                    ],
                                    'end' => [
                                        'title' => esc_html__('End', 'komestic' ),
                                        'icon' => 'eicon-justify-end-v',
                                    ],
                                    'space-around' => [
                                        'title' => esc_html__('Space Around', 'komestic'),
                                        'icon' => 'eicon-justify-space-around-v',
                                    ],
                                    'space-evenly' => [
                                        'title' => esc_html__('Space Evenly', 'komestic'),
                                        'icon' => 'eicon-justify-space-evenly-v',
                                    ],
                                    'space-between' => [
                                        'title' => esc_html__('Space Between', 'komestic'),
                                        'icon' => 'eicon-justify-space-between-v',
                                    ],
                                ),
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper-navigation' => 'justify-content: {{VALUE}};'
                                ],
                                'condition' => [
                                    'direction' => 'column',
                                    'button_position!' => 'absolute',
                                ]
                            ),
                            array(
                                'name' => 'button_position_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'button_prev_position',
                                        'label' => esc_html__('Prev', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => komestic_position_options([
                                            'prefix' => 'button_prev',
                                            'selector' => '{{WRAPPER}} .pxl-swiper-navigation .swiper-button-prev',
                                            'condition' => [
                                                'button_position' => 'absolute'
                                            ]
                                        ]),
                                    ],
                                    [
                                        'name' => 'button_next_position',
                                        'label' => esc_html__('Next', 'komestic' ),
                                        'type' => 'tabs',
                                        'controls' => komestic_position_options([
                                            'prefix' => 'button_next',
                                            'selector' => '{{WRAPPER}} .pxl-swiper-navigation .swiper-button-next',
                                            'condition' => [
                                                'button_position' => 'absolute'
                                            ]
                                        ]),
                                    ],
                                ],
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_navigation_carousel_style',
                    'label' => esc_html__('Navigation Carousel', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'justify_content',
                                'label' => esc_html__('Justify Content', 'komestic'),
                                'type' => 'choose',
                                'control_type' => 'responsive',
                                'options' => array(
                                    'start' => [
                                        'title' => esc_html__('Start', 'komestic' ),
                                        'icon' => 'eicon-justify-start-h',
                                    ],
                                    'center' => [
                                        'title' => esc_html__('Center', 'komestic' ),
                                        'icon' => 'eicon-justify-center-h',
                                    ],
                                    'end' => [
                                        'title' => esc_html__('End', 'komestic' ),
                                        'icon' => 'eicon-justify-end-h',
                                    ],
                                ),
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper-navigation' => 'justify-content: {{VALUE}};'
                                ],
                            ),
                            array(
                                'name' => 'btn_box_sz',
                                'label' => esc_html__('Box Size', 'komestic' ),
                                'type' => 'slider',
                                'size_units' => ['px', '%', 'custom'],
                                'control_type' => 'responsive',
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_icon_sz',
                                'label' => esc_html__('Icon Size', 'komestic' ),
                                'type' => 'slider',
                                'size_units' => ['px', '%', 'custom'],
                                'control_type' => 'responsive',
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                                ],
                            ),
                            array(
                                'name' => 'btn_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button',
                            ),
                            array(
                                'name' => 'btn_text_shadow',
                                'label' => esc_html__('Text Shadow', 'komestic' ),
                                'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button',
                            ),
                            array(
                                'name' => 'btn_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'btn_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'btn_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_bg',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button',
                                            ),
                                            array(
                                                'name' => 'btn_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button',
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow',
                                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button',
                                            ),
                                            array(
                                                'name' => 'btn_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'btn_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tabs',
                                        'controls' => [
                                            array(
                                                'name' => 'btn_hover_style',
                                                'label' => esc_html__('Hover Style', 'komestic' ),
                                                'type' => 'select',
                                                'options' => [
                                                    'hover-default' => esc_html__('Default', 'komestic'),
                                                    'hover-scaley-fill' => esc_html__('Grow Height', 'komestic'),
                                                ],
                                                'default' => 'hover-default',
                                            ),
                                            array(
                                                'name' => 'btn_hove_color',
                                                'label' => esc_html__('Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_bg',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button:hover',
                                            ),
                                            array(
                                                'name' => '_btn_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button:hover' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button:hover',
                                            ),
                                            array(
                                                'name'         => 'btn_hover_box_shadow',
                                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button:hover',
                                            ),
                                            array(
                                                'name' => 'btn_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-swiper-navigation .pxl-swiper-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'selectors' => '{{WRAPPER}} .pxl-swiper-navigation',
                    ]),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);