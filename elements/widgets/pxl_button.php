<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_button',
        'title' => esc_html__('Case Button', 'komestic' ),
        'icon' => 'eicon-button',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_btn_content',
                    'label' => esc_html__('Button', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Style', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                ''                    => esc_html__('Custom', 'komestic' ),
                                'primary'  => esc_html__('Primary', 'komestic' ),
                                'secondary'=> esc_html__('Secondary', 'komestic' ),
                                'tertiary'    => esc_html__('Tertiary', 'komestic' ),
                                'quaternary'  => esc_html__('Quaternary', 'komestic'),
                                'quinary'     => esc_html__('Quinary', 'komestic'),
                                'link-underline' => esc_html__('Link Underline', 'komestic'),
                                'only-icon'   => esc_html__('Only Icon', 'komestic'),
                                'only-text'   => esc_html__('Only Text', 'komestic'),
                            ],
                            'default' => 'primary',
                        ),
                        array(
                            'name' => 'btn_action',
                            'label' => esc_html__('Action', 'komestic' ),
                            'type' => 'select',
                            'default' => '',
                            'options' => [
                                ''       => esc_html__('Link', 'komestic' ),
                                'submit' => esc_html__('Submit', 'komestic' ),
                                'anchor' => esc_html__('Anchor', 'komestic'),
                                'add_to_cart' =>  esc_html__('Add to Cart', 'komestic'),
                            ],
                        ),
                        array(
                            'name' => 'scroll_offset_top',
                            'label' => esc_html__('Offset Top', 'komestic' ),
                            'type' => 'number',
                            'default' => -100,
                            'condition' => [
                                'btn_action' => 'anchor',
                            ],
                        ),
                        array(
                            'name' => 'btn_text',
                            'label' => esc_html__('Text', 'komestic' ),
                            'type' => 'text',
                            'default' => esc_html__('Click Here', 'komestic'),
                            'separator' => 'before',
                            'condition' => [
                                'btn_style!' => ['only-icon'],
                            ],
                        ),
                        array(
                            'name' => 'btn_link',
                            'label' => esc_html__('Link URL', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => '#',
                            ],
                        ),
                        array(
                            'name' => 'btn_icon',
                            'label' => esc_html__('Icon', 'komestic' ),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'separator' => 'before',
                            'condition' => [
                                'btn_style' => ['only-icon', 'primary', ''],
                            ],
                        ),
                        array(
                            'name' => 'btn_icon_position',
                            'label' => esc_html__('Icon Position', 'komestic' ),
                            'type' => 'choose',
                            'options' => [
                                'row-reverse' => [
                                    'title' => esc_html__('Left', 'komestic'),
                                    'icon'  => 'eicon-arrow-left'
                                ],
                                'row' => [
                                    'title' => esc_html__('Right', 'komestic'),
                                    'icon'  => 'eicon-arrow-right'
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-button' => 'flex-direction: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 0, 
                                    'max' => 1000
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-button .button__icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                        ),
                        array(
                            'name' => 'icon_spacing',
                            'label' => esc_html__('Icon Spacing', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 0, 
                                    'max' => 1000
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-button' => 'gap: {{SIZE}}{{UNIT}};',
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
                            'selectors' => '{{WRAPPER}} .pxl-button',
                            'label' => 'Button Size',
                        ]),
                        komestic_size_options([
                            'prefix' => 'btn_icon',
                            'selectors' => '{{WRAPPER}} .pxl-button .button__icon',
                            'type' => 'basic',
                            'label' => 'Box Icon Size',
                        ]),
                        array(
                            array(
                                'name' => 'btn_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .pxl-button',
                                'condition' => [
                                    'btn_text!' => '',
                                ],
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
                                                    '{{WRAPPER}} .pxl-button' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_icon_color',
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button .button__icon' => 'color: {{VALUE}};',
                                                ],
                                                'condition' => [
                                                    'btn_text!' => '',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'fields_options' => [
                                                    'background' => [
                                                        'label' => __( 'Button Background', 'komestic' ),
                                                    ],
                                                ],
                                                'selector' => '{{WRAPPER}} .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_icon_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'fields_options' => [
                                                    'background' => [
                                                        'label' => __( 'Box Icon Background', 'komestic' ),
                                                    ],
                                                ],
                                                'selector' => '{{WRAPPER}} .pxl-button .button__icon',
                                            ),
                                            array(
                                                'name' => 'btn_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-button',
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-button:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_icon_color',
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button:hover .button__icon' => 'color: {{VALUE}};',
                                                ],
                                                'condition' => [
                                                    'btn_text!' => '',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic' ],
                                                'selector' => '{{WRAPPER}} .pxl-button:hover:not(.button--primary)',
                                                'fields_options' => [
                                                    'background' => [
                                                        'label' => __( 'Button Background', 'komestic' ),
                                                    ],
                                                    'color' => [
                                                        'selectors' => [
                                                            '{{WRAPPER}} .pxl-button:hover:not(.button--primary)' => 'background-color: {{VALUE}}',
                                                            '{{WRAPPER}} .pxl-button' => '--pxl-background-color: {{VALUE}}'
                                                        ],
                                                    ]
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_icon_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'fields_options' => [
                                                    'background' => [
                                                        'label' => esc_html__('Box Icon Background', 'komestic'),
                                                    ],
                                                ],
                                                'selector' => '{{WRAPPER}} .pxl-button:hover .button__icon',
                                            ),
                                            array(
                                                'name' => '_btn_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .pxl-button:hover',
                                            ),
                                            array(
                                                'name'         => 'btn_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-button:hover',
                                            ),
                                            array(
                                                'name' => 'btn_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'name' => 'tab_loader_style',
                    'label' => esc_html__('Loader', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'btn_action' => 'submit',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'loader_color',
                            'label' => esc_html__('Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-button .button-loader' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'loader_size',
                            'label' => esc_html__('Loader Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 0, 
                                    'max' => 1000
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-button .button-loader svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'pxl_motion_effetcs',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'tab' => 'style',
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-button'
                    ]),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);