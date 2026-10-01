<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_search',
        'title' => esc_html__('Case Product Search', 'komestic' ),
        'icon' => 'eicon-product-search',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_product_search_layout',
                    'label' => esc_html__('Layout', 'komestic'),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Layout', 'komestic'),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => array(
                                '1' => array(
                                    'label' => esc_html__('Product Search 1', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/product-search-1.webp',
                                ),
                                '2' => array(
                                    'label' => esc_html__('Product Search 2', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/product-search-2.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic'),
                    'tab' => 'style',
                     'controls' => [
                        array(
                            'name' => 'justify_content_h',
                            'label' => esc_html__('Justify Content', 'komestic'),
                            'type' => 'choose',
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
                                '{{WRAPPER}} .product-search' => 'justify-content: {{VALUE}};'
                            ],
                        ),
                    ],
                ),
                array(
                    'name' => 'tab_form_style',
                    'label' => esc_html__('Form', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'form',
                            'selectors' => '{{WRAPPER}} .product-search .form',
                            'label' => 'Form Size',
                        ]),
                        array(
                            array(
                                'name' => 'form_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'form_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'form_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .product-search .form',
                                            ),
                                            array(
                                                'name' => 'form_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .product-search .form',
                                            ),
                                            array(
                                                'name'         => 'form_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .product-search .form',
                                            ),
                                            array(
                                                'name' => 'form_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'form_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'form_hover',
                                        'label' => esc_html__('Hover/Focus', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'form_hover_bg_color',
                                                'label' => esc_html__('Background Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form' => 'background-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => '_form_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form:hover' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'form_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .product-search .form:hover',
                                            ),
                                            array(
                                                'name'         => 'form_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .product-search .form:hover',
                                            ),
                                            array(
                                                'name' => 'form_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'form_hover_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'name' => 'tab_field_style',
                    'label' => esc_html__('Field', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'field',
                            'selectors' => '{{WRAPPER}} .product-search .form .form__field',
                            'label' => 'Field Size',
                        ]),
                        array(
                            array(
                                'name' => 'filed_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .product-search .form .form__field',
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
                                                    '{{WRAPPER}} .product-search .form .form__field' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'field_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .product-search .form .form__field',
                                            ),
                                            array(
                                                'name' => 'field_padding',
                                                'label' => esc_html__('Padding', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', 'custom' ],
                                                'control_type' => 'responsive',
                                                'separator' => 'before',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form .form__field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'field_hover',
                                        'label' => esc_html__('Hover/Focus', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'field_hover_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form:hover .form__field' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'field_hover_bg_color',
                                                'label' => esc_html__('Background Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form .form__field' => 'background-color: {{VALUE}};',
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
                    'name' => 'tab_select_style',
                    'label' => esc_html__('Select', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'select',
                            'selectors' => '{{WRAPPER}} .product-search .form__select',
                            'label' => 'Select Size',
                        ]),
                        array(
                            array(
                                'name' => 'select_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .product-search .form__select',
                            ),
                            array(
                                'name' => 'select_color',
                                'label' => esc_html__('Text Color', 'komestic' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .product-search .form__select' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'select_background',
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .product-search .form__select',
                            ),
                            array(
                                'name' => 'select_padding',
                                'label' => esc_html__('Padding', 'komestic' ),
                                'type' => 'dimensions',
                                'size_units' => [ 'px', 'custom' ],
                                'control_type' => 'responsive',
                                'separator' => 'before',
                                'selectors' => [
                                    '{{WRAPPER}} .product-search .form__select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'opt_controls',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'opt_normal',
                                        'label' => esc_html__('Normal', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [  
                                            array(
                                                'name' => 'opt_typography',
                                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                                'control_type' => 'group',
                                                'selector' => '{{WRAPPER}} .product-search .form:hover .form__select ul.list li',
                                            ),
                                            array(
                                                'name' => 'opt_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form:hover .form__select ul.list li' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'opt_bg_color',
                                                'label' => esc_html__('Background Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form:hover .form__select ul.list li' => 'background-color: {{VALUE}};',
                                                ],
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'opt_hover',
                                        'label' => esc_html__('Hover/Selected', 'komestic' ),
                                        'type' => 'tab',
                                        'controls' => [
                                            array(
                                                'name' => 'opt_hover_color',
                                                'label' => esc_html__('Text Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form:hover .form__select ul.list li.selected, 
                                                    {{WRAPPER}} .product-search .form:hover .form__select ul.list li:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'opt_hover_bg_color',
                                                'label' => esc_html__('Background Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form:hover .form__select ul.list li.selected, 
                                                    {{WRAPPER}} .product-search .form:hover .form__select ul.list li:hover' => 'background-color: {{VALUE}};',
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
                    'name' => 'tab_btn_style',
                    'label' => esc_html__('Button', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        komestic_size_options([
                            'prefix' => 'btn',
                            'selectors' => '{{WRAPPER}} .product-search .form button',
                            'type' => 'basic',
                            'label' => 'Button Size',
                        ]),
                        array(
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
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form button' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .product-search .form button',
                                            ),
                                            array(
                                                'name' => 'btn_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .product-search .form button',
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .product-search .form button',
                                            ),
                                            array(
                                                'name' => 'btn_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .product-search .form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form button:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_bg_color',
                                                'label' => esc_html__('Background Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form button' => '--pxl-background-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => '_btn_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form button:hover' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .product-search .form button:hover',
                                            ),
                                            array(
                                                'name'         => 'btn_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .product-search .form button:hover',
                                            ),
                                            array(
                                                'name' => 'btn_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .product-search .form button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .product-search .form button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
    ),
    komestic_get_class_widget_path()
);