<?php
    $btn_text = $widget->get_setting('btn_text', '');
    $btn_icon = $widget->get_setting('btn_icon', []);
    $btn_style_slug = $widget->get_setting('btn_style', '');
    $btn_style = $btn_style_slug ? 'button--'.$btn_style_slug : '';

    $btn_action =  $widget->get_setting('btn_action', '');
    $btn_link = $widget->get_setting('btn_link', []);
    $link_attrs = komestic_get_link_attributes($btn_link);
    $entrance_anim = $widget->get_setting('entrance_anim', '');
    $attrs = [
        'class' => trim('pxl-button '.$btn_style.' '.$entrance_anim),
    ];
    $widget->add_render_attribute( 'attrs', $attrs);
    $offset_top = $widget->get_setting('scroll_offset_top', 0);
    
?>
<a <?php pxl_print_html($link_attrs); pxl_print_html($widget->get_render_attribute_string('attrs')); ?> 
    <?php if(!empty($btn_action)) : ?> data-action="<?php echo esc_attr($btn_action); ?>" <?php endif; ?>>
    <?php 
        if($btn_action === 'submit') {
            get_template_part( 'template-parts/button/button-loader' );    
        }
    ?>

    <?php if(in_array($btn_style_slug, ['secondary', 'tertiary', 'quaternary', 'quinary', 'link-underline'])): 
        get_template_part( 'template-parts/button/button', $settings['btn_style'], ['btn_text' => $btn_text] );        
    
    elseif($btn_style === 'button--only-icon') : ?>
        <span class="button__icon">
            <?php \Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
        </span>
    <?php elseif($btn_style === 'button--only-text') : ?>
        <span class="button__text">
            <?php echo esc_html($btn_text); ?>
        </span>
    <?php else : ?>
        <?php if(!empty($btn_text)) : ?>
            <span class="button__text">
                <?php echo esc_html($btn_text); ?>
            </span>
        <?php endif; ?>
        <?php if(!empty($btn_icon['value'])) : ?>
            <span class="button__icon">
                <?php \Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
            </span>
        <?php endif; ?>
    <?php endif; ?>
</a>
