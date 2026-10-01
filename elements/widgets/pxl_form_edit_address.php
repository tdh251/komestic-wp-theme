
<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_form_edit_address',
        'title' => esc_html__('Case Form Edit Address', 'komestic' ),
        'icon' => 'eicon-product-price',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_primary_content',
                    'label' => esc_html__('Source', 'komestic' ),
                    'tab' => 'content',
                    'controls' => array(

                    ),
                ),
            ),
        ),
    ),
    komestic_get_class_widget_path()
);