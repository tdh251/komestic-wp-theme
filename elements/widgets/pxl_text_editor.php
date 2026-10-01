<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_text_editor',
        'title' => esc_html__('Case Text Editor', 'komestic'),
        'icon' => 'eicon-text',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Text Editor', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'text_style',
                            'label' => esc_html__('Style', 'komestic' ),
                            'type' => 'select',
                            'options' => [
                                ''                    => esc_html__('Custom', 'komestic' ),
                                'primary'  => esc_html__('Primary', 'komestic' ),
                                'secondary'=> esc_html__('Secondary', 'komestic' ),
                                'tertiary'    => esc_html__('Tertiary', 'komestic' ),
                            ],
                            'default' => '',
                        ),
                        array(
                            'name' => 'text',
                            'type' => 'wysiwyg',
                            'default' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'komestic' ),
                            'description' => 'Highlight text width shortcode: [highlight text="..."]',
                        ),
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__( 'Alignment', 'komestic' ),
                            'type' => 'choose',
                            'separator' => 'before',
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'komestic' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'komestic' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'komestic' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__( 'Justified', 'komestic' ),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-editor' => 'text-align: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_text_style',
                    'label' => esc_html__( 'Text', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
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
                                            'label' => esc_html__( 'Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-text-editor p' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'text_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'separator' => 'before',
                                            'selector' => '{{WRAPPER}} .pxl-text-editor p',
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'text_highlight',
                                    'label' => esc_html__('Highlight', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'text_highlight_color',
                                            'label' => esc_html__( 'Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-text-editor > p .pxl-text-highlight' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'text_highlight_typography',
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-text-editor > p .pxl-text-highlight',
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_link_style',
                    'label' => esc_html__( 'Link', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'link_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'selector' => '{{WRAPPER}} .pxl-text-editor a',
                            'control_type' => 'group',
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
                                            'label' => esc_html__( 'Text Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-text-editor a' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'link_hover',
                                    'label' => esc_html__('Hover', 'komestic' ),
                                    'type' => 'tab',
                                    'controls' => [
                                        array(
                                            'name' => 'link_hover_color',
                                            'label' => esc_html__( 'Link Color', 'komestic' ),
                                            'type' => 'color',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-text-editor a:hover' => 'color: {{VALUE}};',
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
                            'selectors' => '{{WRAPPER}} .pxl-text-editor',
                            'type' => 'text',
                        ]),
                    ),
                ),

                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);