<?php 
$link_attrs = komestic_get_link_attributes($settings['link_url']);
$title_tag = $widget->get_setting('title_tag', 'h6');
$title = $widget->get_setting('title', '');
$description = $widget->get_setting('description', '');
$icon_box_style = (!empty($settings['icon_box_style'])) ? 'icon-box--'.$settings['icon_box_style'] : null;
$entrance_anim = $widget->get_setting('entrance_anim', '');

$hover_icon_animation = $widget->get_setting('icon_hover_animation', '');
if('account-count' === $settings['icon_box_style']) {
    $acc_source = $widget->get_setting('select_source', 'orders');
    switch($acc_source) {
        case 'wishlist' : 
            $acc_count = ( function_exists( 'woosw_get_items' ) ? count( woosw_get_items() ) : 0 );
            break;
        case 'cart' :
            $acc_count = ( function_exists( 'WC' ) && WC()->cart ? WC()->cart->get_cart_contents_count() : 0 );
            break;
        default : 
            $acc_count = wc_get_customer_order_count( get_current_user_id() );
            break;
    }
}
?>
<div class="pxl-icon-box <?php echo esc_attr($icon_box_style.' '.$entrance_anim); ?>">
    <div class="icon-box__icon <?php echo esc_attr($hover_icon_animation); ?>">
        <?php 
        if($settings['icon_box_style'] == 'image') {
            $icon_img_html = komestic_get_image_by_size([
                'img_id' => $settings['image']['id'],
            ], null, true);
            pxl_print_html($icon_img_html);
        }else{
            \Elementor\Icons_Manager::render_icon( $settings['_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); 
        }
        ?>
    </div>
    <div class="icon-box__content">
        <<?php echo esc_attr($title_tag); ?> class="icon-box__title">
            <?php if(!is_null($link_attrs)) : ?>
                <a <?php pxl_print_html($link_attrs); ?> class="icon-box__title-link">
            <?php endif; ?>
                <?php echo esc_html($title); ?>
            <?php if(!is_null($link_attrs)) : ?>
                </a>
            <?php endif; ?>
            <?php 
                if(isset($acc_count)) {
                    pxl_print_html('<span class="icon-box__count">'.$acc_count.'</span>');
                }   
            ?>
        </<?php echo esc_attr($title_tag); ?>>
        <p class="icon-box__description">
            <?php echo esc_html($description); ?>
        </p>
    </div>
</div>