<?php
    $img_dimension = $widget->get_setting('img_dimension', 'full');
    if($img_dimension === 'custom') {
        $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
        $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
    }
    $image_hover_effect = $widget->get_setting('image_hover_effect', '');
    $image = $widget->get_setting('image', []);
    $link_attrs = komestic_get_link_attributes($settings['image_link']);
    $tag  = !is_null($link_attrs) ? 'a' : 'span';
    $thumbnail = komestic_get_image_by_size([
        'img_id' => $image['id'],
        'img_dimension' => $img_dimension,
        'attr' => [
            'class' => 'no-lazyload',
        ]
    ], null, true);
    $entrance_anim = $widget->get_setting('entrance_anim', '');
?>
<<?php echo esc_attr($tag); ?> class="pxl-image-wrapper <?php echo esc_attr($image_hover_effect); ?>">
    <?php pxl_print_html($thumbnail); ?>
</<?php echo esc_attr($tag); ?>>
