<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_products_compare',
        'title' => esc_html__('Case Products Compare', 'komestic' ),
        'icon' => 'eicon-product-stock',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_testimonial_layout',
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
                                    'label' => esc_html__('List', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                                '2' => array(
                                    'label' => esc_html__('Table', 'komestic'),
                                    'image' => get_template_directory_uri() . '/elements/assets/img-layouts/testimonial-1.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'komestic'),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link Compare Page', 'komestic' ),
                            'type' => 'url',
                            'default' => [
                                'url' => home_url('/compare'),
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