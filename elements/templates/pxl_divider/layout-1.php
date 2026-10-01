<?php  
    $divider_element = $widget->get_setting('divider_element', '');
    $divider_direction = $widget->get_setting('divider_direction', 'horizontal');
    $divider_class = 'pxl-divider-'.$divider_direction;
    $divider_style = $widget->get_setting('divider_style', '');
    $divider_class .= !empty($divider_style) ? ' divider-'.$divider_style : null;

    global $wp_filesystem;
    $divider_custom_content = '';
    if($divider_style === 'custom') {
        $svg = $widget->get_setting('divider_custom', []);
        if((pathinfo($svg['url'], PATHINFO_EXTENSION) === 'svg')) {
            $icon_urls = explode('uploads', $svg['url']);
            $upload_dir = wp_upload_dir();
            $icon_path = $upload_dir['basedir']. $icon_urls[1] ;
            $divider_custom_content = $wp_filesystem->get_contents( $icon_path );
        }else {
            $divider_custom_content = komestic_get_image_by_size([
                'img_id' => $svg['id'] ?? '',
                'img_dimension' => 'full',
                'attr' => [
                    'class' => 'divider-image',
                ],
            ]);
        }
    }
?>
<span class="pxl-divider-wrapper <?php echo esc_attr($divider_element); ?>">
    <span class="pxl-divider-item <?php echo esc_attr($divider_class); ?>">
        <?php if(!empty($divider_custom_content)) : 
            pxl_print_html($divider_custom_content);
        endif; ?>
    </span>
    <?php 
     if($divider_element === 'elements') :
        $items = $widget->get_setting('items', []);  
        if(!empty($items)) : 
            foreach($items as $item) :
                $elementor_item_class = 'elementor-repeater-item-'.$item['_id'];
    ?>
        <span class="divider-element-item <?php echo esc_attr($elementor_item_class); ?>">
            <?php \Elementor\Icons_Manager::render_icon( $item['divider_element_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
        </span>
    <?php endforeach;
        endif;
    endif; ?>
    <?php if(!empty($divider_element) && $divider_element !== 'elements') : ?>
        <?php if($divider_element === 'title') : ?>
            <?php 
                $title_tag = $widget->get_setting('title_tag', 'span');
                $divider_title = $widget->get_setting('divider_title', 'Divider');
                $divider_title = $widget->parse_text_editor( $divider_title );    
            ?>
            <<?php echo esc_attr($title_tag); ?> class="pxl-divider-element pxl-divider-title">
                <?php pxl_print_html($divider_title); ?>
            </<?php echo esc_attr($title_tag); ?>>
        <?php else: ?>
            <span class="pxl-divider-element pxl-divider-icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['divider_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
            </span>
        <?php endif; ?>
        <span class="pxl-divider-item <?php echo esc_attr($divider_class); ?>">
            <?php if(!empty($divider_custom_content)) : 
                pxl_print_html($divider_custom_content);
            endif; ?>
        </span>    
    <?php endif; ?>
</span>