<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_divider',
        'title' => esc_html__('Case Divider', 'komestic' ),
        'icon' => 'eicon-divider',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_divider_content',
                    'label' => esc_html__('Divider', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'divider_css_hidden',
                            'type' => 'hidden',
                            'selectors' => [
                                '{{WRAPPER}}' => 'pointer-events: none;',
                            ]
                        ),
                        array(
                            'name' => 'divider_direction',
                            'label' => esc_html__('Direction', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                'horizontal' => esc_html__('Horizontal', 'komestic'),
                                'vertical'   => esc_html__('Vertical', 'komestic'),
                            ],
                            'default' => 'horizontal',
                        ),
                        array(
                            'name' => 'divider_style',
                            'label' => esc_html__('Divider Style', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                ''       => esc_html__('Default', 'komestic'),
                                'solid'  => esc_html__('Solid', 'komestic'),
                                'dashed' => esc_html__('Dashed', 'komestic'),
                                'dotted' => esc_html__('Dotted', 'komestic'),
                                'double' => esc_html__('Double', 'komestic'),
                                'custom' => esc_html__('Custom', 'komestic'),
                            ],
                            'default' => '',
                        ),
                        array(
                            'name' => 'divider_custom',
                            'label' => esc_html__('Upload', 'komestic'),
                            'type' => 'media',
                            'condition' => [
                                'divider_style' => 'custom',
                            ]
                        ),
                        array(
                            'name' => 'divider_element',
                            'label' => esc_html__('Add Element', 'komestic' ),
                            'type' => 'select',
                            'separator' => 'before',
                            'options' => [
                                ''                  => esc_html__('None', 'komestic'),
                                'title' => esc_html__('Text', 'komestic'),
                                'icon'  => esc_html__('Icon', 'komestic'),
                                'elements' => esc_html__('Many Elements', 'komestic'),
                            ],
                            'default' => '',
                            'condition' => [
                                'divider_direction' => 'horizontal'
                            ],
                        ),

                        array(
                            'name' => 'items',
                            'label' => esc_html__('Items', 'komestic' ),
                            'type' => 'repeater',
                            'condition' => [
                                'divider_element' => 'elements',
                                'divider_direction' => 'horizontal'
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'divider_element_icon',
                                    'label' => esc_html__('Icon', 'komestic'),
                                    'type' => 'icons',
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-star',
                                        'library' => 'Font Awesome 5 Free',
                                    ],
                                ),
                                array(
                                    'name' => 'divider_element_offset_left',
                                    'label' => esc_html__('Left', 'komestic' ),
                                    'type' => 'slider',
                                    'separator' => 'before',
                                    'size_units' => ['px', 'custom'],
                                    'control_type' => 'responsive',
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                            'max' => 1000,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-divider-wrapper {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};'
                                    ]
                                ),
                                array(
                                    'name' => 'divider_element_offset_right',
                                    'label' => esc_html__('Right', 'komestic' ),
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
                                        '{{WRAPPER}} .pxl-divider-wrapper {{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}};'
                                    ]
                                ),
                                array(
                                    'name' => 'divider_element_size',
                                    'label' => esc_html__('Font Size', 'komestic' ),
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
                                        '{{WRAPPER}} .pxl-divider-wrapper {{CURRENT_ITEM}}' => 'font-size: {{SIZE}}{{UNIT}};',
                                        '{{WRAPPER}} .pxl-divider-wrapper {{CURRENT_ITEM}} svg' => 'height: {{SIZE}}{{UNIT}}; width:auto;', 
                                    ]
                                ),
                                array(
                                    'name' => 'dvider_element_color',
                                    'label' => esc_html__('Color', 'komestic'),
                                    'type' => 'color',
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-divider-wrapper {{CURRENT_ITEM}}' => 'color: {{VALUE}};'
                                    ],
                                ),
                                array(
                                    'name' => 'divider_element_display',
                                    'label' => esc_html__('Display', 'komestic'),
                                    'control_type' => 'responsive',
                                    'type' => 'select',
                                    'options' => [
                                        ''       => esc_html__('Auto', 'komestic'),
                                        'none' => esc_html__('None', 'komestic'),
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-divider-wrapper {{CURRENT_ITEM}}' => 'display: {{VALUE}};',
                                    ],
                                ),
                            ),
                        ),
                        array(
                            'name' => 'divider_icon',
                            'label' => esc_html__('Icon', 'komestic'),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'fas fa-star',
                                'library' => 'Font Awesome 5 Free',
                            ],
                            'condition' => [
                                'divider_element' => 'icon',
                                'divider_direction' => 'horizontal'
                            ],
                        ),
                        array(
                            'name' => 'divider_title',
                            'type' => 'textarea',
                            'rows' => 3,
                            'label' => esc_html__('Title', 'komestic'),
                            'condition' => [
                                'divider_element' => 'title',
                                'divider_direction' => 'horizontal'
                            ],
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
                            'default' => 'span',
                            'condition' => [
                                'divider_element' => 'title',
                                'divider_direction' => 'horizontal'
                            ],
                        ),
                        array(
                            'name' => 'title_wrap',
                            'label' => esc_html__('Title Wrap', 'komestic' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'wrap' => [
                                    'title' => esc_html__('Wrap', 'komestic' ),
                                    'icon' => 'eicon-wrap',
                                ],
                                'nowrap' => [
                                    'title' => esc_html__('No Wrap', 'komestic' ),
                                    'icon' => 'eicon-nowrap',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title' => 'white-space: {{VALUE}};',
                            ],
                            'condition' => [
                                'divider_element' => 'title',
                                'divider_direction' => 'horizontal'
                            ],
                        ),
                        array(
                            'name' => 'title_max_width',
                            'label' => esc_html__('Title Max Width', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'divider_element' => 'title',
                                'divider_direction' => 'horizontal'
                            ]
                        ),
                        array(
                            'name' => 'justify_content_row',
                            'label' => esc_html__('Justify Content', 'komestic'),
                            'type' => 'choose',
                            'separator' => 'before',
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
                                '{{WRAPPER}} .pxl-divider-wrapper' => 'justify-content: {{VALUE}};'
                            ],
                            'condition' => [
                                'divider_direction' => 'horizontal'
                            ],
                        ),
                        array(
                            'name' => 'align_items_v',
                            'label' => esc_html__('Align Items', 'komestic'),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => array(
                                'start' => [
                                    'title' => esc_html__('Start', 'komestic' ),
                                    'icon' => 'eicon-align-start-v',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'komestic' ),
                                    'icon' => 'eicon-align-center-v',
                                ],
                                'end' => [
                                    'title' => esc_html__('End', 'komestic' ),
                                    'icon' => 'eicon-align-end-v',
                                ],
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider-wrapper' => 'align-items: {{VALUE}};'
                            ],
                            'condition' => [
                                'divider_direction' => 'vertical'
                            ],
                        ),
                        array(
                            'name' => 'element_spacing',
                            'label' => esc_html__('Element Spacing', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-divider-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'divider_element!' => '',
                                'divider_direction' => 'horizontal'
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_divider_style',
                    'label' => esc_html__('Divider', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'divider_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item',
                            'fields_options' => [
                                'color' => [
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item' => 'color: {{VALUE}}',
                                        '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item:not(.divider-dashed):not(.divider-dotted):not(.divider-double):not(.divider-custom)' => 'background-color: {{VALUE}}',
                                    ],
                                ],
                            ],
                        ),
                        array(
                            'name' => 'divider_weight',
                            'label' => esc_html__('Weight', 'komestic' ),
                            'type' => 'slider',
                            'separator' => 'before',
                            'size_units' => ['px', 'custom'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item.pxl-divider-horizontal:not(.divider-dashed):not(.divider-dotted):not(.divider-double)' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item.pxl-divider-vertical:not(.divider-dashed):not(.divider-dotted):not(.divider-double)'   => 'width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item:not(.divider-custom)' => '--pxl-weight: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item.divider-custom img' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item.divider-custom svg' => 'height: {{SIZE}}{{UNIT}}; width: auto;' 
                            ],
                        ),
                        array(
                            'name' => 'divider_width',
                            'label' => esc_html__('Width', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item,
                                {{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item.divider-custom img' => 'width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item.divider-custom svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                            ],
                            'condition' => [
                                'divider_direction' => 'horizontal',
                            ],
                        ),
                        array(
                            'name' => 'divider_max_width',
                            'label' => esc_html__('Max Width', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'divider_direction' => 'horizontal',
                            ],
                        ),

                        array(
                            'name' => 'divider_height',
                            'label' => esc_html__('Height', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item,
                                {{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item.divider-custom img' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-item.divider-custom svg' => 'height: {{SIZE}}{{UNIT}}; width: auto;'                            ],
                            'condition' => [
                                'divider_direction' => 'vertical',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_title_style',
                    'label' => esc_html__('Title', 'komestic' ),
                    'tab' => 'style',
                    'condition' => [
                        'divider_element' => 'title',
                        'divider_direction' => 'horizontal',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'title_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'title_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'title_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title',
                                        ),
                                        array(
                                            'name' => 'title_stroke',
                                            'type' => \Elementor\Group_Control_Text_Stroke::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title',
                                        ),
                                        array(
                                            'name' => 'title_shadow',
                                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'title_highlight',
                                    'label' => esc_html__('Highlight', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'title_hl_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title .pxl-text-highlight' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_hl_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title .pxl-text-highlight',
                                        ),
                                        array(
                                            'name' => 'title_hl_stroke',
                                            'type' => \Elementor\Group_Control_Text_Stroke::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title .pxl-text-highlight',
                                        ),
                                        array(
                                            'name' => 'title_hl_shadow',
                                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title .pxl-text-highlight',
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_style_icon',
                    'label' => esc_html__('Icon', 'komestic'),
                    'tab' => 'style',
                    'condition' => [
                        'divider_element' => 'icon',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-icon' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_sz',
                            'label' => esc_html__('Icon Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'px' => [
                                'min' => 0,
                                'max' => 2000
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                                '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ), 
                    ),
                ),

                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-divider-wrapper .pxl-divider-icon, {{WRAPPER}} .pxl-divider-wrapper .pxl-divider-title',
                    ]),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);