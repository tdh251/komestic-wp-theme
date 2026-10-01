<?php 
$title = $widget->get_setting('title', '');
$title_tag = $widget->get_setting('title_tag', 'h4');
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

$show_button = (bool)$widget->get_setting('show_button', '');
$entrance_anim = $widget->get_setting('entrance_anim', '');

$featured_hover_style = $widget->get_setting('featured_hover_style', '');

?>

<div class="promo-card <?php echo esc_attr($entrance_anim); ?>" data-layout="3">
    <div class="promo-card__inner">
        <div class="promo-card__image <?php echo esc_attr($featured_hover_style); ?>" <?php if($featured_hover_style === 'image--distortion-transition'): ?> data-displacement="<?php echo esc_attr(get_template_directory_uri() . '/assets/images/displacement-'.$settings['img_displacement'].'.webp'); ?>" <?php endif; ?>>
            <a <?php pxl_print_html($btn_link_attrs); ?>>
                <?php pxl_print_html($image_html); ?>
            </a>
        </div>
        <div class="promo-card__content">
            <<?php echo esc_attr($title_tag); ?> class="promo-card__title">
                <a <?php pxl_print_html($btn_link_attrs); ?>>
                    <?php echo esc_html($title); ?>
                </a>
            </<?php echo esc_attr($title_tag); ?>>
            <p class="promo-card__desc">
                <?php echo esc_html($desc); ?>
            </p>
            <?php if($show_button) : ?>
                <a <?php pxl_print_html($btn_link_attrs); ?> class="pxl-button button--quaternary promo-card__button">
                    <?php get_template_part( 'template-parts/button/button', 'quaternary', ['btn_text' => 'Shop Now'] );  ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>