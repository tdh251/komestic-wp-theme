<?php

$items = $widget->get_setting('items', []);
if(!empty($items)) : 
    $item_active = $widget->get_setting('item_active', 1);
    $show_flag   = (bool)$widget->get_setting('show_flag', '');
    $active_currency = !empty($_COOKIE['_currency']) ? $_COOKIE['_currency'] : $items[$item_active - 1]['currency']; 
?>
    <div class="currency-switcher">
        <div class="currency-selector">
        <?php 
            foreach ($items as $key => $item) : 
                if ($active_currency === $item['currency']) :
                    $curency = $item['currency'] . ' <span>' . get_woocommerce_currency_symbol($item['currency']) . '</span>';
                    ?>
                    <div class="currency-control">
                        <?php 
                        if ($show_flag) {
                            $flag_image = komestic_get_image_by_size([
                                'img_id'        => $item['flag_img']['id'],
                                'img_dimension' => 'full',
                                'attr' => [
                                    'class' => 'pxl-flag-image',
                                ],
                            ]);
                            pxl_print_html($flag_image); 
                        }
                        ?>
                        <div class="currency-code"><?php pxl_print_html($curency); ?></div>
                    </div>
                    <i class="flaticon flaticon-chevron-down dropdown-icon"></i>
                <?php 
                endif; 
            endforeach; 
            ?>
        </div>

        
        <div class="currency-options">
            <?php foreach($items as $key => $item) : 
                $curency = $item['currency']. ' <span>'.get_woocommerce_currency_symbol($item['currency']).'</span>';
                $currency_active = ($active_currency === $item['currency']) ? 'active' : '';
            ?>
            <div class="option <?php echo esc_attr($currency_active); ?>" data-currency="<?php echo esc_attr($item['currency']); ?>" data-unit="<?php echo esc_attr(get_woocommerce_currency_symbol($item['currency'])); ?>">
                <?php 
                    $flag_img = komestic_get_image_by_size([
                        'img_id' => $item['flag_img']['id'],
                        'img_dimension' => 'full',
                        'attr' => [
                            'class' => 'pxl-flag-image',
                        ],
                    ]);
                    pxl_print_html($flag_img); 
                ?>
                <div class="currency__text">
                    <?php pxl_print_html($curency); ?>
                </div>
            </div>
    
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; 