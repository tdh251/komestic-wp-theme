<?php 
    $items = $widget->get_setting('items', []);
    $entrance_anim = $widget->get_setting('entrance_anim', '');
    if(!empty($items)) :
?>
        <div class="pxl-social-icons">
            <?php foreach($items as $item) : 
                $link_attrs = komestic_get_link_attributes($item['social_link']); 
                $elementor_item_class = 'elementor-repeater-item-'.$item['_id'];
            ?>
                <a <?php pxl_print_html($link_attrs); ?> class="social-item <?php echo esc_attr(trim($elementor_item_class.' '.$entrance_anim)); ?>">
                    <?php \Elementor\Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
                </a>
            <?php endforeach; ?>
        </div>
<?php 
    endif;
    