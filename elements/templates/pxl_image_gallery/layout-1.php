<?php
$images = $widget->get_setting('images', []);
if(!empty($images)) : 
    $has_overlay = (bool)$widget->get_setting('has_overlay', '');
    $img_dimension = $widget->get_setting('img_dimension', 'full');
    if($img_dimension === 'custom') {
        $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
        $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
    } 
    $entrance_anim = $widget->get_setting('entrance_anim', '');
    ?>
        <div class="grid image-gallery">
            <div class="grid__inner">
                <?php foreach($images as $key => $image) :
                    $image_html = komestic_get_image_by_size([
                        'img_id' => $image['image']['id'],
                        'img_dimension' => $img_dimension,
                        'attr' => [
                            'class' => 'pxl-image',
                        ]
                    ]);
                    $link_attrs = komestic_get_link_attributes($image['link_url']);
                    $tag = !empty($link_attrs) ? 'a' : 'span';
                ?>
                    <span class="grid__item <?php echo esc_attr($entrance_anim); ?>">
                        <<?php echo esc_attr($tag); ?> <?php pxl_print_html($link_attrs); ?>>
                            <?php pxl_print_html($image_html); ?>
                            <?php if($has_overlay) : ?>
                                <div class="pxl-background-overlay"></div>
                            <?php endif; ?>
                        </<?php echo esc_attr($tag); ?>>
                    </span>
                    <?php
                endforeach;?>
            </div>
        </div>
<?php 
endif;