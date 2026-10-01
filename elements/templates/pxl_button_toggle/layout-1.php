<?php
    $btn_icon = $widget->get_setting('btn_icon', []);
    $btn_text = $widget->get_setting('btn_text', '');
    $btn_style_slug = $widget->get_setting('btn_style', '');
    $btn_style = $btn_style_slug ? 'button--'.$btn_style_slug : '';
    $template = $widget->get_setting('template', 'none');
    $template_html_id = $template !== 'none' ? '#'.$template : '#';
    if(ctype_digit($template)) {
        $template_html_id = '#';
        if(!has_action( 'pxl_anchor_target_template_'.$template)){
            add_action( 'pxl_anchor_target_template_'.$template, 'komestic_hook_anchor_panel' );
        }
        $template_html_id .= 'template-'.$template;
    }elseif($template === 'customer_login' && is_user_logged_in()) {
        $template_html_id = $settings['link']['url'];
    }
?>
<a class="pxl-button button--toggle <?php echo esc_attr($btn_style); ?>" href="<?php echo esc_attr($template_html_id); ?>">
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
                <?php if($template === 'pxl-cart-sidebar') {
                    pxl_print_html(komestic_render_dot_status_cart());
                } ?>
                <?php \Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
            </span>
        <?php endif; ?>
    <?php endif; ?>
</a>
