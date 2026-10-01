<?php
    $items = $widget->get_setting('items', []);
    if(!empty($items)) :
        $direction = $widget->get_setting('direction', '');
        $duplicate = (bool)$widget->get_setting('duplicate', '');
        $separator_icon = $widget->get_setting('separator_icon', []);
        $entrance_anim = $widget->get_setting('entrance_anim', '');
    ?>

        <div class="pxl-text-marquee <?php echo esc_attr($direction.' '.$entrance_anim); ?>">
            <p class="text-marquee-item main">
                <?php foreach($items as $key => $item) : 
                    $text = $widget->parse_text_editor( $item['text'] ?? '' );
                    $link_attrs = komestic_get_link_attributes($item['link_url']);
                    $tag = empty($link_attrs) ? 'span' : 'a';
                ?>
                    <<?php echo esc_attr($tag); pxl_print_html(' '.$link_attrs); ?>>
                        <?php pxl_print_html($text); ?>
                    </<?php echo esc_attr($tag); ?>>

                    <?php if(!empty($separator_icon['value']) && $key < count($items)) : ?>
                        <span class="separator">
                            <?php \Elementor\Icons_Manager::render_icon( $separator_icon, [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
                        </span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </p>
            <p class="text-marquee-item duplicated">
                <?php foreach($items as $key => $item) : 
                    $text = $widget->parse_text_editor( $item['text'] ?? '' );
                    $link_attrs = komestic_get_link_attributes($item['link_url']);
                    $tag = empty($link_attrs) ? 'span' : 'a';
                ?>
                    <<?php echo esc_attr($tag); ?>>
                        <?php pxl_print_html($text); ?>
                    </<?php echo esc_attr($tag); ?>>
                    <?php if(!empty($separator_icon['value']) && $key < count($items)) : ?>
                        <span class="separator">
                            <?php \Elementor\Icons_Manager::render_icon( $separator_icon, [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
                        </span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </p>
        </div>
<?php endif;