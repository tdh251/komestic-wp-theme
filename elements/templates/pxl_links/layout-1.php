<?php 
    $items = $widget->get_setting('items', []);
    if(!empty($items)) :
        // $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // $current_url = strtok($current_url, '?');
        $_icon = $widget->get_setting('_icon', []); 
        $link_hover_style = $widget->get_setting('link_hover_style', ''); 
        $entrance_anim = $widget->get_setting('entrance_anim', '');
    ?>
        <ul class="pxl-links">
            <?php foreach($items as $key => $item) : 
                $link_icon = !empty($item['link_icon']['value']) ? $item['link_icon'] : $_icon;
                $link_text = $item['link_text'] ?? '';
                $link_underline_class = !empty($item['show_underline']) ? ' text-underline' : null;
                $link_attrs = komestic_get_link_attributes($item['link_url']);
                $elementor_item_class = 'elementor-repeater-item-'.$item['_id'];
                $link_hover_style_tmp = !empty($item['show_underline']) ? null : ' '.$link_hover_style;

                $item_url = strtok($item['link_url']['url'] ?? '', '?');

                // $is_active = ($current_url === $item_url) ? ' active' : '';

                $show_label = !empty($item['show_label']);
            ?>
                <li class="link-item <?php echo esc_attr($elementor_item_class.' '.$entrance_anim); ?>">
                    <a <?php pxl_print_html($link_attrs); ?>>
                        <?php if(!empty($link_icon['value'])) : ?>
                            <span class="link-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $link_icon, [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
                            </span>
                        <?php endif; ?>
                        <span class="<?php echo trim(esc_attr('pxl-link'.$link_underline_class.$link_hover_style_tmp)); ?>">
                            <?php echo esc_html($link_text); ?>
                        </span>
                        <?php if($show_label) : ?>
                            <span class="link-label">
                                <?php echo esc_html($item['label_text']); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
<?php endif; ?>