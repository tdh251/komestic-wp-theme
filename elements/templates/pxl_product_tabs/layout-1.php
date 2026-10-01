<?php
defined( 'ABSPATH' ) || exit;
global $product;

if(!$product) return;
$tabs_number = (int)get_post_meta($product->get_id(), 'product_add_tabs', true);
?>
<div class="product-tabs tabs">
    <div class="tab__inner">
        <div class="tab__buttons">
            <?php for($i = 1; $i <= $tabs_number; $i++) : 
                $tab_title = get_post_meta($product->get_id(), 'product_tab_' . $i . '_title', true);    
            ?>
                 <button class="tab__button">
                    <?php echo esc_html($tab_title); ?>
                </button>
            <?php endfor; ?>
            <button class="tab__button">
                <?php echo esc_html__('Review', 'komestic'); ?>
            </button>
        </div>
        <div class="tab__contents">
            <?php for($i = 1; $i <= $tabs_number; $i++) :
                $tab_content = get_post_meta($product->get_id(), 'product_tab_' . $i . '_content', true); 
            ?>
                 <div class="tab__content">
                    <?php echo wpautop( wp_kses_post( $tab_content ) ); ?>
                </div>
            <?php endfor; ?>
            <div class="tab__content">
                <?php
                    if ( ! empty( $product ) && ( comments_open() || get_comments_number() ) ) {
                        comments_template();
                    }
                ?>
            </div>
        </div>
    </div>
</div>