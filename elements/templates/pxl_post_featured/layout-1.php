<?php
    $img_dimension = $widget->get_setting('img_dimension', 'full');
    if($img_dimension === 'custom') {
        $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
        $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
    }
    $image_html = komestic_get_image_by_size([
        'img_dimension' => $img_dimension,
        'attr' => [
            'class' => 'pxl-post-featured no-lazyload',
        ]
    ], get_the_ID());
?>
<?php pxl_print_html($image_html); ?>
