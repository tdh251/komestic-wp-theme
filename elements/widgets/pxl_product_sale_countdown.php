<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_sale_countdown',
        'title' => esc_html__('Case Product Sale Count Down', 'komestic' ),
        'icon' => 'eicon-review',
        'categories' => array('pxltheme-core'),

        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Count Down', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'title',
                            'type' => 'text',
                            'label' => esc_html__('Title', 'komestic'),
                            'label_block' => true,
                            'default' => esc_html__('HURRY UP! Sale ends in:', 'komestic'),
                        ),
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('Title HTML Tag', 'komestic' ),
                            'type' => 'select',
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
                            'default' => 'div',
                        ),
                        array(
                            'name' => '_icon',
                            'label' => esc_html__('Icon', 'komestic'),
                            'type' => 'icons',
                            'fa4compatibility' => 'icon',
                            'separator' => 'before',
                            'default' => [
                                'value' => [
                                    'url' => content_url('/uploads/2025/07/clock_fire.svg'),
                                    'id' => 1725,
                                ],
                                'library' => 'svg',
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