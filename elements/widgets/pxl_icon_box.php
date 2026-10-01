<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_icon_box',
        'title' => esc_html__('Case Icon Box', 'komestic'),
        'icon' => 'eicon-icon-box',
        'categories' => array('pxltheme-core'),
        'scripts' => [
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Icon Box', 'komestic'),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'icon_box_style',
                            'label' => esc_html__('Style', 'komestic'),
                            'type' => 'select',
                            'default' => '',
                            'options' => [
                                ''           => esc_html__('Custom', 'komestic'),
                                'primary'    => esc_html__('Primary', 'komestic'),
                                'secondary'  => esc_html__('Secondary', 'komestic'),
                                'tertiary'   => esc_html__('Tertiary', 'komestic'),
                                'quaternary' => esc_html__('Quaternary', 'komestic'),
                                'account-count' => esc_html__('Account Count', 'komestic'),
                                'image' => esc_html__('Icon Image', 'komestic'),
                            ],
                        ),
                        array(
                            'name' => 'select_source',
                            'label' => esc_html__('Select Source', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                'orders' => esc_html__('Orders', 'komestic'),
                                'wishlist' => esc_html__('Wishlist', 'komestic'),
                                'cart' => esc_html__('Cart', 'komestic'),
                            ],
                            'default' => 'orders',
                            'condition' => [
                                'icon_box_style' => 'account-count',
                            ],
                        ),
                        array(
                            'name' => '_icon',
                            'label' => esc_html__('Icon', 'komestic'),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'fas fa-star',
                                'library' => 'Font Awesome 5 Free',
                            ],
                            'condition' => [
                                'icon_box_style!' => 'image'
                            ]
                        ),
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Image', 'komestic'),
                            'type' => 'media',
                            'condition' => [
                                'icon_box_style' => 'image'
                            ]
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'komestic'),
                            'type' => 'text',
                            'separator' => 'before',
                            'label_block' => true,
                            'default' => esc_html__('Heading Title', 'komestic'),
                        ),
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('Title HTML Tag', 'komestic'),
                            'type' => 'select',
                            'options' => [
                                'h1' => esc_html__('H1', 'komestic'),
                                'h2' => esc_html__('H2', 'komestic'),
                                'h3' => esc_html__('H3', 'komestic'),
                                'h4' => esc_html__('H4', 'komestic'),
                                'h5' => esc_html__('H5', 'komestic'),
                                'h6' => esc_html__('H6', 'komestic'),
                                'div' => esc_html__('div', 'komestic'),
                                'p'  => esc_html__('p', 'komestic'),
                                'span' => esc_html__('span', 'komestic'),
                            ],
                            'default' => 'h6',
                        ),
                        array(
                            'name' => 'description',
                            'label' => esc_html__('Description', 'komestic'),
                            'type' => 'textarea',
                            'rows' => 10,
                            'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'komestic'),
                        ),
                        array(
                            'name' => 'link_url',
                            'label' => esc_html__('Link URL', 'komestic'),
                            'type' => 'url',
                            'separator' => 'before',
                            'label_block' => true,
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'align_items_row',
                            'label' => esc_html__('Align Items', 'komestic'),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => array(
                                'start' =>[
                                    'title' => esc_html__('Start', 'komestic'),
                                    'icon' => 'eicon-align-start-v',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'komestic'),
                                    'icon' => 'eicon-align-center-v'
                                ],
                                'end' => [
                                    'title' => esc_html__('End', 'komestic'),
                                    'icon' => 'eicon-align-end-v',
                                ],
                                'stretch' => [
                                    'title' => esc_html__('Stretch', 'komestic'),
                                    'icon' => 'eicon-align-stretch-v',
                                ],
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box' => 'align-items: {{VALUE}};'
                            ],
                            'condition' => [
                                'icon_position!' => 'column',
                            ],
                        ),
                        array(
                            'name' => 'align_items_column',
                            'label' => esc_html__('Align Items', 'komestic'),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => array(
                                'start' =>[
                                    'title' => esc_html__('Start', 'komestic'),
                                    'icon' => 'eicon-align-start-h',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'komestic'),
                                    'icon' => 'eicon-align-center-h'
                                ],
                                'end' => [
                                    'title' => esc_html__('End', 'komestic'),
                                    'icon' => 'eicon-align-end-h',
                                ],
                                'stretch' => [
                                    'title' => esc_html__('Stretch', 'komestic'),
                                    'icon' => 'eicon-align-stretch-h',
                                ],
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box' => 'align-items: {{VALUE}};'
                            ],
                            'condition' => [
                                'icon_position' => 'column',
                            ],
                        ),
                        array(
                            'name' => 'icon_position',
                            'label' => esc_html__('Icon Position', 'komestic'),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'options' => array(
                                'row' =>[
                                    'title' => esc_html__('Left', 'komestic'),
                                    'icon' => 'eicon-h-align-left',
                                ],
                                'column' => [
                                    'title' => esc_html__('Top', 'komestic'),
                                    'icon' => 'eicon-v-align-top'
                                ],
                                'row-reverse' => [
                                    'title' => esc_html__('Right', 'komestic'),
                                    'icon' => 'eicon-h-align-right',
                                ],
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box' => 'flex-direction: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'icon_sz',
                            'label' => esc_html__('Icon Size', 'komestic'),
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
                                '{{WRAPPER}} .pxl-icon-box .icon-box__icon svg' => 'height: {{SIZE}}{{UNIT}}; width:auto;',
                                '{{WRAPPER}} .pxl-icon-box .icon-box__icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_spacing',
                            'label' => esc_html__('Icon Spacing', 'komestic'),
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
                                '{{WRAPPER}} .pxl-icon-box' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'content_alignment',
                            'label' => esc_html__('Content Alignment', 'komestic' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'options' => [
                                'left' =>  [
                                    'title' => esc_html__('Left', 'komestic'),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' =>  [
                                    'title' => esc_html__('Center', 'komestic'),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' =>  [
                                    'title' => esc_html__('Right', 'komestic'),
                                    'icon' => 'eicon-text-align-right',
                                ],
                                'justify' =>  [
                                    'title' => esc_html__('Justify', 'komestic'),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box .icon-box__content' => 'text-align: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'content_spacing',
                            'label' => esc_html__('Content Spacing', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box .icon-box__content' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'title_position',
                            'label' => esc_html__('Title Position', 'komestic'),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'separator' => 'before',
                            'options' => array(
                                'column' => [
                                    'title' => esc_html__('Top', 'komestic'),
                                    'icon' => 'eicon-v-align-top'
                                ],
                                'column-reverse' => [
                                    'title' => esc_html__('Bottom', 'komestic'),
                                    'icon' => 'eicon-v-align-bottom',
                                ],
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box .icon-box__content' => 'flex-direction: {{VALUE}};'
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_icon_style',
                    'label' => esc_html__('Icon', 'komestic' ),
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
                                '{{WRAPPER}} .pxl-icon-box .icon-box__icon' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                                            'label' => esc_html__('Icon Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-icon-box .icon-box__icon' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_bacground',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-icon-box .icon-box__icon',
                                        ),
                                        array(
                                            'name' => 'icon_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-icon-box .icon-box__icon',
                                        ),
                                        array(
                                            'name'         => 'icon_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-icon-box .icon-box__icon',
                                        ),
                                        array(
                                            'name' => 'icon_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-icon-box .icon-box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'separator' => 'before',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-icon-box .icon-box__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                            'name' => 'icon_hover_animation',
                                            'label' => esc_html__('Hover Animation', 'komestic'),
                                            'type' => 'select',
                                            'options' => [
                                                '' => esc_html__('None', 'komestic'),
                                                'hover-animation-flipX' => esc_html__('Flip X', 'komestic'),
                                                'hover-animation-flipY' => esc_html__('Flip Y', 'komestic'),
                                                'hover-animation-rotate-zoom-in' => esc_html__('Rotate Zoom', 'komestic'),
                                                'hover-animation-shrink-expand' => esc_html__('Shrink Expand', 'komestic'),
                                                'hover-animation-grow-normalize' => esc_html__('Grow Normalize', 'komestic')
                                            ],
                                            'default' => '',
                                        ),
                                        array(
                                            'name' => 'icon_color_hover',
                                            'label' => esc_html__('Icon Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-icon-box:hover .icon-box__icon' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_hover_background',
                                            'label' => esc_html__('Background Color', 'komestic' ),
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-icon-box:hover .icon-box__icon',
                                        ),
                                        array(
                                            'name' => 'icon_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-icon-box:hover .icon-box__icon',
                                        ),
                                        array(
                                            'name'         => 'icon_hover_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-icon-box:hover .icon-box__icon',
                                        ),
                                        array(
                                            'name' => 'icon_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'control_type' => 'responsive',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-icon-box:hover .icon-box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                '{{WRAPPER}} .pxl-icon-box:hover .icon-box__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'label' => esc_html__('Title', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array( 
                        array(
                            'name' => 'title_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-icon-box .icon-box__title',
                        ),
                        array(
                            'name' => 'title_shadow',
                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-icon-box .icon-box__title',
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
                                                '{{WRAPPER}} .pxl-icon-box .icon-box__title' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_stroke',
                                            'type' => \Elementor\Group_Control_Text_Stroke::get_type(),
                                            'control_type' => 'group',
                                            'separator' => 'before',
                                            'selector' => '{{WRAPPER}} .pxl-icon-box .icon-box__title',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'title_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'title_hover_style',
                                            'label' => esc_html__('Hover Style', 'komestic' ),
                                            'type' => 'select',
                                            'groups' => [
                                                [
                                                    'label' => esc_html__('Default', 'komestic'),
                                                    'options' => [
                                                        '' => esc_html__('Default', 'komestic'),
                                                    ],
                                                ],
                                                [
                                                    'label' => esc_html__('Underline', 'komestic'),
                                                    'options' => [
                                                        'hover-text-underline' => esc_html__('Underline', 'komestic'),
                                                        'hover-text-underline--slide-ltr' => esc_html__('Slide LTR', 'komestic'),
                                                        'hover-text-underline--slide-rtl' => esc_html__('Slide RTL', 'komestic'),
                                                        'hover-text-underline--expland' => esc_html__('Expand', 'komestic'),
                                                        'hover-text-fill' => esc_html__('Fill', 'komestic'),
                                                    ],
                                                ],
                                            ],
                                            'default' => '',
                                        ),
                                        array(
                                            'name' => 'link_underline_weight',
                                            'label' => esc_html__('Underline Weight(px)', 'komestic'),
                                            'type' => 'slider',
                                            'size_units' => ['px'],
                                            'default' => [
                                                'size' => 1,
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-icon-box .icon-box__title' => "--pxl-height: {{SIZE}}{{UNIT}};",
                                            ],
                                            'condition' => [
                                                'title_hover_style' => ['hover-text-underline', 'hover-text-underline--slide-ltr', 'hover-text-underline--slide-rtl', 'hover-text-underline--expland'],
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-icon-box .icon-box__title:hover:not(.hover-text-fill)' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-icon-box .icon-box__title.hover-text-fill' => '--link-color-hover: {{VALUE}};'
                                            ],
                                        ),
                                        array(
                                            'name' => 'title_hover_stroke',
                                            'type' => \Elementor\Group_Control_Text_Stroke::get_type(),
                                            'control_type' => 'group',
                                            'separator' => 'before',
                                            'selector' => '{{WRAPPER}} .pxl-icon-box .icon-box__title:hover',
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_description_style',
                    'label' => esc_html__('Description', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array( 
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__('Text Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box .icon-box__description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'description_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-icon-box .icon-box__description',
                        ),
                    ),
                ),

                array(
                    'name' => 'pxl_motion_effects',
                    'tab' => 'style',
                    'label' => esc_html__('Motion Effects', 'komestic'),
                    'controls' => komestic_get_animation_options([
                        'selectors' => '{{WRAPPER}} .pxl-icon-box',
                    ]),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);