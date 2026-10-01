<?php

if (!class_exists('Komestic_Footer')) {

    class Komestic_Footer
    {
        public function getFooter()
        {
            if(is_singular('elementor_library')) return;
            
            $footer_layout = (int)komestic()->get_opt('footer_layout');
            if(is_single()) {
                $post_type = get_post_type();
                $footer_layout = (int)komestic()->get_theme_opt('single_'.$post_type.'_footer_layout');
            }elseif(is_404()) {
                $footer_layout = (int)komestic()->get_theme_opt('404_footer_layout', 0) == 0 ? $footer_layout : komestic()->get_theme_opt('404_footer_layout', 0);;
            }elseif(function_exists('is_shop') && is_shop()) {
                $footer_layout = komestic()->get_theme_opt('shop_footer_layout', 0) == 0 ? $footer_layout : komestic()->get_theme_opt('shop_footer_layout', 0);
            }

            if ($footer_layout <= 0 || !class_exists('Pxltheme_Core') || !is_callable( 'Elementor\Plugin::instance' )) {
                get_template_part( 'template-parts/footer/default');
            } else {
                $args = [
                    'footer_layout' => $footer_layout
                ];
                get_template_part( 'template-parts/footer/elementor','', $args );
            } 

            // Mouse Move Animation
            if(function_exists('komestic_cart_sidebar_html')) {
                komestic_cart_sidebar_html();
            }
            if(function_exists('komestic_form_loss_password')) {
                komestic_form_loss_password();
            }

            echo wp_kses_post('<div class="body-overlay"></div>');
            echo wp_kses_post('<button class="pxl-button button--close pxl-cursor pxl-cursor--close"><span class="icon-close"></span></button>');
            if(!is_user_logged_in() && !is_account_page()) {
                $class = ' pxl-popup';
                include  get_template_directory().'/template-parts/woocommerce/login.php'; 
            }

            $quick_add_modal = komestic()->get_theme_opt('quick_add_modal', 0);
            if ( $quick_add_modal > 0 ) {
                if ( ! has_action( 'pxl_anchor_target_template_' . $quick_add_modal ) ) {
                    add_action( 'pxl_anchor_target_template_' . $quick_add_modal, 'komestic_hook_anchor_panel' );
                }
            }
        }
 
    }
}
 