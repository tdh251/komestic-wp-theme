<?php
$items = $widget->get_setting('items', []);
if(!empty($items)) : 
    $item_active = $widget->get_setting('active', 0);
    $title_tag = $widget->get_setting('title_tag', 'h4');
    $entrance_anim = $widget->get_setting('entrance_anim', '');
    $show_divider = (bool)$widget->get_setting('show_divider', '');

    $sync_to_widget = $widget->get_setting('sync_to_widget', '');
    $sync_target = $widget->get_setting('sync_target', '');
?>
    <div class="pxl-accordion" 
    <?php if(!empty($sync_to_widget)) : ?> 
        data-sync-to-widget = "<?php echo esc_attr($sync_to_widget); ?>" 
        data-sync-target="<?php echo esc_attr($sync_target); ?>" 
    <?php endif; ?>>
        <?php foreach($items as $key => $item) : ?>
            <?php 
                $content = $widget->parse_text_editor( $item['content'] ?? '' );   
                $active_class = $item_active === ($key + 1) ? 'active' : ''; 
                $show_button = !empty($item['show_button']);
                if($show_divider && $key !== 0) :
            ?>
                <span class="accordion-divider"></span>
            <?php endif; ?>
            <div class="accordion-item <?php echo esc_attr($active_class.' '.$entrance_anim); ?>">
                <div class="accordion-header">
                    <<?php echo esc_attr($title_tag); ?> class="accordion-title">
                        <?php echo esc_html($item['title']); ?>
                    </<?php echo esc_attr($title_tag); ?>>
                    <div class="accordion-icon"></div>
                </div>
                <div class="accordion-content">
                    <div class="content-inner">
                        <?php pxl_print_html($content); ?> 
                        <?php if($show_button) : 
                            $btn_link_attrs = komestic_get_link_attributes($item['btn_link']);
                            $btn_text = $item['btn_text'] ?? '';
                        ?>
                            <a <?php pxl_print_html($btn_link_attrs); ?> class="pxl-button button--secondary link-underline">
                                <?php if(!empty($btn_text)) : ?>
                                    <span class="button__text">
                                        <?php echo esc_html($btn_text); ?>
                                    </span>
                                <?php endif; ?>
                                <span class="button__icon">
                                    <svg class="button__icon--main" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M2.72017 0.252869L2.72037 0.809018C2.7204 0.876074 2.74705 0.940376 2.79446 0.987792C2.84188 1.03521 2.90618 1.06186 2.97324 1.06189L8.18722 1.06178L0.073992 9.17501C0.0265952 9.22247 -1.9048e-05 9.2868 1.02285e-08 9.35386C1.90685e-05 9.42093 0.0266696 9.48524 0.0740934 9.53267L0.467422 9.926C0.56611 10.0247 0.726286 10.0247 0.825076 9.9259L8.93831 1.81266L8.9381 7.02695C8.93813 7.09401 8.96478 7.15831 9.0122 7.20573C9.05961 7.25315 9.12391 7.2798 9.19097 7.27982L9.74712 7.27982C9.81418 7.2798 9.87848 7.25315 9.92589 7.20573C9.97331 7.15831 9.99996 7.09401 9.99999 7.02695L10.0001 0.252869C10.0001 0.185813 9.97341 0.121511 9.92599 0.0740953C9.87858 0.0266786 9.81428 2.81812e-05 9.74722 5.2761e-07L2.97303 1.77739e-06C2.90598 2.94369e-05 2.84168 0.0266789 2.79426 0.0740956C2.74684 0.121511 2.72019 0.185814 2.72017 0.252869Z" fill="currentcolor"/>
                                    </svg>
                                    <svg class="button__icon--copy" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M2.72017 0.252869L2.72037 0.809018C2.7204 0.876074 2.74705 0.940376 2.79446 0.987792C2.84188 1.03521 2.90618 1.06186 2.97324 1.06189L8.18722 1.06178L0.073992 9.17501C0.0265952 9.22247 -1.9048e-05 9.2868 1.02285e-08 9.35386C1.90685e-05 9.42093 0.0266696 9.48524 0.0740934 9.53267L0.467422 9.926C0.56611 10.0247 0.726286 10.0247 0.825076 9.9259L8.93831 1.81266L8.9381 7.02695C8.93813 7.09401 8.96478 7.15831 9.0122 7.20573C9.05961 7.25315 9.12391 7.2798 9.19097 7.27982L9.74712 7.27982C9.81418 7.2798 9.87848 7.25315 9.92589 7.20573C9.97331 7.15831 9.99996 7.09401 9.99999 7.02695L10.0001 0.252869C10.0001 0.185813 9.97341 0.121511 9.92599 0.0740953C9.87858 0.0266786 9.81428 2.81812e-05 9.74722 5.2761e-07L2.97303 1.77739e-06C2.90598 2.94369e-05 2.84168 0.0266789 2.79426 0.0740956C2.74684 0.121511 2.72019 0.185814 2.72017 0.252869Z" fill="currentcolor"/>
                                    </svg>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="pxl-notification"><?php echo esc_html__('Accordion Item\'s Not Found', 'komestic'); ?></div>
<?php endif; ?>