<?php

if (!class_exists('Komestic_Page')) {

    class Komestic_Page
    {
        public function get_site_loader(){

            $site_loader = komestic()->get_theme_opt( 'site_loader', 'off' );
            if($site_loader == 'on') : ?>
                <div id="preloader" class="preloader">
                    <div class="pxl-loader-spinner">
                        <div class="pxl-loader-bounce1"></div>
                        <div class="pxl-loader-bounce2"></div>
                        <div class="pxl-loader-bounce3"></div>
                    </div>
                </div>
            <?php endif;
        }

        public function get_link_pages() {
            wp_link_pages( array(
                'before'      => '<div class="page-links">',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) ); 
        }

        
        public function get_post_title() {
            $post_title_mode = komestic()->get_theme_opt('post_title_mode', '');
            $post_title_layout = (int)komestic()->get_theme_opt('post_title_layout', 0);
            if(is_singular('product')) {
                $post_title_mode = komestic()->get_theme_opt('product_title_mode', '');
                $post_title_layout = (int)komestic()->get_theme_opt('product_title_layout', 0);
            }elseif(is_search()) {
                $post_title_mode = komestic()->get_theme_opt('search_title_mode', '');
                $post_title_layout = (int)komestic()->get_theme_opt('search_title_layout', 0);
            }
            if($post_title_mode === 'disable') return;
            $is_builder = $post_title_mode === 'builder' && $post_title_layout > 0 && class_exists('Pxltheme_Core') && is_callable( 'Elementor\Plugin::instance' );
            $background_color = $is_builder ? 'transparent' : '#f5f6f6';
            ?>
            <section id="pxl-post-title" class="post-title" style="background-color: <?php echo esc_attr($background_color); ?>">
                <?php if ($is_builder) : ?>
                    <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display($post_title_layout);?>
                <?php else : ?>
                    <?php 
                        $title = $this->get_title();
                        $post_title = $title['title'];    
                    ?>
                    <div class="container">
                        <div class="post-title__inner">
                            <h3><?php echo esc_html($post_title); ?></h3>
                        </div>
                    </div>
                <?php endif; ?>
            </section>

            <?php
        }

        public function get_page_title(){
            $titles = $this->get_title();
            $page_title_mode   = komestic()->get_page_opt('page_title_mode', 'inherit');
            if($page_title_mode === 'inherit') {
                $page_title_mode = komestic()->get_theme_opt('page_title_mode', 'default');
            }
            if($page_title_mode === 'disable') return;

            $page_title_layout = (int)komestic()->get_opt('page_title_layout', 0);

            $is_builder = ($page_title_mode === 'builder' && $page_title_layout > 0 && class_exists('Pxltheme_Core') && is_callable( 'Elementor\Plugin::instance'));
            $background_color = $is_builder ? 'transparent' : '#f5f6f6';
            ?>
            <section id="pxl-page-title" class="page-title" style="background-color: <?php echo esc_attr($background_color); ?>">
                <?php if ($is_builder) : ?>
                        <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $page_title_layout);?>
                <?php else : ?>
                    <div class="container">
                        <div class="page-title__inner">
                            <h2><?php echo esc_html($titles['title']) ?></h2>
                        </div>
                    </div>
                <?php endif; ?>
            </section>
            <?php
        } 

        public function get_title() {
            $title = '';
            // Default titles
            if ( ! is_archive() ) {
                // Posts page view
                if ( is_home() ) {
                    // Only available if posts page is set.
                    if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
                        $title = get_post_meta( $page_for_posts, 'custom_title', true );
                        if ( empty( $title ) ) {
                            $title = get_the_title( $page_for_posts );
                        }
                    }
                    if ( is_front_page() ) {
                        $title = esc_html__( 'Blog', 'komestic' );
                    }
                } // Single page view
                elseif ( is_page() ) {
                    $title = get_post_meta( get_the_ID(), 'custom_title', true );
                    if ( ! $title ) {
                        $title = get_the_title();
                    }
                } elseif ( is_404() ) {
                    $title = esc_html__( '404 Error', 'komestic' );
                } elseif ( is_search() ) {
                    $title = esc_html__( 'Search results', 'komestic' );
                } elseif ( is_singular('lp_course') ) {
                    $title = esc_html__( 'Course', 'komestic' );
                } else {
                    $title = get_post_meta( get_the_ID(), 'custom_title', true );
                    if ( ! $title ) {
                        $title = get_the_title();
                    }
                }
            } else {
                $title = get_the_archive_title();
                if( (class_exists( 'WooCommerce' ) && is_shop()) ) {
                    $title = get_post_meta( wc_get_page_id('shop'), 'custom_title', true );
                    if(!$title) {
                        $title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
                    }
                }
            }

            return array(
                'title' => $title,
            );
        }

        public function get_breadcrumb() {
            if (!class_exists('CASE_Breadcrumb')) 
                return;

            $breadcrumb = new CASE_Breadcrumb();
            $entries = $breadcrumb->get_entries();

            if (empty($entries)) 
                return;
            

            ob_start();
            echo '<ul class="pxl-breadcrumb">';
            foreach ($entries as $entry) {
                $entry = wp_parse_args($entry, array(
                    'label' => '',
                    'url'   => ''
                ));

                $entry_label = $entry['label'];
                if (!empty($_GET['blog_title'])) {
                    $blog_title = $_GET['blog_title'];
                    $custom_title = explode('_', $blog_title);
                    foreach ($custom_title as $index => $value) {
                        $arr_str_b[$index] = $value;
                    }
                    $str = implode(' ', $arr_str_b);
                    $entry_label = $str;
                }

                if (empty($entry_label)) {
                    continue;
                }

                echo '<li>';

                if (!empty($entry['url'])) {
                    printf(
                    '<a class="breadcrumb-link" href="%1$s">%2$s</a>',
                    esc_url($entry['url']),
                    esc_attr($entry_label)
                    );
                } else {
                    $breadcrumb = komestic()->get_page_opt('page_breadcrumb', '');
                    $breadcrumb_text = komestic()->get_page_opt('page_breadcrumb_text', '');
                    if(is_singular('project')) {
                        $breadcrumb = komestic()->get_theme_opt('single_project_breadcrumb', 'default');
                        $breadcrumb_text = komestic()->get_theme_opt('single_project_breadcrumb_text', 'Project Details');
                    }elseif(is_singular('service')) {
                        $breadcrumb = komestic()->get_theme_opt('single_service_breadcrumb', 'default');
                        $breadcrumb_text = komestic()->get_theme_opt('single_service_breadcrumb_text', 'Service Details');
                    }elseif(is_singular('product')) {
                        $breadcrumb = komestic()->get_theme_opt('single_product_breadcrumb', 'default');
                        $breadcrumb_text = komestic()->get_theme_opt('single_product_breadcrumb_text', 'Single Product');
                    }elseif(is_singular('post')){
                        $breadcrumb = komestic()->get_theme_opt('single_post_breadcrumb', 'default');
                        $breadcrumb_text = komestic()->get_theme_opt('single_post_breadcrumb_text', 'Blog Details');
                    }elseif(is_singular('team')){
                        $breadcrumb = komestic()->get_theme_opt('single_team_breadcrumb', 'default');
                        $breadcrumb_text = komestic()->get_theme_opt('single_team_breadcrumb_text', 'Single Team');
                    }elseif(is_search()){
                        $breadcrumb = komestic()->get_theme_opt('search_breadcrumb', 'default');
                        $breadcrumb_text = komestic()->get_theme_opt('search_breadcrumb_text', 'Search Results');
                    }elseif(is_home()){
                        $breadcrumb = komestic()->get_theme_opt('blog_breadcrumb', 'default');
                        $breadcrumb_text = komestic()->get_theme_opt('blog_breadcrumb_text', 'Blog');
                    }elseif(function_exists('is_shop') && is_shop()){
                        $breadcrumb = komestic()->get_theme_opt('shop_breadcrumb', 'default');
                        $breadcrumb_text = komestic()->get_theme_opt('shop_breadcrumb_text', 'Shop');
                    }
                    $entry_label = ($breadcrumb === 'custom' && !empty($breadcrumb_text)) ? $breadcrumb_text : $entry_label;
                    printf('<span class="breadcrumb-current">%s</span>', esc_html($entry_label));
                }

                echo '</li>';
                echo '<li class="separator">
                    </li>';
                }
            echo '</ul>';

            $output = ob_get_clean();
            if ($output) {
                echo wp_kses( $output, [
                    'ul' => ['class' => true],
                    'li' => ['class' => true],
                    'a'  => ['href' => true, 'class' => true],
                    'span' => ['class' => true],
                    'svg' => [
                        'class' => true,
                        'xmlns' => true,
                        'width' => true,
                        'height' => true,
                        'viewBox' => true,
                        'fill' => true,
                    ],
                    'path' => [
                        'd' => true,
                        'fill' => true,
                    ],
                ] );
            }

        }

        public function get_pagination( $query = null, $ajax = false ){
            if ( $ajax )
                add_filter('paginate_links', 'komestic_ajax_paginate_links');

            if ( empty( $query ) )
                $query = $GLOBALS['wp_query'];

            // check max_num_pages
            if ( empty( $query->max_num_pages ) || ! is_numeric( $query->max_num_pages ) || $query->max_num_pages < 2 )
                return;

            // Lấy paged
            if ( $query instanceof WP_Query ) {
                $paged = $query->get( 'paged', '' );

                if ( ! $paged && is_front_page() && ! is_home() )
                    $paged = $query->get( 'page', '' );

                $paged = $paged ? intval( $paged ) : 1;
            } else {
                // WP_Term_Query (custom property do mình gán)
                $paged = isset( $query->paged ) ? intval( $query->paged ) : 1;
            }

            $pagenum_link = html_entity_decode( get_pagenum_link() );
            $query_args   = [];
            $url_parts    = explode( '?', $pagenum_link );

            if ( isset( $url_parts[1] ) )
                wp_parse_str( $url_parts[1], $query_args );

            $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
            $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

            $paginate_links_args = [
                'base'      => $pagenum_link,
                'total'     => $query->max_num_pages,
                'current'   => $paged,
                'mid_size'  => 1,
                'add_args'  => array_map( 'urlencode', $query_args ),
                'prev_text' => '<span class="button__text">Prev</span>',
                'next_text' => '<span class="button__text">Next</span>',
                'before_page_number' => '<span class="button__text">',
                'after_page_number'  => '</span>',
                // 'type'      => 'array',
            ];

            if ( $ajax )
                $paginate_links_args['format'] = '?page=%#%';

            $links = paginate_links( $paginate_links_args );
            $output = null;

            if ( $links ) {
                $is_ajax = $ajax ? ' ajax' : '';
                ob_start(); ?>
                <div class="pagination__inner<?php echo esc_attr($is_ajax); ?>">
                    <?php echo wp_kses_post($links); ?>
                </div>
                <?php
                $output = ob_get_clean();
            }

            return $output;
        }

    }
}
