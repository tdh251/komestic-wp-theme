<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_show_case',
        'title' => esc_html__('Case Show Case', 'komestic'),
        'icon' => 'eicon-device-responsive',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Show Case', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'komestic'),
                                'type' => 'media',
                            ),
                        ),
                        komestic_image_dimension_options(),
                        array(
                            array(
                                'name' => 'show_label',
                                'type' => 'switcher',
                                'label' => esc_html__('Show Label', 'komestic'),
                                'default' => 'true',
                            ),
                            array(
                                'name' => 'label_text',
                                'type' => 'text',
                                'label' => esc_html__('Label Text', 'komestic'),
                                'default' => 'New',
                                'condition' => [
                                    'show_label!' => ''
                                ]
                            ),
                            array(
                                'name' => 'title',
                                'type' => 'textarea',
                                'label' => esc_html__('Title', 'komestic'),
                                'rows' => 5,
                                'separator' => 'before',
                                'default' => 'Case Title',
                            ),
                            array(
                                'name' => 'title_tag',
                                'label' => esc_html__('Title HTML Tag', 'komestic' ),
                                'type' => 'select',
                                'options' => [
                                    'h1' => 'H1',
                                    'h2' => 'H2',
                                    'h3' => 'H3',
                                    'h4' => 'H4',
                                    'h5' => 'H5',
                                    'h6' => 'H6',
                                    'div' => 'div',
                                    'p' => 'p',
                                    'span' => 'span',
                                ],
                                'default' => 'div',
                                'condition' => [
                                    'title!' => '',
                                ],
                            ),
                            array(
                                'name' => 'btns',
                                'label' => esc_html__('Buttons', 'komestic'),
                                'type' => 'repeater',
                                'separator' => 'before',
                                'title_field' => '{{{btn_text}}}',
                                'controls' => [
                                    array(
                                        'name' => 'btn_text',
                                        'type' => 'text',
                                        'label' => esc_html__('Button Text', 'komestic'),
                                        'default' => esc_html__('Click here', 'komestic')
                                    ),
                                    array(
                                        'name' => 'btn_link',
                                        'type' => 'url',
                                        'label' => esc_html__('Link URL', 'komestic'),
                                        'default' => [
                                            'url' => '#',
                                        ],
                                    ),
                                ],
                            ),
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_feature_style',
                    'label' => esc_html__('Feature Image', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'block',
                            'selectors' => '{{WRAPPER}} .show-case .show-case__image img',
                            'label' => 'Block Sizes',
                        ]),
                        array(
                            array(
                                'name' => 'feature_img_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'feature_img_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'feature_img_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .show-case .show-case__image',
                                            ),
                                            array(
                                                'name'         => 'feature_img_box_shadow',
                                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .show-case .show-case__image',
                                            ),
                                            array(
                                                'name' => 'feature_img_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .show-case .show-case__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'feature_img_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [ 
                                            array(
                                                'name' => 'feature_img_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .sho-case .show-case__image:hover',
                                            ),
                                            array(
                                                'name'         => 'feature_img_hover_box_shadow',
                                                'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .sho-case .show-case__image:hover',
                                            ),
                                            array(
                                                'name' => 'feature_img_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .sho-case .show-case__image:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'name' => 'tab_title_style',
                    'label' => esc_html__('Title', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array( 
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .show-case .show-case__title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .show-case .show-case__title',
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_label_style',
                    'label' => esc_html__('Label', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'show_label!' => ''
                    ],
                    'controls' => array(
                        array(
                            'name' => 'label_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .show-case .show-case__label',
                        ),
                        array(
                            'name' => 'label_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .show-case .show-case__label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'label_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .show-case .show-case__label',
                        ),
                        array(
                            'name' => 'label_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'separator' => 'before',
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .show-case .show-case__label',
                        ),
                        array(
                            'name'         => 'label_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .show-case .show-case__label',
                        ),
                        array(
                            'name' => 'label_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .show-case .show-case__label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'label_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .show-case .show-case__label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_btn_style',
                    'label' => esc_html__('Button', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'btn',
                            'selectors' => '{{WRAPPER}} .show-case .pxl-button',
                            'label' => 'Button Size',
                        ]),
                        array(
                            array(
                                'name' => 'btn_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .show-case .pxl-button',
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
                                                'label' => esc_html__('Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .show-case .pxl-button' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .show-case .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .show-case .pxl-button',
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .show-case .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .show-case .pxl-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .show-case .pxl-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'btn_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'btn_hover_color',
                                                'label' => esc_html__('Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .show-case .pxl-button:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic' ],
                                                'selector' => '{{WRAPPER}} .show-case .pxl-button:hover:not(.button--primary)',
                                                'fields_options' => [
                                                    'color' => [
                                                        'selectors' => [
                                                            '{{WRAPPER}} .show-case .pxl-button:hover:not(.button--primary)' => 'background-color: {{VALUE}}',
                                                            '{{WRAPPER}} .show-case .pxl-button' => '--pxl-background-color: {{VALUE}}'
                                                        ],
                                                    ]
                                                ],
                                            ),
                                            array(
                                                'name' => '_btn_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .show-case .pxl-button' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .show-case .pxl-button:hover',
                                            ),
                                            array(
                                                'name'         => 'btn_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .show-case .pxl-button:hover',
                                            ),
                                            array(
                                                'name' => 'btn_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .show-case .pxl-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .show-case .pxl-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'name' => 'pxl_moution_effects',
                    'label' => esc_html__('Motion Effects', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_get_animation_options([
                            'prefix' => 'title',
                            'selectors' => '{{WRAPPER}} .icon-box',
                            'type' => 'text',
                        ]),
                    ),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);