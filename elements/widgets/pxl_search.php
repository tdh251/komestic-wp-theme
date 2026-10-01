<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_search',
        'title' => esc_html__('Case Search', 'komestic' ),
        'icon' => 'eicon-site-search',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Search', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'placeholder',
                            'label' => esc_html__('Placeholder', 'komestic' ),
                            'type' => 'text',
                            'default' => esc_html__('Search here...', 'komestic'),
                        ),
                        array(
                            'name' => 'btn_text',
                            'label' => esc_html__('Button Text', 'komestic' ),
                            'type' => 'text',
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'btn_icon',
                            'label' => esc_html__('Button Icon', 'komestic' ),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => [
                                    'url' => content_url('/uploads/2025/07/search.svg'), 
                                    'id' => 82, 
                                ],
                                'library' => 'svg',
                            ],
                        ),
                        array(
                            'name' => 'btn_icon_position',
                            'label' => esc_html__('Icon Position', 'komestic' ),
                            'type' => 'choose',
                            'options' => [
                                'row' => [
                                    'title' => esc_html__('Left', 'komestic'),
                                    'icon'  => 'eicon-arrow-left'
                                ],
                                'row-reverse' => [
                                    'title' => esc_html__('Right', 'komestic'),
                                    'icon'  => 'eicon-arrow-right'
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search .pxl-button' => 'flex-direction: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'btn_icon_size',
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
                                '{{WRAPPER}} .pxl-search .pxl-button .button__icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                        ),
                        array(
                            'name' => 'btn_icon_spacing',
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
                                '{{WRAPPER}} .pxl-search .pxl-button' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array (
                    'name' => 'tab_general_style',
                    'label'=> esc_html__('General', 'komestic'),
                    'tab'  => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'field_position',
                                'label' => esc_html__('Field Position', 'komestic' ),
                                'type' => 'choose',
                                'options' => [
                                    'row' => [
                                        'title' => esc_html__('Left', 'komestic'),
                                        'icon'  => 'eicon-arrow-left'
                                    ],
                                    'column' => [
                                        'title' => esc_html__('Top', 'komestic'),
                                        'icon'  => 'eicon-arrow-up'
                                    ],
                                    'row-reverse' => [
                                        'title' => esc_html__('Right', 'komestic'),
                                        'icon'  => 'eicon-arrow-right'
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-search .search-form-control' => 'flex-direction: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'field_spacing',
                                'label' => esc_html__('Field Spacing', 'komestic'),
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
                                    '{{WRAPPER}} .pxl-search .search-form-control' => 'gap: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                        ),
                        komestic_position_options([
                            'label' => esc_html__('Button Position', 'komestic'),
                            'prefix' => 'btn',
                            'selectors' => '{{WRAPPER}} .pxl-search .pxl-button',
                            'separator' => true,
                        ]),
                    ),
                ),
                array(
                    'name' => 'tab_field_style',
                    'label' => esc_html__('Search Field', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'field',
                            'selectors' => '{{WRAPPER}} .pxl-search .search-field',
                            'type' => 'basic',
                            'label' => esc_html__('Field Sizes', 'komestic'),
                        ]),
                        array(
                            array(
                                'name' => 'field_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-search .search-field',
                            ),
                            array(
                                'name' => 'field_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'field_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'field_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .search-field' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'field_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .pxl-search .search-field',
                                            ),
                                            array(
                                                'name' => 'field_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-search .search-field',
                                            ),
                                            array(
                                                'name'         => 'field_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-search .search-field',
                                            ),
                                            array(
                                                'name' => 'field_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'field_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'field_hover_focus',
                                        'label' => esc_html__('Hover/Focus', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'field_hover_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .search-field:hover, {{WRAPPER}} .pxl-search .search-field:focus' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'field_hover_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .pxl-search .search-field:hover, {{WRAPPER}} .pxl-search .search-field:focus',
                                            ),
                                            array(
                                                'name' => '_field_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .search-field:hover, {{WRAPPER}} .pxl-search .search-field:focus' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'field_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-search .search-field:hover, {{WRAPPER}} .pxl-search .search-field:focus',
                                            ),
                                            array(
                                                'name'         => 'field_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-search .search-field:hover, {{WRAPPER}} .pxl-search .search-field:focus',
                                            ),
                                            array(
                                                'name' => 'field_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .search-field:hover, {{WRAPPER}} .pxl-search .search-field:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'field_hover_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .search-field:hover, {{WRAPPER}} .pxl-search .search-field:focus' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                ],
                            ),  
                        ) ,
                    ),
                ),
                array(
                    'name' => 'tab_btn_style',
                    'label' => esc_html__('Search Submit', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'btn',
                            'selectors' => '{{WRAPPER}} .pxl-search .pxl-button',
                            'type' => 'basic',
                            'label' => 'Button Sizes',
                        ]),
                        array(
                            array(
                                'name' => 'btn_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .pxl-search .pxl-button',
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
                                                    '{{WRAPPER}} .pxl-search .pxl-button' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_icon_color',
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'condition' => [
                                                    'btn_text!' => '',
                                                ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .pxl-button .button__icon' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .pxl-search .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-search .pxl-button',
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-search .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                               'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .pxl-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-search .pxl-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-search .pxl-button:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_icon_color',
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .pxl-button:hover .button__icon' => 'color: {{VALUE}};',
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
                                                'selector' => '{{WRAPPER}} .pxl-search .pxl-button:hover',
                                            ),
                                            array(
                                                'name' => '_btn_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .pxl-button' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-search .pxl-button:hover',
                                            ),
                                            array(
                                                'name'         => 'btn_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-search .pxl-button:hover',
                                            ),
                                            array(
                                                'name' => 'btn_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-search .pxl-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-search .pxl-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                ],
                            ), 
                        ),
                    ),
                ),
                
                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);