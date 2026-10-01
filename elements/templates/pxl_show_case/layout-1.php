<?php
$title = $widget->get_setting('title', '');
$title_tag = $widget->get_setting('title_tag', 'div');
$btns = $widget->get_setting('btns', []);

$img_dimension = $widget->get_setting('img_dimension', 'full');
if($img_dimension === 'custom') {
    $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
    $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
}
$image_html = komestic_get_image_by_size([
    'img_id' => $settings['image']['id'],
    'img_dimension' => $img_dimension,
]);

$show_label = (bool)$settings['show_label'];
?>
<div class="pxl-widget show-case">
    <div class="show-case__inner">
        <div class="show-case__image">
            <?php pxl_print_html($image_html); ?>
            <?php if(!empty($btns)) : ?>
                <div class="show-case__buttons">
                    <?php foreach($btns as $btn) : 
                        $btn_text = $btn['btn_text'];
                        $btn_link_attrs = komestic_get_link_attributes($btn['btn_link']);    
                    ?>
                        <a <?php pxl_print_html($btn_link_attrs); ?> class="show-case__button pxl-button button--primary">
                            <span class="button__text"><?php echo esc_html($btn_text); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <<?php echo esc_attr($title_tag); ?> class="show-case__title">
            <span class="show-case__title-text">
                <?php echo esc_html($title); ?>
            </span>
            <?php if($show_label) : ?>
                <span class="show-case__label">
                    <?php echo esc_html($settings['label_text']); ?>
                </span>
            <?php endif; ?>
        </<?php echo esc_attr($title_tag); ?>>
    </div>
</div>