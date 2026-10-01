<?php
	$html_id = pxl_get_element_id($settings);
    $view = $widget->get_setting('view', '');
    $subtitle = $widget->get_setting('subtitle', '');
    $title = $widget->get_setting('title', '');

?>

<div class="pxl-heading">
    <?php if(!empty($subtitle)) : 
        $subtitle = $widget->parse_text_editor( $subtitle );
        $subtitle_style = $widget->get_setting('subtitle_style', 'heading__subtitle--default');       
        $subtitle_entrance_anim = $widget->get_setting('subtitle_entrance_anim', '');
        $subtitle_split_type    = $widget->get_setting('subtitle_split_type', '');    
    ?>
        <div class="heading__subtitle <?php echo esc_attr($subtitle_style.' '.$subtitle_entrance_anim); ?>"
        <?php if(str_contains($subtitle_entrance_anim, 'text-animated')) : ?> data-split-text="<?php echo esc_attr($subtitle_split_type); ?>" <?php endif; ?>>
            <span class="heading__subtitle-text">
                <?php pxl_print_html($subtitle); ?>
            </span>
        </div>
    <?php endif; ?>
    <?php if(!empty($title)) : 
        $title = $widget->parse_text_editor( $title );
        $title_style = $widget->get_setting('title_style', '');  
        $title_entrance_anim = $widget->get_setting('title_entrance_anim', '');
        $title_split_type    = $widget->get_setting('title_split_type', '');
    ?>
        <<?php echo esc_attr($settings['title_tag']); ?> class="heading__title <?php echo esc_attr($title_style.' '.$title_entrance_anim); ?>" 
        <?php if(str_contains($title_entrance_anim, 'text-animated')) : ?> data-split-text="<?php echo esc_attr($title_split_type); ?>" <?php endif; ?>>
            <span class="heading__title-text"><?php pxl_print_html($title); ?></span>
        </<?php echo esc_attr($settings['title_tag']); ?>>
    <?php endif; ?>
</div>
