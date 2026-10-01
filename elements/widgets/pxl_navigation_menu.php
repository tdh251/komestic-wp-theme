<?php

pxl_add_custom_widget(
    array(
        'name' => 'pxl_navigation_menu',
        'title' => esc_html__('Case Navigation Menu', 'komestic'),
        'icon' => 'eicon-nav-menu',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Navigation Menu', 'komestic'),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'menu',
                            'label' => esc_html__('Menu', 'komestic'),
                            'type' => 'select',
                            'options' => komestic_get_menu_options(),
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
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main' => 'flex-direction: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'justify_content_h',
                            'label' => esc_html__('Justify Content', 'komestic' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'options' => [
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
                                    'title' => esc_html__('Space Around', 'komestic' ),
                                    'icon' => 'eicon-justify-space-around-h',
                                ],
                                'space-evenly' => [
                                    'title' => esc_html__('Space Evenly', 'komestic' ),
                                    'icon' => 'eicon-justify-space-evenly-h',
                                ],
                                'space-between' => [
                                    'title' => esc_html__('Space Between', 'komestic' ),
                                    'icon' => 'eicon-justify-space-between-h',
                                ],
                            ],
                            'label_block' => true,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main' => 'justify-content: {{VALUE}};',
                            ],
                            'condition' => [
                                'direction!' => 'column'
                            ]
                        ),
                        array(
                            'name' => 'justify_content_v',
                            'label' => esc_html__('Justify Content', 'komestic' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'options' => [
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
                                    'title' => esc_html__('Space Around', 'komestic' ),
                                    'icon' => 'eicon-justify-space-around-v',
                                ],
                                'space-evenly' => [
                                    'title' => esc_html__('Space Evenly', 'komestic' ),
                                    'icon' => 'eicon-justify-space-evenly-v',
                                ],
                                'space-between' => [
                                    'title' => esc_html__('Space Between', 'komestic' ),
                                    'icon' => 'eicon-justify-space-between-v',
                                ],
                            ],
                            'label_block' => true,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main' => 'justify-content: {{VALUE}};',
                            ],
                            'condition' => [
                                'direction' => 'column'
                            ]
                        ),
                        array(
                            'name' => 'menu_spacing',
                            'label' => esc_html__('Spacing', 'komestic'),
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
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'menu_height',
                            'label' => esc_html__('Menu Height', 'komestic'),
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
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li > a' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_block_box_style',
                    'label' => esc_html__('Block Box', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'block_box_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .pxl-navigation-menu',
                        ),
                        array(
                            'name' => 'block_box_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'separator' => 'before',
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .pxl-navigation-menu',
                        ),
                        array(
                            'name'         => 'block_box_box_shadow',
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-navigation-menu',
                        ),
                        array(
                            'name' => 'block_box_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', '%', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'block_box_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_menu_style',
                    'label' => esc_html__('Menu', 'komestic'),
                    'tab' => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'         => 'menu_typography',
                                'type'         => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-navigation-menu > li > a',
                            ),
                            array(
                                'name' => 'menu_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'menu_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name'      => 'menu_color',
                                                'label'     => esc_html__('Text Color', 'komestic' ),
                                                'type'      => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'menu_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic' ],
                                                'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li > a',
                                            ),
                                            array(
                                                'name' => 'menu_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li > a',
                                            ),
                                            array(
                                                'name'         => 'menu_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li > a',
                                            ),
                                            array(
                                                'name' => 'menu_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'control_type' => 'responsive',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'menu_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => ['px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'menu_hover',
                                        'label' => esc_html__('Hover', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'menu_hover_style',
                                                'label' => esc_html__('Hover Style', 'komestic' ),
                                                'type' => 'select',
                                                'options' => [
                                                    '' => esc_html__('Default', 'komestic'),
                                                    'hover-link-underline-slide' => esc_html__('Underline Slide', 'komestic'),
                                                ],
                                                'default' => '',
                                            ),
                                            array(
                                                'name' => 'menu_hover_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li:hover, 
                                                    {{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li.current-menu-item, 
                                                    {{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li.current-menu-parent, 
                                                    {{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li.current-menu-ancestor, 
                                                    {{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li.current_page_item, 
                                                    {{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li.current_page_ancestor, 
                                                    {{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li.current_page_parent, 
                                                    {{WRAPPER}} .pxl-navigation-menu .pxl-menu-main > li > .pxl-onepage-active' => 'color: {{VALUE}};',
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
                    'name' => 'tab_submenu_style',
                    'label' => esc_html__('Submenu', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'submenu_box_heading',
                            'label' => esc_html__('Box', 'komestic'),
                            'type' => 'heading',
                        ),
                        array(
                            'name' => 'submenu_box_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu:not(.pxl-mega-menu)',
                        ),
                        array(
                            'name' => 'submenu_box_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu',
                        ),
                        array(
                            'name'         => 'submenu_box_box_shadow',
                            'label' => esc_html__('Box Shadow', 'komestic' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu',
                        ),
                        array(
                            'name' => 'submenu_box_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', '%', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'submenu_box_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'submenu_item_heading',
                            'label' => esc_html__('Item', 'komestic'),
                            'type' => 'heading',
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'submenu_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu > li',
                        ),
                        array(
                            'name' => 'submenu_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'submenu_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'submenu_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu > li > a' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'submenu_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic' ],
                                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu > li > a',
                                        ),
                                        array(
                                            'name' => 'submenu_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu > li > a',
                                        ),
                                        array(
                                            'name'         => 'submenu_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu > li > a',
                                        ),
                                        array(
                                            'name' => 'submenu_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'submenu_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => ['px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main .sub-menu li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'submenu_hover',
                                    'label' => esc_html__('Hover/Active', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'submenu_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-navigation-menu .sub-menu > li:hover > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-item > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-parent > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-ancestor > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_item > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_ancestor > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_parent > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li > a.pxl-onepage-active' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'submenu_hover_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic' ],
                                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .sub-menu > li:hover > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-item > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-parent > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-ancestor > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_item > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_ancestor > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_parent > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li > a.pxl-onepage-active',
                                        ),
                                        array(
                                            'name' => 'submenu_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .sub-menu > li:hover > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-item > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-parent > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-ancestor > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_item > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_ancestor > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_parent > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li > a.pxl-onepage-active',
                                        ),
                                        array(
                                            'name'         => 'submenu_hover_box_shadow',
                                            'label' => esc_html__('Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-navigation-menu .sub-menu > li:hover > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-item > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-parent > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-ancestor > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_item > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_ancestor > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_parent > a, 
                                            {{WRAPPER}} .pxl-navigation-menu .sub-menu > li > a.pxl-onepage-active',
                                        ),
                                        array(
                                            'name' => 'submenu_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-navigation-menu .sub-menu > li:hover > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-item > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-parent > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-ancestor > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_item > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_ancestor > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_parent > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li > a.pxl-onepage-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'submenu_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-navigation-menu .sub-menu > li:hover > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-item > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-parent > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current-menu-ancestor > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_item > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_ancestor > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li.current_page_parent > a, 
                                                {{WRAPPER}} .pxl-navigation-menu .sub-menu > li > a.pxl-onepage-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_menu_label_style',
                    'label' => esc_html__('Label', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name'      => 'label_color',
                            'label'     => esc_html__('Text Color', 'komestic' ),
                            'type'      => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main li.menu-item-has-label::after' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'label_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main li.menu-item-has-label::after',
                        ),
                        array(
                            'name' => 'label_box_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main li.menu-item-has-label::after',
                        ),
                        array(
                            'name' => 'label_box_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main li.menu-item-has-label::after',
                        ),
                        array(
                            'name'         => 'label_box_box_shadow',
                            'label' => esc_html__('Box Shadow', 'komestic' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main li.menu-item-has-label::after',
                        ),
                        array(
                            'name' => 'label_box_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', '%', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main li.menu-item-has-label::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'label_box_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .pxl-menu-main li.menu-item-has-label::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style_mega_menu',
                    'label' => esc_html__('Mega Menu', 'komestic'),
                    'tab' => 'style',
                    'controls' => array( 
                        array(
                            'name' => 'mega_menu_max_width',
                            'label' => esc_html__('Max Width', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .sub-menu.pxl-mega-menu' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'mega_menu_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', '%', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .sub-menu.pxl-mega-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ),
                        array(
                            'name' => 'mega_menu_margin',
                            'label' => esc_html__('Margin', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-menu .sub-menu.pxl-mega-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);