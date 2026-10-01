<?php
$logo_image  = $widget->get_setting('logo_image', []);
$logo_link = $widget->get_setting('logo_link', []);
$entrance_anim = $widget->get_setting('entrance_anim', '');
$logo_image_html  = komestic_get_image_by_size( array(
    'img_id'        => $logo_image['id'],
    'img_dimension' => 'full',
), null, true);

$logo_link_attrs = komestic_get_link_attributes($logo_link);
?>
<a class="pxl-site-logo <?php echo esc_attr($entrance_anim); ?>" <?php pxl_print_html($logo_link_attrs); ?>>
    <?php pxl_print_html($logo_image_html); ?>
</a>
