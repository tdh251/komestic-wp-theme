<?php
$form_custom_id = $widget->get_setting('form_custom_id', '');
$submit_with_button_widget = (bool)$widget->get_setting('submit_with_button_widget', '');
$hidden_submit_btn_class = !$submit_with_button_widget ? '' : 'wpcf7-hidden-submit';
$form_id   = $submit_with_button_widget ? $widget->get_setting('form_id', '') : null;
$entrance_anim = $widget->get_setting('entrance_anim', '');
if(class_exists('WPCF7')) :
    if(!empty($settings['cf7_id'])) :
        add_filter('wpcf7_autop_or_not', '__return_false');
        ?>
        <div class="pxl-contact-form7 <?php echo esc_attr($entrance_anim); ?>">
            <?php echo do_shortcode('[contact-form-7 id="'.esc_attr($settings['cf7_id']).'" html_id="'.esc_attr($form_id).'" html_class="wpcf7-'.esc_attr($settings['cf7_id']).' '.esc_attr($hidden_submit_btn_class).'"]'); ?>
        </div>
    <?php else : ?>
        <div class="pxl-notification"><?php echo esc_html__('Choose Your Form', 'komestic'); ?></div>
    <?php endif;
endif; ?>
