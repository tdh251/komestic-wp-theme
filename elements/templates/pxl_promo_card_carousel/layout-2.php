<?php
$items = $widget->get_setting('items', []);
if(empty($items)) return;

$img_dimension = $widget->get_setting('img_dimension', 'full');
if($img_dimension === 'custom') {
    $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
    $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
}
$title_tag = $widget->get_setting('title_tag', 'h4');

$effect = $widget->get_setting('effect', 'slide');
$allow_touch_move = $widget->get_setting('allow_touch_move', '');
$autoplay = $widget->get_setting('autoplay', false);
$disable_on_interaction = $widget->get_setting('disable_on_interaction', false);
$delay = $widget->get_setting('delay', 5000);
$loop  = $widget->get_setting('loop', false);
$speed = $widget->get_setting('speed', 500);
$space_between = $widget->get_setting('space_between', 0);
$pagination = $widget->get_setting('swiper_pagination', '');
$navigation = (bool)$widget->get_setting('swiper_navigation', false);
$custom_slides = (bool)$widget->get_setting('custom_slides', '');
$slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 1);
$slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 2);
$slides_per_view_md  = $widget->get_setting('slides_per_view_md', 2);
$slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 3);
$slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 3);
$slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 3);
$swiper_params = [
    'effect'                 => $effect,
    'allow_touch_move'       => (bool)$allow_touch_move,
    'autoplay'               => (bool)$autoplay,
    'disable_on_interaction' => (bool)$disable_on_interaction,
    'delay'                  => $delay,
    'loop'                   => (bool)$loop,
    'space_between'          => $space_between,
    'speed'                  => $speed,
    'pagination'             => $pagination,
    'navigation'             => $navigation,
    'slides_per_view_xs'     => (int)$slides_per_view_xs,
    'slides_per_view_sm'     => (int)$slides_per_view_sm,
    'slides_per_view_md'     => (int)$slides_per_view_md,
    'slides_per_view_lg'     => (int)$slides_per_view_lg,
    'slides_per_view_xl'     => (int)$slides_per_view_xl,
    'slides_per_view_xxl'    => (int)$slides_per_view_xxl,
];
$swiper_params = json_encode($swiper_params); 
$swiper_boxshadow = $widget->get_setting('slide_boxshadow', '');
$nav_widget_id = $widget->get_setting('nav_widget_id', '');
$navigation_hidden_class = !empty($nav_widget_id) ? 'swiper-navigation-hidden' : null;
$nav_btn_icon_prev = $widget->get_settings('nav_btn_icon_prev', []);
$nav_btn_icon_next = $widget->get_settings('nav_btn_icon_next', []);

$entrance_anim = $widget->get_setting('entrance_anim', '');
$anim_delay = $widget->get_setting('anim_delay', 0);
$featured_hover_style = $widget->get_setting('featured_hover_style', '');
?>

<div class="pxl-swiper promo-card-carousel" data-layout="2">
    <div class="swiper-inner">
        <div class="swiper-container" data-swiper="<?php echo esc_attr($swiper_params); ?>">
            <div class="swiper-wrapper">
                <?php foreach($items as $key => $item) : 
                    $image_html = komestic_get_image_by_size([
                        'img_id' => $item['image']['id'],
                        'img_dimension' => $img_dimension,
                        'attr' => [
                            'class' => 'no-lazyload',
                        ]
                    ], null, true);
                    $link_attrs = komestic_get_link_attributes($item['link']);
                ?>
                    <div class="swiper-slide <?php echo esc_attr($entrance_anim); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                        <div class="promo-card">
                            <div class="promo-card__inner">
                                <div class="promo-card__image <?php echo esc_attr($featured_hover_style); ?>" <?php if($featured_hover_style === 'image--distortion-transition'): ?> data-displacement="<?php echo esc_attr(get_template_directory_uri() . '/assets/images/displacement-'.$settings['img_displacement'].'.webp'); ?>" <?php endif; ?>>
                                    <a <?php pxl_print_html($link_attrs); ?>>
                                        <?php pxl_print_html($image_html); ?>
                                    </a>
                                </div>
                                <div class="promo-card__content">
                                    <<?php echo esc_attr($title_tag); ?> class="promo-card__title">
                                        <a <?php pxl_print_html($link_attrs); ?>>
                                            <?php echo esc_html($item['title']); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path d="M20.007 6.81607L2.82306 24L0 21.1769L17.1819 3.99301H2.03843V0H24V21.9616H20.007V6.81607Z" fill="#252525"/>
                                            </svg>
                                        </a>
                                    </<?php echo esc_attr($title_tag); ?>>
                                    <p class="promo-card__desc">
                                        <?php echo esc_html($item['desc']) ?>
                                    </p>
                                </div>
                            </div>
                            <?php if(!empty($link_attrs)) : ?>
                                <a <?php pxl_print_html($link_attrs); ?> class="pxl-link"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>