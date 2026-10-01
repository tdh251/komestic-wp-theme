<?php

$items       = $widget->get_setting('items', []);
if(!empty($items)) : 
    $item_active = $widget->get_setting('item_active', 1);
    $show_flag   = (bool)$widget->get_setting('show_flag', '');
?>
    <div class="language-switcher">
        <div class="language-selector">
            <?php foreach($items as $key => $item) : ?>
                <?php if($item_active === ($key + 1)) : 
                    $code     = $item['code'] ?? '';
                ?>
                    <div class="language-control">
                        <?php 
                            if($show_flag) {
                                $flag_image  = komestic_get_image_by_size( array(
                                    'img_id'        => $item['flag_img']['id'],
                                    'img_dimension' => 'full',
                                    'attr' => [
                                        'class' => 'pxl-flag-image',
                                    ],
                                ));
                                pxl_print_html($flag_image); 
                            }
                        ?>
                        <div class="language-code">
                            <?php echo esc_html($code); ?>
                        </div>
                    </div>
                    <i class="flaticon flaticon-chevron-down dropdown-icon"></i>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <div class="language-options">
            <?php foreach($items as $key => $item) : 
                $language = $item['language'] ?? '';
                $code     = $item['code'] ?? '';
                $flag_img = komestic_get_image_by_size([
                    'img_id' => $item['flag_img']['id'],
                    'img_dimension' => 'full',
                    'attr' => [
                        'class' => 'pxl-flag-image',
                    ],
                ]);
                $language_active = ($item_active === ($key + 1)) ? 'active' : '';
            ?>
            <div class="option <?php echo esc_attr($language_active); ?>" data-code="<?php echo esc_attr($code); ?>">
                <?php pxl_print_html($flag_img); ?>
                <div class="language-text">
                    <?php echo esc_html($language); ?>
                </div>
            </div>
    
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; 