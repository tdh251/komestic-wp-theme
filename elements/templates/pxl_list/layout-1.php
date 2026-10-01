<?php 
$items = $widget->get_setting('items', []);
if(!empty($items)) : 
    $icon  = $widget->get_setting('_icon', []);
    $entrance_anim = $widget->get_setting('entrance_anim', '');
?>
    <ul class="pxl-list">
        <?php foreach($items as $key => $item) : 
            $text = $widget->parse_text_editor($item['text']);    
        ?>
            <li class="list__item" <?php echo esc_attr($entrance_anim); ?>>
                <span class="list__item-icon">
                    <?php if(!empty($icon['value'])) : ?>
                        <?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'i' ); ?>
                    <?php endif; ?>
                </span>
                <p class="list__item-text">
                    <?php pxl_print_html($text); ?>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; 