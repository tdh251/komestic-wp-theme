<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_page_heading',
        'title' => esc_html__('Case Page Heading', 'komestic' ),
        'icon' => 'eicon-post-title',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(         
                array(
                    'name' => 'tab_page_heading_content',
                    'label' => esc_html__('Page Heading', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name'    => 'enable_custom_title',
                            'label'   => esc_html__('Custom Title', 'komestic'),
                            'type'    => 'switcher',
                            'default' => '',
                        ),
                        array(
                            'name'    => 'get_title_default',
                            'label'   => esc_html__('Get Title Default', 'komestic'),
                            'type'    => 'switcher',
                            'default' => '',
                            'condition' => [
                                'enable_custom_title' => '',
                            ],
                        ),
                        array(
                            'name'      => 'custom_title_text',
                            'label'     => esc_html__('Custom Title Text', 'komestic'),
                            'type'      => 'textarea',
                            'row'       => 5,
                            'condition' => [
                                'enable_custom_title' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('Title HTML Tag', 'komestic' ),
                            'type' => 'select',
                            'separator' => 'before',
                            'options' => [
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                                'div' => 'div',
                                'p' => 'p',
                                'span' => 'span',
                            ],
                            'default' => 'h1',
                        ),
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'komestic' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
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
                                '{{WRAPPER}} .pxl-post-title' => 'text-align: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_page_heading_style',
                    'label' => esc_html__('Page Heading', 'komestic' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name'      => 'title_color',
                            'label'     => esc_html__('Text Color', 'komestic' ),
                            'type'      => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-page-heading' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'         => 'title_typography',
                            'type'         => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'separator' => 'before',
                            'selector'     => '{{WRAPPER}} .pxl-page-heading',
                        ),
                    ),
                ),
                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);