<?php 
$nav_id = $widget->get_setting('nav_id', pxl_get_element_id($settings));
$btn_hover_style = $widget->get_setting('btn_hover_style', '');
$nav_btn_icon_prev = $widget->get_settings('nav_btn_icon_prev', []);
$nav_btn_icon_next = $widget->get_settings('nav_btn_icon_next', []);
$entrance_anim = $widget->get_setting('entrance_anim', '');
?>
<div id="<?php echo esc_attr($nav_id); ?>" class="pxl-swiper-navigation swiper-navigation <?php echo esc_attr($entrance_anim); ?>">
    <div class="pxl-swiper-button swiper-button-prev">
        <?php \Elementor\Icons_Manager::render_icon( $nav_btn_icon_prev, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
    </div>
    <div class="pxl-swiper-button swiper-button-next">
        <?php \Elementor\Icons_Manager::render_icon( $nav_btn_icon_next, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
    </div>
</div>