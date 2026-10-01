<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_language_switcher',
        'title' => esc_html__('Case Language Switcher', 'komestic' ),
        'icon' => 'eicon-import-export',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_language_switcher_content',
                    'label' => esc_html__('Items', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'show_flag',
                            'label' => esc_html__('Show Flag', 'komestic'),
                            'type' => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name' => 'items',
                            'label' => esc_html__('Items', 'komestic'),
                            'type' => 'repeater',
                            'controls' => [
                                array(
                                    'name' => 'flag_img',
                                    'label' => esc_html__('Flag', 'komestic' ),
                                    'type' => 'media',
                                ),
                                array(
                                    'name' => 'language',
                                    'label' => esc_html__('Language', 'komestic'),
                                    'type'  => 'text',
                                ),
                                array(
                                    'name' => 'code',
                                    'label' => esc_html__('Code', 'komestic'),
                                    'type'  => 'text',
                                ),
                            ],
                            'default' => [
                                [
                                    'language' => esc_html__('Vietnam', 'komestic'),
                                    'code'     => esc_html__('VN', 'komestic'),
                                ],
                                [
                                    'language' => esc_html__('English', 'komestic'),
                                    'code'     => esc_html__('ENG', 'komestic'),
                                ],
                                [
                                    'language' => esc_html__('China', 'komestic'),
                                    'code'     => esc_html__('CHI', 'komestic'),
                                ]
                            ],
                            'title_field' => '{{{language}}}',
                        ),
                        array(
                            'name' => 'item_active',
                            'type' => 'number',
                            'label' => esc_html__('Active', 'komestic'),
                            'default' => 1,
                            'separator' => 'before'
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'selected_heading',
                            'label' => esc_html__('Selected', 'komestic'),
                            'type' => 'heading',
                        ),
                        array(
                            'name' => 'selected_height',
                            'label' => esc_html__('Height', 'komestic'),
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
                                '{{WRAPPER}} .language-switcher .language-selector' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'selected_min_width',
                            'label' => esc_html__('Min Width', 'komestic'),
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
                                '{{WRAPPER}} .language-switcher' => 'min-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'selected_control_gap',
                            'label' => esc_html__('Flag Spacing', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'separator' => 'before',
                            'range' => [
                                'px' => [
                                    'min' => 0, 
                                    'max' => 1000
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .language-switcher .language-control' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'selected_gap',
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
                                '{{WRAPPER}} .language-switcher .language-selector' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'options_heading',
                            'label' => esc_html__('Options', 'komestic'),
                            'type' => 'heading',
                            'separator' => 'before'
                        ),
                        array(
                            'name' => 'item_spacing',
                            'label' => esc_html__('Item Spacing', 'komestic'),
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
                                '{{WRAPPER}} .language-switcher .language-options .option + .option' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_selected_style',
                    'label' => esc_html__('Selected', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name'  => 'selected_code_style_heading',
                            'label' => esc_html__('Code', 'komestic'),
                            'type'  => 'heading',
                        ),
                        array(
                            'name' => 'selected_code_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .language-switcher .language-control .language-code' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'selected_code_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .language-switcher .language-control .language-code',
                        ),
                        array(
                            'name'  => 'selected_image_style_heading',
                            'label' => esc_html__('Image', 'komestic'),
                            'type'  => 'heading',
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'toggle_selected_image_size',
                            'label' => esc_html__( 'Image Size', 'komestic' ),
                            'type' => 'popover_toggle',
                            'default' => '',
                        ),
                        array(
                            'name' => 'selected_image_size_start_popover',
                            'type' => 'pxl_start_popover',
                        ),
                        array(
                            'name' => 'selected_image_width',
                            'label' => esc_html__('Width', 'komestic'),
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
                                "{{WRAPPER}} .language-switcher .language-control .pxl-flag-image" => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'selected_image_height',
                            'label' => esc_html__('Height', 'komestic'),
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
                                "{{WRAPPER}} .language-switcher .language-control .pxl-flag-image" => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'selected_image_size_start_popover',
                            'type' => 'pxl_end_popover',
                        ),
                        array(
                            'name' => 'selected_image_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .language-switcher .language-control .pxl-flag-image',
                        ),
                        array(
                            'name'         => 'selected_image_box_shadow',
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .language-switcher .language-control .pxl-flag-image',
                        ),
                        array(
                            'name' => 'selected_image_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .language-switcher .language-control .pxl-flag-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'selected_icon_style_heading',
                            'label' => esc_html__('Icon', 'komestic'),
                            'type'  => 'heading',
                            'separator' => 'before'
                        ),
                        array(
                            'name' => 'selected_icon_color',
                            'label' => esc_html__('Icon Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .language-switcher .dropdown-icon' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'selected_icon_size',
                            'label' => esc_html__('Icon Size', 'komestic'),
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
                                "{{WRAPPER}} .language-switcher .dropdown-icon" => 'height: {{SIZE}}{{UNIT}}; width: auto;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_options_style',
                    'label' => esc_html__('Options', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'box_options_style_heading',
                            'label' => esc_html__('Box', 'komestic'),
                            'type' => 'heading',
                        ),
                        array(
                            'name' => 'box_options_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic' ],
                            'selector' => '{{WRAPPER}} .language-switcher .language-options',
                        ),
                        array(
                            'name' => 'box_options_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .language-switcher .language-options',
                        ),
                        array(
                            'name'         => 'box_options_box_shadow',
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .language-switcher .language-options',
                        ),
                        array(
                            'name' => 'box_options_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .language-switcher .language-options' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'box_options_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} .language-switcher .language-options' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'selector_image_style_heading',
                            'label' => esc_html__('Image', 'komestic'),
                            'type'  => 'heading',
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'toggle_selector_image_size',
                            'label' => esc_html__( 'Image Size', 'komestic' ),
                            'type' => 'popover_toggle',
                            'default' => '',
                        ),
                        array(
                            'name' => 'selector_image_size_start_popover',
                            'type' => 'pxl_start_popover',
                        ),
                        array(
                            'name' => 'selector_image_width',
                            'label' => esc_html__('Width', 'komestic'),
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
                                "{{WRAPPER}} .language-switcher .language-options .pxl-flag-image" => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'selector_image_height',
                            'label' => esc_html__('Height', 'komestic'),
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
                                "{{WRAPPER}} .language-switcher .language-options .pxl-flag-image" => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'selector_image_size_start_popover',
                            'type' => 'pxl_end_popover',
                        ),
                        array(
                            'name' => 'selector_image_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .language-switcher .language-options .pxl-flag-image',
                        ),
                        array(
                            'name'         => 'selector_image_box_shadow',
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .language-switcher .language-options .pxl-flag-image',
                        ),
                        array(
                            'name' => 'selector_image_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'selectors' => [
                                '{{WRAPPER}} .language-switcher .language-options .pxl-flag-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'selector_style_heading',
                            'label' => esc_html__('Selector', 'komestic'),
                            'type' => 'heading',
                        ),
                        array(
                            'name' => 'selector_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'selector_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'selector_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .language-switcher .language-options .option' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'selector_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic' ],
                                            'selector' => '{{WRAPPER}} .language-switcher .language-options .option',
                                        ),
                                        array(
                                            'name' => 'selector_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .language-switcher .language-options .option',
                                        ),
                                        array(
                                            'name'         => 'selector_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .language-switcher .language-options .option',
                                        ),
                                        array(
                                            'name' => 'selector_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => ['px', '%' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .language-switcher .language-options .option' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'selector_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => ['px', '%' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .language-switcher .language-options .option' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'selector_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'selector_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .language-switcher .language-options .option:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'selector_hover_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic' ],
                                            'selector' => '{{WRAPPER}} .language-switcher .language-options .option:hover',
                                        ),
                                        array(
                                            'name' => 'selector_transition',
                                            'label' => esc_html__('Transition(s)', 'komestic'),
                                            'type'  => 'slider',
                                            'control_type' => 'responsive' ,
                                            'size_units' => ['s'],
                                            'range' => [
                                                's' => [
                                                    'min' => 0, 
                                                    'max' => 20
                                                ],
                                            ],                                            
                                            'default' => [
                                                'unit' => 's'
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .language-switcher .language-options .option' => 'transition: all {{SIZE}}{{UNIT}} linear;'
                                            ]
                                        ),
                                        array(
                                            'name' => 'selector_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .language-switcher .language-options .option:hover',
                                        ),
                                        array(
                                            'name'         => 'selector_hover_box_shadow',
                                            'label' => esc_html__('Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .language-switcher .language-options .option:hover',
                                        ),
                                        array(
                                            'name' => 'selector_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .language-switcher .language-options .option:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'selector_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .language-switcher .language-options .option:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);