<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_filter',
        'title' => esc_html__('Case Product Filter', 'komestic' ),
        'icon' => 'eicon-site-logo',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_display_opts',
                    'label' => esc_html__('Display', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('Section Title HTML Tag', 'komestic'),
                            'type' => 'select',
                            'seperator' => 'before',
                            'options' => [
                                ''   => esc_html__('Default', 'komestic'),
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
                            'default' => '',
                        ),
                        array(
                            'name' => 'show_category',
                            'label' => esc_html__('Show Category', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_availability',
                            'label' => esc_html__('Show Availability', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_brand',
                            'label' => esc_html__('Show Brand', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_price_slider',
                            'label' => esc_html__('Show Price Slider', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'pa_attrs',
                            'label' => esc_html__('Product Attributes', 'komestic' ),
                            'type' => 'select2',
                            'multiple' => true,
                            'options' => komestic_get_product_attributes_option(),
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);