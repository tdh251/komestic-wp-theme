<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_wishlist_button',
        'title' => esc_html__('Case Wishlist Button', 'komestic' ),
        'icon' => 'eicon-sort-amount-desc',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Content', 'komestic'),
                    'tab' => 'content',
                     'controls' => [
                        array(
                            'name' => 'custom_link_page',
                            'label' => esc_html__('Custom Link Page', 'komestic'),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'link_page',
                            'label' => esc_html__('Link URL', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => home_url('/wishlist'),
                            ],
                            'condition' => [
                                'custom_link_page!' => '',
                            ],
                        ),
                    ],
                ),
                array(
                    'name' => 'tab_style_icon',
                    'label' => esc_html__('Icon', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'px' => [
                                'min' => 0,
                                'max' => 2000
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wishlist-button-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                        ), 
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wishlist-button-wrap svg' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),  
                array(
                    'name' => 'tab_label_style',
                    'label' => esc_html__('Label', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'label_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'label_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .label',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_count_style',
                    'label' => esc_html__('Count', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'count_box_size',
                            'label' => esc_html__('Box Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'px' => [
                                'min' => 0,
                                'max' => 2000
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .count' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
                            ],
                        ), 
                        array(
                            'name' => 'count_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .count',
                        ),
                        array(
                            'name' => 'count_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .count' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'count_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .count',
                        ),
                        array(
                            'name' => 'count_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'separator' => 'before',
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .count',
                        ),
                        array(
                            'name'         => 'count_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .count',
                        ),
                        array(
                            'name' => 'count_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'count_padding',
                            'label' => esc_html__('Padding', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'selectors' => [
                                '{{WRAPPER}} .wishlist-button-wrap .wishlist-button .count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);