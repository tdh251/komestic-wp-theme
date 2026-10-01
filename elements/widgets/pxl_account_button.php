<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_account_button',
        'title' => esc_html__('Case Account Button', 'komestic' ),
        'icon' => 'eicon-sort-amount-desc',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Account Button', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array( 
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link after Logged in', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => home_url('/my-account'),
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_general_style',
                    'label' => esc_html__('General', 'komestic'),
                    'tab'   => 'style',
                    'controls' => [
                        array(
                            'name' => 'icon_spacing',
                            'label' => esc_html__('Icon Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .account-button-wrap .account-button' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),

                        array(
                            'name' => 'label_spacing',
                            'label' => esc_html__('Label Spacing', 'komestic' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => ['px', 'custom'],
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .account-button-wrap .account-button .label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .account-button-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                            ],
                        ), 
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'komestic' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .account-button-wrap svg' => 'color: {{VALUE}};',
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
                                '{{WRAPPER}} .account-button-wrap .account-button .label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'label_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .account-button-wrap .account-button .label',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_status_style',
                    'label' => esc_html__('Status', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'status_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .account-button-wrap .account-button .status',
                        ),
                        array(
                            'name' => 'status_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'status_normal',
                                    'label' => esc_html__('Normal', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'status_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .account-button-wrap .account-button .status' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'status_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'status_hover_color',
                                            'label' => esc_html__('Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .account-button-wrap .account-button:hover .status' => 'color: {{VALUE}};',
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