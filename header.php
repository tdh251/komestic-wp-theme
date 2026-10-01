<?php
/**
 * @package Case-Themes
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php 
        wp_body_open(); 
        $smooth_scroll = komestic()->get_opt('smooth_scroll', 'off'); 
        $_404_page_title = komestic()->get_theme_opt('404_page_title', 'show');
        $_404_show_header = komestic()->get_theme_opt('404_show_header', 'show');
    ?>
    <div id="wrapper" class="wrapper">
    <?php komestic()->page->get_site_loader();
    if($smooth_scroll === 'on') : ?>
        <div id="smooth-wrapper">
            <div id="smooth-content">
    <?php endif; ?>
        <?php 
            if((is_404() && $_404_show_header == 'show') || !is_404()) {
                komestic()->header->getHeader();
            }
            if((!is_single() && !is_search() && !is_404())) {
                komestic()->page->get_page_title();
            }elseif(is_404() && $_404_page_title === 'show') {
                komestic()->page->get_page_title();
            }elseif(!is_404()) {
                komestic()->page->get_post_title();
            }
        ?>
        <main id="pxl-main" class="main-content">
