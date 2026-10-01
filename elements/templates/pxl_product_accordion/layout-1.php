<?php
global $product;
if(!$product) return;
$tabs_number = (int)get_post_meta($product->get_id(), 'product_add_tabs', true);
if(!empty($tabs_number)) : 
    $item_active = $widget->get_setting('active', 0);
    $title_tag = $widget->get_setting('title_tag', 'h4');
    $entrance_anim = $widget->get_setting('entrance_anim', '');
    $show_divider = (bool)$widget->get_setting('show_divider', '');
    $show_description = (bool)$widget->get_setting('show_description', '');
    $show_ingredients = (bool)$widget->get_setting('show_ingredients', '');
    $toggle_active = (bool)$settings['toggle_active'];
?>
    <div class="pxl-accordion" data-toggle="<?php echo esc_attr($toggle_active); ?>">
            <?php for($i = 1; $i <= $tabs_number; $i++) : 
                $content = get_post_meta($product->get_id(), 'product_tab_' . $i . '_content', true);  
                $title   = get_post_meta($product->get_id(), 'product_tab_' . $i . '_title', true);
                $active_class = $item_active === $i ? 'active' : ''; 
                if(!$show_description && 1 === $i) {
                    continue;
                }
                if(!$show_ingredients && 2 === $i) {
                    continue;
                }
            ?>
            <?php if($show_divider && $i > 1) : ?>
                <span class="accordion-divider"></span>
            <?php endif; ?>
            <div class="accordion-item <?php echo esc_attr($active_class.' '.$entrance_anim); ?>">
                <div class="accordion-header">
                    <<?php echo esc_attr($title_tag); ?> class="accordion-title">
                        <?php echo esc_html($title); ?>
                    </<?php echo esc_attr($title_tag); ?>>
                    <div class="accordion-icon"></div>
                </div>
                <div class="accordion-content">
                    <div class="content-inner">
                        <?php echo wpautop( wp_kses_post( $content ) ); ?>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
<?php else: ?>
    <div class="pxl-notification"><?php echo esc_html__('Accordion Item\'s Not Found', 'komestic'); ?></div>
<?php endif; ?>