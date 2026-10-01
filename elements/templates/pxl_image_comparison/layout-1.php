<?php
$img_dimension = $widget->get_setting('img_dimension', 'full');
if($img_dimension === 'custom') {
    $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
    $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
}

$image_before_html = komestic_get_image_by_size([
    'img_id' => $settings['image_before']['id'],
    'img_dimension' => $img_dimension,
    'attr' => [
        'class' => 'no-lazyload image-before',
    ]
], null, true);

$image_after_html = komestic_get_image_by_size([
    'img_id' => $settings['image_after']['id'],
    'img_dimension' => $img_dimension,
    'attr' => [
        'class' => 'no-lazyload image-after',
    ]
], null, true);
$entrance_anim = $widget->get_setting('entrance_anim', '');
?>
<div class="pxl-image-comparison <?php echo esc_attr($entrance_anim); ?>">
    <div class="images">
        <?php pxl_print_html($image_before_html); ?>
        <?php pxl_print_html($image_after_html); ?>
        <button class="pxl-button button--only-icon button--slider">
            <span class="button__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12">
                    <path d="M6.47721 11.75C6.34353 11.75 6.20971 11.699 6.10764 11.5969L0.880365 6.36961C0.676109 6.16535 0.676109 5.8346 0.880365 5.63047L6.10764 0.403192C6.3119 0.198936 6.64266 0.198936 6.84678 0.403192C7.05091 0.607448 7.05104 0.938204 6.84678 1.14233L1.98907 6.00004L6.84678 10.8578C7.05104 11.062 7.05104 11.3928 6.84678 11.5969C6.74472 11.699 6.6109 11.75 6.47721 11.75Z" fill="#252525"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12">
                    <path d="M0.522787 11.75C0.656475 11.75 0.790294 11.699 0.892356 11.5969L6.11964 6.36961C6.32389 6.16535 6.32389 5.8346 6.11964 5.63047L0.892356 0.403192C0.6881 0.198936 0.357343 0.198936 0.153218 0.403192C-0.0509071 0.607448 -0.0510378 0.938204 0.153218 1.14233L5.01093 6.00004L0.153218 10.8578C-0.0510378 11.062 -0.0510378 11.3928 0.153218 11.5969C0.25528 11.699 0.3891 11.75 0.522787 11.75Z" fill="#252525"/>
                </svg>
            </span>
        </button>
    </div>
    <div class="navigation">
        <button class="pxl-button button--primary navigation__button navigation__button--before">
            <?php echo esc_html__('Before', 'komestic'); ?>
        </button>
        <button class="pxl-button button--primary navigation__button navigation__button--after">
            <?php echo esc_html__('After', 'komestic'); ?>
        </button>
    </div>
</div>