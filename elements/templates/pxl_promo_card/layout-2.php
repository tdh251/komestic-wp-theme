<?php 
$title = $widget->get_setting('title', '');
$title_tag = $widget->get_setting('title_tag', 'h3');
$desc = $widget->get_setting('desc', '');
$btn_link_attrs = komestic_get_link_attributes($settings['btn_link']);

$img_dimension = $widget->get_setting('img_dimension', 'full');
if($img_dimension === 'custom') {
    $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
    $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
}
$image = $widget->get_setting('image', []);
$image_html = komestic_get_image_by_size([
    'img_id' => $image['id'],
    'img_dimension' => $img_dimension,
]);
$entrance_anim = $widget->get_setting('entrance_anim', '');
$featured_hover_style = $widget->get_setting('featured_hover_style', '');

?>
<div class="promo-card <?php echo esc_attr($entrance_anim); ?>" data-layout="2">
    <div class="promo-card__inner">
        <div class="promo-card__image <?php echo esc_attr($featured_hover_style); ?>" <?php if($featured_hover_style === 'image--distortion-transition'): ?> data-displacement="<?php echo esc_attr(get_template_directory_uri() . '/assets/images/displacement-'.$settings['img_displacement'].'.webp'); ?>" <?php endif; ?>>
            <a <?php pxl_print_html($btn_link_attrs); ?> class="promo-card__link">
                <?php pxl_print_html($image_html); ?>
            </a>
        </div>
        <div class="promo-card__content">
            <<?php echo esc_attr($title_tag); ?> class="promo-card__title">
                <a <?php pxl_print_html($btn_link_attrs); ?> class="promo-card__link">
                    <?php echo esc_html($title); ?>
                    <span class="promo-card__icon">
                        <svg class="icon--main" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                            <path d="M26.676 9.08809L3.76408 32L0 28.2359L22.9092 5.32402H2.71791V0H32V29.2821H26.676V9.08809Z" fill="#252525"/>
                        </svg>
                        <svg class="icon--copy" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                            <path d="M26.676 9.08809L3.76408 32L0 28.2359L22.9092 5.32402H2.71791V0H32V29.2821H26.676V9.08809Z" fill="#252525"/>
                        </svg>
                    </span>
                </a>
            </<?php echo esc_attr($title_tag); ?>>
            <p class="promo-card__desc">
                <?php echo esc_html($desc); ?>
            </p>
        </div>
    </div>
</div>