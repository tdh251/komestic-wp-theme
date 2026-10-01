<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_quick_add',
        'title' => esc_html__('Case Product Quick Add', 'komestic' ),
        'icon' => 'eicon-sort-amount-desc',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                elementor_tab_advanced_custom(),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);