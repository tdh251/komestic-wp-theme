<?php
$data = komestic_get_sidebar();
$default = isset($data['default']) ? (string)$data['default'] : '';
$options = isset($data['options']) ? $data['options'] : ['' => 'Sidebar Not Found'];
pxl_add_custom_widget(
    array(
        'name' => 'pxl_sidebar',
        'title' => esc_html__('Case Sidebar', 'komestic' ),
        'icon' => 'eicon-accordion',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'sidebar',
                            'label' => esc_html__('Sidebar', 'komestic'),
                            'type' => 'select',
                            'default' => $default,
                            'options' => $options,
                        ),
                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);