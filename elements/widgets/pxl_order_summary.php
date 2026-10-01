<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_order_summary',
        'title' => esc_html__('Case Order Summary', 'komestic' ),
        'icon' => 'eicon-product-price',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_display_content',
                    'label' => esc_html__('Display', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'show_table',
                            'label' => esc_html__('Show Table', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'table_items',
                            'label' => esc_html__('Tabel Items', 'komestic' ),
                            'type' => 'repeater',
                            'controls' => array(
                                array(
                                    'name' => 'table_item_value',
                                    'label' => esc_html__('Value', 'komestic' ),
                                    'type' => 'select',
                                    'options' => [
                                        'id' => esc_html__('ID', 'komestic'),
                                        'status' => esc_html__('Status', 'komestic'),
                                        'date' => esc_html__('Date', 'komestic'),
                                        'date' => esc_html__('Date', 'komestic'),
                                        'total' => esc_html__('Total', 'komestic'),
                                        'payment-method' => esc_html__('Payment method', 'komestic'),
                                        'action' => esc_html__('Action', 'komestic'),
                                    ],
                                    'default' => 'id',
                                ),
                                array(
                                    'name' => 'show_item_count',
                                    'label' => esc_html__('Show item Count', 'komestic' ),
                                    'type' => 'switcher',
                                    'default' => '',
                                    'condition' => [
                                        'table_item_value' => 'total',
                                    ]
                                ),
                                array(
                                    'name' => 'table_item_label',
                                    'label' => esc_html__('Label', 'komestic' ),
                                    'type' => 'text',
                                    'default' => 'Label',
                                ),
                                array(
                                    'name' => 'table_item_width',
                                    'label' => esc_html__('Width', 'komestic'),
                                    'type' => 'slider',
                                    'control_type' => 'responsive' ,
                                    'size_units' => ['px', '%', 'custom'],
                                    'separator' => 'before',
                                    'range' => [
                                        'px' => [
                                            'min' => 0, 
                                            'max' => 1000
                                        ],
                                        '%' => [
                                            'min' => 0, 
                                            'max' => 100
                                        ],
                                    ],
                                    'default' => [
                                        'size' => '%'
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} .order-summary .order-table ul {{CURRENT_ITEM}}' => 'flex-basis: {{SIZE}}{{UNIT}};',
                                    ],
                                ),
                            ),
                            'default' => [
                                [
                                    'table_item_value' => 'id',           
                                    'table_item_label' => esc_html__( 'Order Number' ,'komestic')
                                ],
                                [
                                    'table_item_value' => 'date',    
                                    'table_item_label' => esc_html__( 'Order Date' ,'komestic')
                                ],
                                [
                                    'table_item_value' => 'total',    
                                    'table_item_label' => esc_html__( 'Order Total' ,'komestic')
                                ],
                                [
                                    'table_item_value' => 'payment-method',           
                                    'table_item_label' => esc_html__( 'Payment method' ,'komestic')
                                ],
                            ],
                            'title_field' => '{{{table_item_value}}}',
                        ),
                        array(
                            'name' => 'show_map',
                            'label' => esc_html__('Show Map', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_tracking',
                            'label' => esc_html__('Show Tracking', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_customer_info',
                            'label' => esc_html__('Show Customer Info', 'komestic' ),
                            'type' => 'switcher',
                            'default' => 'true',
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);