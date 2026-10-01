<?php 
    $icon = $widget->get_setting('_icon', []);
    $text = $widget->parse_text_editor( $settings['text'] ?? '' );
    $link_attrs = komestic_get_link_attributes($settings['link']);
    $wrap_tag = !empty($link_attrs) ? 'a' : 'div'; 
    $text_truncate = !empty($widget->get_setting('text_truncate', '')) ? 'text-truncate' : null;
    $entrance_anim = $widget->get_setting('entrance_anim', '');
?>
<<?php echo esc_attr($wrap_tag); ?> class="icon-text <?php echo esc_attr($entrance_anim); ?>" <?php pxl_print_html($link_attrs); ?>>
    <div class="icon-text__icon">
        <?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
    </div>
    <div class="icon-text__text <?php echo esc_attr($text_truncate); ?>">
        <?php pxl_print_html($text); ?>
    </div>
</<?php echo esc_attr($wrap_tag); ?>>