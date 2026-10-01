<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_social_icons',
        'title' => esc_html__('Case Social Icons', 'komestic' ),
        'icon' => 'eicon-social-icons',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Social Icons', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(   
                        array(
                            'name' => 'items',
                            'label' => esc_html__('Items', 'komestic' ),
                            'type' => 'repeater',
                            'controls' => array(
                                array(
                                    'name' => 'social_icon',
                                    'label' => esc_html__('Icon', 'komestic' ),
                                    'type' => 'icons',
                                    'fa4compatibility' => 'icon',
                                ),
                                array(
                                    'name' => 'social_link',
                                    'label' => esc_html__('Link URL', 'komestic' ),
                                    'type' => 'url',
                                    'default' => [
                                        [
                                            'url' => '#'
                                        ],
                                    ]
                                ),
                                array(
                                    'name' => 'item_icon_size',
                                    'label' => esc_html__('Icon Size', 'komestic' ),
                                    'type' => 'slider',
                                    'control_type' => 'responsive',
                                    'separator' => 'before',
                                    'size_units' => ['px', 'custom'],
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-social-icons .social-item{{CURRENT_ITEM}} svg' => 'width: {{SIZE}}{{UNIT}}; height:auto;',
                                    ],
                                ),
                            ),
                            'default' => [
                                [
                                    'social_icon' => [
                                        'value' => [
                                            'url' => content_url('/uploads/2025/07/facebook.svg'), 
                                            'id' => 254, 
                                        ],
                                        'library' => 'svg',
                                    ],
                                    'social_link' => [
                                        'url' => '#'
                                    ],
                                ],
                                [
                                    'social_icon' => [
                                        'value' => [
                                            'url' => content_url('/uploads/2025/07/instagram.svg'), 
                                            'id' => 255, 
                                        ],
                                        'library' => 'svg',
                                    ],
                                    'social_link' => [
                                        'url' => '#'
                                    ],
                                ],
                                [
                                    'social_icon' => [
                                        'value' => [
                                            'url' => content_url('/uploads/2025/07/x.svg'), 
                                            'id' => 258, 
                                        ],
                                        'library' => 'svg',
                                    ],
                                    'social_link' => [
                                        'url' => '#'
                                    ],
                                ],
                                [
                                    'social_icon' => [
                                        'value' => [
                                            'url' => content_url('/uploads/2025/07/tiktok.svg'), 
                                            'id' => 257, 
                                        ],
                                        'library' => 'svg',
                                    ],
                                    'social_link' => [
                                        'url' => '#'
                                    ],
                                ],
                                [
                                    'social_icon' => [
                                        'value' => [
                                            'url' => content_url('/uploads/2025/07/pinterest.svg'), 
                                            'id' => 256, 
                                        ],
                                        'library' => 'svg',
                                    ],
                                    'social_link' => [
                                        'url' => '#'
                                    ],
                                ],
                            ],
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Gap', 'komestic' ),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'separator' => 'before',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-social-icons' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'flex_direction',
                            'label' => esc_html__('Direction', 'komestic' ),
                            'type' => 'choose',
                            'options' => [
                                'row' => [
                                    'title' => esc_html__('Row', 'komestic'),
                                    'icon'  => 'eicon-arrow-right'
                                ],
                                'column' => [
                                    'title' => esc_html__('Column', 'komestic'),
                                    'icon'  => 'eicon-arrow-down'
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-social-icons' => 'flex-direction: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'flex_wrap',
                            'label' => esc_html__('Wrap', 'komestic' ),
                            'type' => 'choose',
                            'options' => [
                                'nowrap' => [
                                    'title' => esc_html__('Nowrap', 'komestic'),
                                    'icon'  => 'eicon-nowrap'
                                ],
                                'wrap' => [
                                    'title' => esc_html__('Wrap', 'komestic'),
                                    'icon'  => 'eicon-wrap'
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-social-icons' => 'flex-wrap: {{VALUE}};',
                            ],
                            'condition' => [
                                'flex_direction!' => 'column'
                            ]
                        ),
                        array(
                            'name' => 'justify_content_h',
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
                                '{{WRAPPER}} .pxl-social-icons' => 'justify-content: {{VALUE}};'
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_icon_style',
                    'label' => esc_html__('Social Icon', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'icon_box_size',
                            'label' => esc_html__('Box Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-social-icons .social-item' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-social-icons .social-item svg' => 'height: {{SIZE}}{{UNIT}}; width:auto;',
                            ],
                        ),
                        array(
                            'name' => 'icon_divider',
                            'type' => 'divider',
                        ),
                        array(
                            'name' => 'icon_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'icon_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'icon_color',
                                            'label' => esc_html__('Icon Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-social-icons .social-item' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'exclude' => ['image'],
                                            'selector' => '{{WRAPPER}} .pxl-social-icons .social-item',
                                        ),
                                        array(
                                            'name' => 'icon_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-social-icons .social-item',
                                        ),
                                        array(
                                            'name'         => 'icon_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-social-icons .social-item',
                                        ),
                                        array(
                                            'name' => 'icon_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-social-icons .social-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => ['px', 'custom'],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-social-icons .social-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'icon_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'icon_hover_color',
                                            'label' => esc_html__('Icon Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-social-icons .social-item:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_hover_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-social-icons .social-item:hover',
                                        ),    
                                        array(
                                            'name' => '_icon_hover_border_color',
                                            'label' => esc_html__('Border Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-social-icons .social-item:hover' => 'border-color: {{VALUE}};',
                                            ],
                                        ),                                 
                                        array(
                                            'name' => 'icon_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-social-icons .social-item:hover',
                                        ),
                                        array(
                                            'name'         => 'icon_hover_box_shadow',
                                            'label' => esc_html__('Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-social-icons .social-item:hover',
                                        ),
                                        array(
                                            'name' => 'icon_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-social-icons .social-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-social-icons .social-item:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'pxl_moution_effects',
                    'label' => esc_html__('Motion Effects', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_get_animation_options([
                            'selectors' => '{{WRAPPER}} .pxl-text-editor',
                        ]),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);