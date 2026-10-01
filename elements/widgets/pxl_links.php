<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_links',
        'title' => esc_html__('Case Links', 'komestic' ),
        'icon' => 'eicon-link',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Links', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array( 
                        array(
                            'name' => '_icon',
                            'label' => esc_html__('Icon', 'komestic' ),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                        ),
                        array(
                            'name' => 'items',
                            'label' => esc_html__('Links', 'komestic' ),
                            'type' => 'repeater',
                            'controls' => array(
                                array(
                                    'name' => 'link_text',
                                    'label' => esc_html__('Text', 'komestic' ),
                                    'type' => 'textarea',
                                    'rows' => 2,
                                    'default' => esc_html__('Link Item Here', 'komestic'),
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
                                    'name' => 'show_underline',
                                    'label' => esc_html__('Show Underline', 'komestic' ),
                                    'type' => 'switcher',
                                    'default' => '',
                                ),
                                array(
                                    'name' => 'show_label',
                                    'label' => esc_html__('Show Label', 'komestic' ),
                                    'type' => 'switcher',
                                    'default' => '',
                                ),
                                array(
                                    'name' => 'label_text',
                                    'label' => esc_html__('Label Text', 'komestic' ),
                                    'type' => 'text',
                                    'default' => esc_html__('Label', 'komestic'),
                                    'condition' => [
                                        'show_label!' => '',
                                    ],
                                ),
                                array(
                                    'name' => 'label_background_color',
                                    'label' => esc_html__('Label Background', 'komestic' ),
                                    'type' => 'color',
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-links .link-item{{CURRENT_ITEM}} .link-label' => 'background-color: {{VALUE}};',
                                    ],
                                    'condition' => [
                                        'show_label!' => '',
                                    ],
                                ),
                                array(
                                    'name' => 'link_icon',
                                    'label' => esc_html__('Icon', 'komestic' ),
                                    'type' => 'icons',
                                    'fa4compatibility' => 'icon',
                                    'separator' => 'before',
                                ),
                                array(
                                    'name' => 'item_icon_size',
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
                                        '{{WRAPPER}} .pxl-links .link-item{{CURRENT_ITEM}} .link-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ link_text }}}',
                            'default' => [
                                [
                                    'link_text' =>  esc_html__('Link Item 1', 'komestic'),
                                ],
                                [
                                    'link_text' =>  esc_html__('Link Item 2', 'komestic'),
                                ],
                                [
                                    'link_text' =>  esc_html__('Link Item 3', 'komestic'),
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array( 
                        array(
                            'name' => 'icon_vertical_align',
                            'label' => esc_html__('Icon Vertical Align', 'komestic'),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => array(
                                'top' => [
                                    'title' => esc_html__('Top', 'komestic' ),
                                    'icon' => 'eicon-v-align-top',
                                ],
                                'middle' => [
                                    'title' => esc_html__('Middle', 'komestic' ),
                                    'icon' => 'eicon-v-align-middle',
                                ],
                                'bottom' => [
                                    'title' => esc_html__('End', 'komestic' ),
                                    'icon' => 'eicon-v-align-bottom',
                                ],
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-links a .link-icon' => 'vertical-align: {{VALUE}};'
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
                                '{{WRAPPER}} .pxl-links .link-item svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                        ),
                        array(
                            'name' => 'icon_spacing',
                            'label' => esc_html__('Icon Spacing', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-links .link-item a .link-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'item_spacing',
                            'label' => esc_html__('Item Spacing', 'komestic' ),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-links' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'direction',
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
                                '{{WRAPPER}} .pxl-links' => 'flex-direction: {{VALUE}};',
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'tab_link_style',
                    'label' => esc_html__('Link', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'link_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-links .link-item a',
                        ),
                        array(
                            'name' => 'link_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'link_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'link_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_icon_color',
                                            'label' => esc_html__('Icon Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a .link-icon' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-links .link-item a',
                                        ),
                                        array(
                                            'name' => 'link_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-links .link-item a',
                                        ),
                                        array(
                                            'name'         => 'link_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-links .link-item a',
                                        ),
                                        array(
                                            'name' => 'link_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'link_hover',
                                    'label' => esc_html__('Hover/Active', 'komestic' ),
                                    'type' => 'tabs',
                                    'controls' => [
                                        array(
                                            'name' => 'link_hover_style',
                                            'label' => esc_html__('Hover Style', 'komestic' ),
                                            'type' => 'select',
                                            'options' => [
                                                ''                => esc_html__('Default', 'komestic'),
                                                'hover-underline-slide' => esc_html__('Underline Slide', 'komestic'),
                                            ],
                                            'default' => '',
                                        ),
                                        array(
                                            'name' => 'link_underline_weight',
                                            'label' => esc_html__('Underline Weight(px)', 'komestic'),
                                            'type' => 'slider',
                                            'size_units' => ['px'],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a' => "--pxl-height: {{SIZE}}{{UNIT}};",
                                            ],
                                            'condition' => [
                                                'link_hover_style' => ['hover-underline-slide',],
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_hover_color',
                                            'label' => esc_html__('Link Color', 'komestic' ),
                                            'type' => 'color',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_hover_icon_color',
                                            'label' => esc_html__('Icon Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a:hover .link-icon' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_hover_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-links .link-item a:hover',
                                        ),
                                        array(
                                            'name' => '_link_hover_border_color',
                                            'label' => esc_html__('Border Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a:hover' => 'border-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-links .link-item a:hover',
                                        ),
                                        array(
                                            'name'         => 'link_hover_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-links .link-item a:hover',
                                        ),
                                        array(
                                            'name' => 'link_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'link_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-links .link-item a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            'selectors' => '{{WRAPPER}} .pxl-links .link-item',
                        ]),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path(),
);