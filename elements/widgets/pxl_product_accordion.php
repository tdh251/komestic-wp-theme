<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_accordion',
        'title' => esc_html__('Case Product Accordion', 'komestic' ),
        'icon' => 'eicon-accordion',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'komestic-accordion',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Accordion', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(   
                        array(
                            'name' => 'show_divider',
                            'label' => esc_html__('Show Divider', 'komestic' ),
                            'type' => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name' => 'show_description',
                            'label' => esc_html__('Show Description', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_ingredients',
                            'label' => esc_html__('Show Ingredients', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'active',
                            'label' => esc_html__('Active', 'komestic' ),
                            'type' => 'number',
                            'min' => 1,
                            'default' => 1,
                        ),
                        array(
                            'name' => 'toggle_active',
                            'label' => esc_html__('Toggle Active', 'komestic' ),
                            'type' => 'switcher',
                            'default' => '',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'item_spacing',
                            'label' => esc_html__('Item Spacing', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .accordion-item + .accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ), 
                        array(
                            'name' => 'content_spacing',
                            'label' => esc_html__('Content Spacing', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .accordion-content .pxl-spacing-block' => 'margin-block: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'content_max_width',
                            'label' => esc_html__('Content Max Width', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .accordion-content' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),

                        array(
                            'name' => 'btn_spacing',
                            'label' => esc_html__('Button Spacing', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .accordion-item .pxl-button' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ), 
                    ),
                ),
                array(
                    'name' => 'tab_block_style',
                    'label' => esc_html__('Accordion Block', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(  
                        array(
                            'name' => 'block_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'block_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'block_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-item',
                                        ),
                                        array(
                                            'name' => 'block_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-item',
                                        ),
                                        array(
                                            'name'         => 'block_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-accordion .accordion-item',
                                        ),
                                        array(
                                            'name' => 'block_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'block_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'block_hover_active',
                                    'label' => esc_html__('Hover/Active', 'komestic' ),
                                    'type' => 'tabs',
                                    'controls' => [
                                        array(
                                            'name' => 'block_hover_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-item:hover, 
                                            {{WRAPPER}} .pxl-accordion .accordion-item.active',
                                        ),
                                        array(
                                            'name' => '_block_hover_border_color',
                                            'label' => esc_html__('Border Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-item:hover, 
                                                {{WRAPPER}} .pxl-accordion .accordion-item.active' => 'border-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'block_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-item:hover, 
                                            {{WRAPPER}} .pxl-accordion .accordion-item.active',
                                        ),
                                        array(
                                            'name'         => 'block_hover_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-accordion .accordion-item:hover, 
                                            {{WRAPPER}} .pxl-accordion .accordion-item.active',
                                        ),
                                        array(
                                            'name' => 'block_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-item:hover, 
                                                {{WRAPPER}} .pxl-accordion .accordion-item.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'block_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-item:hover, 
                                                {{WRAPPER}} .pxl-accordion .accordion-item.active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_title_style',
                    'label' => esc_html__('Accordion Title', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'title_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-header .accordion-title',
                        ),
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
                                                '{{WRAPPER}} .pxl-accordion .accordion-header .accordion-title' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'title_hover',
                                    'label' => esc_html__('Hover/Active', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'title_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-item.active .accordion-title,
                                                {{WRAPPER}} .pxl-accordion .accordion-item:hover .accordion-title' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_icon_style',
                    'label' => esc_html__('Accordion Icon', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'komestic'),
                            'type' => 'slider',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .accordion-header .accordion-icon' => 'width: {{SIZE}}{{UNIT}};',
                            ],
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
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-header .accordion-icon' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'icon_hover',
                                    'label' => esc_html__('Hover/Active', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'icon_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-item.active .accordion-icon,
                                                {{WRAPPER}} .pxl-accordion .accordion-item:hover .accordion-icon' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_content_style',
                    'label' => esc_html__('Accordion Content', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(  
                        array(
                            'name' => 'content_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'box_cotent',
                                    'label' => esc_html__('Block', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'content_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-content .content-inner',
                                        ),
                                        array(
                                            'name' => 'content_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'separator' => 'before',
                                            'size_units' => [ 'px', '%', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content .content-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'content_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content .content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'content_margin',
                                            'label' => esc_html__('Margin', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content .content-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'content_normal',
                                    'label' => esc_html__('Text', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'content_text_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content p' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'content_text_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-content p',
                                        ),
                                        array(
                                            'name' => 'text_bold',
                                            'label' => esc_html__( 'Text Strong Weight', 'komestic' ),
                                            'type' => 'select',
                                            'options' => [
                                                '' => esc_html__('Default', 'komestic'),
                                                '100' => '100',
                                                '200' => '200',
                                                '300' => '300',
                                                '400' => '400',
                                                '500' => '500',
                                                '600' => '600',
                                                '700' => '700',
                                                '800' => '800',
                                                '900' => '900',
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content p strong' => 'font-weight: {{VALUE}};',
                                            ]
                                        ),
                                        array(
                                            'name' => 'text_bold_color',
                                            'label' => esc_html__( 'Text Strong Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content p strong' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'content_heading',
                                    'label' => esc_html__('Heading', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'content_heading_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content h1,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h2,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h3,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h4,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h5,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h6' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'content_heading_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-content h1,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h2,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h3,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h4,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h5,
                                                {{WRAPPER}} .pxl-accordion .accordion-content h6',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'content_hightlight',
                                    'label' => esc_html__('Highlight', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'content_hl_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content .text--highlight' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'content_hl_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-content .text--highlight',
                                        ),
                                    ],
                                ],
                            ],
                        ),
                        array(
                            'name' => 'content_divider',
                            'type' => 'divider',
                        ),
                        array(
                            'name' => 'content_link_heading',
                            'type' => 'heading',
                            'label' => esc_html__('Link', 'komestic'),
                        ),
                        array(
                            'name' => 'content_link_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'content_link_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'content_link_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content a' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'content_link_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-content a',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'content_link_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'content_link_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-accordion .accordion-content a:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'content_link_hover_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-accordion .accordion-content a:hover',
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_btn_style',
                    'label' => esc_html__('Accordion Button', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'btn',
                            'selectors' => '{{WRAPPER}} .pxl-accordion .pxl-button',
                            'type' => 'basic',
                            'label' => 'Button Size',
                        ]),
                        array(
                            array(
                                'name' => 'btn_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .pxl-accordion .pxl-button',
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
                                                    '{{WRAPPER}} .pxl-accordion .pxl-button' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_icon_color',
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-accordion .pxl-button .button__icon' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .pxl-accordion .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-accordion .pxl-button',
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-accordion .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-accordion .pxl-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-accordion .pxl-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-accordion .pxl-button:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_icon_color',
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-accordion .pxl-button:hover .button__icon' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic' ],
                                                'selector' => '{{WRAPPER}} .pxl-accordion .pxl-button:hover',
                                            ),
                                            array(
                                                'name' => '_btn_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-accordion .pxl-button' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .pxl-accordion .pxl-button:hover',
                                            ),
                                            array(
                                                'name'         => 'btn_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-accordion .pxl-button:hover',
                                            ),
                                            array(
                                                'name' => 'btn_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-accordion .pxl-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-accordion .pxl-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'selectors' => '{{WRAPPER}} .pxl-accordion .accordion-item',
                    ]),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);