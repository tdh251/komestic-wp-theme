<?php
$template_default = ['none' => esc_html__('None', 'komestic')];
if(class_exists('Woocommerce')) {
    $template_default += [
        'pxl-cart-sidebar' => esc_html__('Cart Sidebar', 'komestic'),
        'customer_login'   => esc_html__('Form Login', 'komestic'),
    ];
}
$templates = komestic_get_templates_option('panel') + $template_default;
pxl_add_custom_widget(
    array(
        'name' => 'pxl_button_toggle',
        'title' => esc_html__('Case Button Toggle', 'komestic' ),
        'icon' => 'eicon-toggle',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_btn_content',
                    'label' => esc_html__('Button', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Style', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                ''                    => esc_html__('Custom', 'komestic' ),
                                'primary'  => esc_html__('Primary', 'komestic' ),
                                'secondary'=> esc_html__('Secondary', 'komestic' ),
                                'tertiary'    => esc_html__('Tertiary', 'komestic' ),
                                'quaternary'  => esc_html__('Quaternary', 'komestic'),
                                'quinary'     => esc_html__('Quinary', 'komestic'),
                                'link-underline' => esc_html__('Link Underline', 'komestic'),
                                'only-icon'   => esc_html__('Only Icon', 'komestic'),
                                'only-text'   => esc_html__('Only Text', 'komestic'),
                            ],
                            'default' => 'primary',
                        ),
                        array(
                            'name' => 'btn_text',
                            'label' => esc_html__('Text', 'komestic' ),
                            'type' => 'text',
                            'default' => esc_html__('Click here', 'komestic'),
                            'condition' => [
                                'btn_style!' => ['only-icon', 'shop-grid'],
                            ],
                        ),
                        array(
                            'name' => 'btn_icon',
                            'label' => esc_html__('Icon', 'komestic' ),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'btn_style' => ['only-icon', 'primary', ''],
                            ],
                        ),
                        array(
                            'name' => 'btn_icon_position',
                            'label' => esc_html__('Icon Position', 'komestic' ),
                            'type' => 'choose',
                            'options' => [
                                'row-reverse' => [
                                    'title' => esc_html__('Left', 'komestic'),
                                    'icon'  => 'eicon-arrow-left'
                                ],
                                'row' => [
                                    'title' => esc_html__('Right', 'komestic'),
                                    'icon'  => 'eicon-arrow-right'
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-button' => 'flex-direction: {{VALUE}};',
                            ],
                            'condition' => [
                                'btn_style!' => ['only-icon', 'shop-grid'],
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
                                '{{WRAPPER}} .pxl-button .button__icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto',
                            ],
                            'condition' => [
                                'btn_style!' => ['only-icon', 'shop-grid'],
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
                                '{{WRAPPER}} .pxl-button' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'btn_style!' => ['only-icon', 'shop-grid'],
                            ],
                        ),
                        array(
                            'name' => 'template',
                            'separator' => 'before',
                            'label' => esc_html__('Template', 'komestic'),
                            'type' => 'select',
                            'options' => $templates,
                            'default' => 'none',
                            'description' => 'Add new tab template: "<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '" target="_blank">Click Here</a>"',
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link URL after user logged in', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => home_url('/my-account'),
                            ],
                            'condition' => [
                                'template' => ['customer_login'],
                            ],
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
                            'selectors' => '{{WRAPPER}} .pxl-button',
                            'type' => 'basic',
                            'label' => 'Button Sizes',
                        ]),
                        array(
                            array(
                                'name' => 'icon_size',
                                'label' => esc_html__('Icon Size', 'komestic'),
                                'type' => 'slider',
                                'size_units' => ['px', 'custom'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-button .button__icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                                ],
                            ),
                            array(
                                'name' => 'btn_typography',
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'separator' => 'before',
                                'selector' => '{{WRAPPER}} .pxl-button',
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
                                                    '{{WRAPPER}} .pxl-button' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_icon_color',
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button .button__icon' => 'color: {{VALUE}};',
                                                ],
                                                'condition' => [
                                                    'btn_text!' => '',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types' => [ 'classic', 'gradient' ],
                                                'selector' => '{{WRAPPER}} .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'separator' => 'before',
                                                'control_type' => 'group', 
                                                'selector' => '{{WRAPPER}} .pxl-button',
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-button',
                                            ),
                                            array(
                                                'name' => 'btn_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-button:hover' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_icon_color',
                                                'label' => esc_html__('Icon Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button:hover .button__icon' => 'color: {{VALUE}};',
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
                                                'selector' => '{{WRAPPER}} .pxl-button:hover:not(.button--primary):not(.button--only-text)',
                                                'field' => [
                                                    'color' => [
                                                        '{{WRAPPER}} .pxl-button:hover:not(.button--primary):not(.button--only-text)' => 'background-color: {{VALUE}}',
                                                        '{{WRAPPER}} .pxl-button' => '--pxl-background-color: {{VALUE}}'
                                                    ],
                                                ],
                                            ),
                                            array(
                                                'name' => '_btn_hover_border_color',
                                                'label' => esc_html__('Border Color', 'komestic' ),
                                                'type' => 'color',
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'btn_hover_border',
                                                'type' => \Elementor\Group_Control_Border::get_type(),
                                                'control_type' => 'group', 
                                                'separator' => 'before',
                                                'selector' => '{{WRAPPER}} .pxl-button:hover',
                                            ),
                                            array(
                                                'name'         => 'btn_hover_box_shadow',
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-button:hover',
                                            ),
                                            array(
                                                'name' => 'btn_hover_border_radius',
                                                'label' => esc_html__('Border Radius', 'komestic' ),
                                                'type' => 'dimensions',
                                                'size_units' => [ 'px', '%', 'custom' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    '{{WRAPPER}} .pxl-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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