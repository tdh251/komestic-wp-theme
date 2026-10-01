<?php
$link_attrs = komestic_get_link_attributes($settings['link']);
?>
<div class="pxl-products-compare">
    <div id="pxl-compare-list" class="products-list">
        <?php pxl_print_html(komestic_render_compare_list_html()); ?>
    </div>
    <div class="buttons">
        <a <?php pxl_print_html($link_attrs); ?> class="pxl-button button--primary">
            <span class="button__text"><?php pxl_print_html('Compare (<span class="pxl-compare-count">'.komestic_compare_count().'</span>)'); ?></span>
        </a>
        <button class="pxl-button button--primary clear-compare">
            <span class="button__text"><?php echo esc_html__('Clear All', 'komestic'); ?></span>
        </button>
    </div>
</div>