<?php 
    $post_id = get_the_ID();
    $title_tag = $widget->get_setting('title_tag', '');

    $get_title_default = (bool)$widget->get_setting('get_title_default', '');
    $page_title_custom = komestic()->get_page_opt('page_title_custom', '');

    if($get_title_default) {
        $title = get_the_title();
    }else {
        if(is_single()) {
            $post_type = get_post_type();
            $page_title_custom = komestic()->get_opt('single_'.$post_type.'_title_custom', '');
        }elseif (is_shop()) {
            $page_title_custom = komestic()->get_theme_opt('shop_page_title_custom', '') ?: get_the_archive_title();
        }elseif(is_404()) {
            $page_title_custom = komestic()->get_theme_opt('404_page_title_custom', '');
        }elseif(is_home()) {
            $page_title_custom = komestic()->get_theme_opt('blog_title_custom', '');
        }elseif(is_search()) {
            $page_title_custom = komestic()->get_theme_opt('search_title_custom', '');
        }elseif(is_category() || is_tag()) {
            $page_title_custom = single_cat_title('', false);
        }elseif(is_product_category() || is_product_tag()) {
            $page_title_custom = single_term_title( '', false );
        }
    }
    $title = !empty($page_title_custom) ? $page_title_custom : get_the_title();
    $enable_custom_title = (bool)$widget->get_setting('enable_custom_title', '');
    if($enable_custom_title) {
        $title = $widget->get_setting('custom_title_text', 'Custom Title');;
    }
    $title = $widget->parse_text_editor( $title ); 
?>
<<?php echo esc_attr($title_tag); ?> class="pxl-page-heading">
    <?php pxl_print_html($title); ?>
</<?php echo esc_attr($title_tag); ?>>