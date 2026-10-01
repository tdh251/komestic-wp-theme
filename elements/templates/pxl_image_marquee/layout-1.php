<?php 
$images = $widget->get_setting('images', []);
$img_dimension = $widget->get_setting('img_dimension', 'full');
if($img_dimension === 'custom') {
    $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
    $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : 'full';
}
$direction = 'image-marquee--'.$widget->get_setting('direction', '');
$entrance_anim = $widget->get_setting('entrance_anim', '');
if(!empty($images)) : ?>
    <div class="pxl-image-marquee <?php echo esc_attr($direction); ?>">
        <span class="image-marquee__item image-marquee__item--main">
            <?php foreach($images as $image) : 
                $current_img_dimension = $image['current_img_dimension'];
                $current_img_dimension = (!empty($current_img_dimension['width']) && !empty($current_img_dimension['height'])) ? $current_img_dimension : $img_dimension;
                $thumbnail = komestic_get_image_by_size([
                    'img_id' => $image['image']['id'] ,
                    'img_dimension' => $current_img_dimension,
                    'attr' => [
                        'class' => 'pxl-image',
                    ]
                ]);
                $link_attrs = komestic_get_link_attributes($image['link_url']);
                $tag = !is_null($link_attrs) ? 'a' : 'span';
                ?>
                    <<?php echo esc_attr($tag); ?> class="image-marquee__item-link <?php echo esc_attr($entrance_anim); ?>" <?php pxl_print_html($link_attrs); ?>>
                        <?php pxl_print_html($thumbnail); ?>
                    </<?php echo esc_attr($tag); ?>>
                <?php
            endforeach; ?>
        </span>
        <span class="image-marquee__item image-marquee__item--duplicated">
            <?php foreach($images as $image) : 
                $current_img_dimension = $image['current_img_dimension'];
                $current_img_dimension = (!empty($current_img_dimension['width']) && !empty($current_img_dimension['height'])) ? $current_img_dimension : $img_dimension;
                $thumbnail = komestic_get_image_by_size([
                    'img_id' => $image['image']['id'] ,
                    'img_dimension' => $current_img_dimension,
                    'attr' => [
                        'class' => 'pxl-image',
                    ]
                ]);
                $link_attrs = komestic_get_link_attributes($image['link_url']);
                $tag = !is_null($link_attrs) ? 'a' : 'span';
                ?>
                    <<?php echo esc_attr($tag); ?> class="image-marquee__item-link <?php echo esc_attr($entrance_anim); ?>" <?php pxl_print_html($link_attrs); ?>>
                        <?php pxl_print_html($thumbnail); ?>
                    </<?php echo esc_attr($tag); ?>>
                <?php
            endforeach; ?>
        </span>
    </div>
<?php endif;