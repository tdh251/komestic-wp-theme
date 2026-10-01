<?php

if (!class_exists('Komestic_Header')) {

    class Komestic_Header
    {
        public function getHeader()
        {
            
            $header_layout = (int)komestic()->get_opt('header_layout'); 
            $header_layout_sticky = (int)komestic()->get_opt('header_layout_sticky'); 

            
            if(is_single()) {
                $post_type = get_post_type();
                $header_layout = (int)komestic()->get_theme_opt('single_'.$post_type.'_header_layout');
                // $header_layout_sticky = (int)komestic()->get_opt('single_post_header_layout_sticky');
            }elseif(is_404()) {
                $header_layout = komestic()->get_theme_opt('404_header_layout', 0) == 0 ? $header_layout : komestic()->get_theme_opt('404_header_layout', 0);
            }elseif(function_exists('is_shop') && is_shop()) {
                $header_layout = komestic()->get_theme_opt('shop_header_layout', 0) == 0 ? $header_layout : komestic()->get_theme_opt('shop_header_layout', 0);
            }
             
            if ($header_layout <= 0 || !class_exists('Pxltheme_Core') || !is_callable( 'Elementor\Plugin::instance' )) {
                get_template_part( 'template-parts/header/default');
            } else {
                $args = [
                    'header_layout' => $header_layout,
                    'header_layout_sticky' => $header_layout_sticky
                ];
                get_template_part( 'template-parts/header/elementor','', $args );
            } 
             
        }
 
    }
}
