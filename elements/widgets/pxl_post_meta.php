<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_post_meta',
        'title' => esc_html__('Case Post Meta', 'komestic' ),
        'icon' => 'eicon-post-info',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(         
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Post Info', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name'    => 'info_type',
                            'label'   => esc_html__('Info Type', 'komestic'),
                            'type'    => 'select',
                            'options' => array(
                                'category' => esc_html__('Category', 'komestic'),
                                'tags'     => esc_html__('Tags', 'komestic'),
                                'date'     => esc_html__('Date', 'komestic'),
                                'author'   => esc_html__('Author', 'komestic'),
                                'comment'   => esc_html__('Comment', 'komestic'),
                                'custom'   => esc_html__('Custom', 'komestic'),
                            ),
                            'default' => 'custom',
                        ),
                        array(
                            'name' => 'date_format',
                            'label' => esc_html__('Date Format', 'komestic'),
                            'type' => 'text',
                            'default' => 'd M, y',
                            'condition' => array(
                                'info_type' => 'date',
                            ),
                        ),
                        array(
                            'name' => '_icon',
                            'label' => esc_html__('Info Icon', 'komestic'),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'fas fa-star',
                                'library' => 'Font Awesome 5 Free',
                            ],
                        ),
                        array(
                            'name'      => 'info_custom',
                            'label'     => esc_html__('Info Custom', 'komestic'),
                            'type'      => 'text',
                            'label_block'  => true,
                            'default' => esc_html__('Info post here!', 'komestic'),
                            'condition' => [
                                'info_type' => 'custom',
                            ],
                        ),
                        array(
                            'name' => 'info_link',
                            'label' => esc_html__('Link URL', 'komestic' ),
                            'type' => 'url',
                            'condition' => [
                                'info_type' => 'custom',
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
                                '{{WRAPPER}} .pxl-post-meta' => 'align-items: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Gap', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-post-meta' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_block_style',
                    'label' => esc_html__('Meta Block', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'box_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'box_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'box_background',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-post-meta',
                                        ),
                                        array(
                                            'name' => 'box_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'control_type' => 'group', 
                                            'separator' => 'before',
                                            'selector' => '{{WRAPPER}} .pxl-post-meta',
                                        ),
                                        array(
                                            'name'         => 'box_box_shadow',
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-post-meta',
                                        ),
                                        array(
                                            'name' => 'box_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-post-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-post-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'box_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tabs',
                                    'controls' => [
                                        array(
                                            'name' => 'box_hover_bg',
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type' => 'group',
                                            'types' => [ 'classic', 'gradient' ],
                                            'selector' => '{{WRAPPER}} .pxl-post-meta:hover',
                                        ),
                                        array(
                                            'name'      => '_box_hover_border_color',
                                            'label'     => esc_html__('Border Color', 'komestic' ),
                                            'type'      => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-post-meta:hover' => 'border-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_hover_border',
                                            'type' => \Elementor\Group_Control_Border::get_type(),
                                            'separator' => 'before',
                                            'control_type' => 'group', 
                                            'selector' => '{{WRAPPER}} .pxl-post-meta:hover',
                                        ),
                                        array(
                                            'name'         => 'box_hover_box_shadow',
                                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector'     => '{{WRAPPER}} .pxl-post-meta:hover',
                                        ),
                                        array(
                                            'name' => 'box_hover_border_radius',
                                            'label' => esc_html__('Border Radius', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-post-meta:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'box_hover_padding',
                                            'label' => esc_html__('Padding', 'komestic' ),
                                            'type' => 'dimensions',
                                            'size_units' => [ 'px', 'custom' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-post-meta:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_label_style',
                    'label' => esc_html__('Meta Label', 'komestic'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'box_size',
                            'label' => esc_html__('Box Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'px' => [
                                'min' => 0,
                                'max' => 2000
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-post-meta .meta__label' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ), 
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'komestic'),
                            'type' => 'slider',
                            'control_type' => 'responsive' ,
                            'size_units' => ['px', 'custom'],
                            'px' => [
                                'min' => 0,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-post-meta .meta__label svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                        ), 
                        
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-post-meta .meta__label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .pxl-post-meta .meta__label',
                        ),
                        array(
                            'name' => 'icon_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'separator' => 'before',
                            'control_type' => 'group', 
                            'selector' => '{{WRAPPER}} .pxl-post-meta .meta__label',
                        ),
                        array(
                            'name'         => 'icon_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'komestic' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-post-meta .meta__label',
                        ),
                        array(
                            'name' => 'icon_border_radius',
                            'label' => esc_html__('Border Radius', 'komestic' ),
                            'type' => 'dimensions',
                            'size_units' => [ 'px', 'custom' ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-post-meta .meta__label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .pxl-post-meta .meta__label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_text_style',
                    'label' => esc_html__('Meta Info', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'text_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-post-meta .meta__info',
                        ),
                        array(
                            'name' => 'text_shadow',
                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-post-meta .meta__info',
                        ),
                        array(
                            'name' => 'text_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'text_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'text_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-post-meta .meta__info' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'text_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'text_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-post-meta:hover .meta__info' => 'color: {{VALUE}};',
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