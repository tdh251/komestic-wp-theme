<?php
global $product;

if(!$product || !$product->is_on_sale() || !$product->is_in_stock()) return;


$sale_from = get_post_meta( $product->get_id(), '_sale_price_dates_from', true );
$sale_to   = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
$now = time();
if($now < $sale_from || !$sale_to || $sale_to <= $now) return;

$title_tag = $widget->get_setting('title_tag', 'div');
?>
<div class="product-sale-countdown">
    <div class="countdown-header">
        <?php if(!empty($settings['_icon']['value'])) : ?>
            <div class="countdown-icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($settings['title'])) : ?>
            <<?php echo esc_attr($title_tag); ?> class="countdown-title">
                <?php echo esc_attr($settings['title']); ?>
            </<?php echo esc_attr($title_tag); ?>>
        <?php endif; ?>
    </div>
    <ul class="countdown" 
    <?php if(!empty($sale_from)) : ?> data-time-start="<?php echo esc_attr(date('Y-m-d 00:00:00', $sale_from)); ?>" <?php endif; ?>
    data-time="<?php echo esc_attr(date('Y-m-d 23:59:59', $sale_to)); ?>">
        <li class="countdown__timer days" data-unit="Days"></li>
        <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
        <li class="countdown__timer hours" data-unit="Hours"></li>
        <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
        <li class="countdown__timer minutes" data-unit="Mins"></li>
        <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
        <li class="countdown__timer seconds" data-unit="Secs"></li>
    </ul>
</div>
