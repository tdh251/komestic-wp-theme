<?php
    $post_type = $widget->get_setting('post_type', ['post']);
    $tax = ['category'];
    $layout = $widget->get_setting('layout_'.$post_type, 'post-1');
    $select_post_by = $widget->get_setting('select_post_by', '');
    $post_ids = ($select_post_by === 'post_selected') ? $widget->get_setting('source_'.$post_type.'_post_ids', '') : [];
    $source = ($select_post_by === 'term_selected') ? $widget->get_setting('source_'.$post_type , '') : [];
    $orderby = $widget->get_setting('orderby', 'date');
    $order = $widget->get_setting('order', 'desc');
    $limit = $widget->get_setting('limit', 6);
    extract(pxl_get_posts_of_grid(
        $post_type, 
        [
            'source' => $source, 
            'orderby' => $orderby, 
            'order' => $order, 
            'limit' => $limit, 
            'post_ids' => $post_ids
        ],
    ));

    if( count($posts) <= 0) : ?>
        <div class="pxl-notification"><?php echo esc_html__( 'No Post Found', 'komestic' ); ?></div>;
        <?php return; ?>
    <?php endif;
    
    $title_tag = $widget->get_setting('title_tag', 'h6');
    $img_dimension = $widget->get_setting('img_dimension', 'custom');
    if($img_dimension === 'custom') {
        $custom_img_dimension = $widget->get_setting('custom_img_dimension', []);
        $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : ['width' => 767, 'height' => 472];
    }

    $entrance_anim = $widget->get_setting('entrance_anim', '');
    $anim_delay    = $widget->get_setting('anim_delay', 0);

    $show_author = (bool)$widget->get_setting('show_author', '');
    $show_date = (bool)$widget->get_setting('show_date', '');
    $show_tags = (bool)$widget->get_setting('show_tags', '');
    $show_button = (bool)$widget->get_setting('show_button', '');
    $show_excerpt = (bool)$widget->get_setting('show_excerpt', '');
    $num_of_words = $widget->get_setting('num_of_words', 16 );

    $title_hover = (bool)$settings['show_underline'] ? ' hover-underline-slide' : '';

    $featured_hover_style = $widget->get_setting('featured_hover_style', '');
    $img_displacement = get_template_directory_uri() . '/assets/images/displacement-'.$widget->get_setting('img_displacement', '1').'.webp';

    $layout_type = $widget->get_setting('layout_type', 'grid');

    $load_more = array(
        'layout_type'     => $layout_type,
        'layout'          => $layout,
        'tax'             => $tax,
        'post_type'       => $post_type,   
        'title_tag'       => $title_tag,
        'show_date'       => $show_date,
        'show_author'     => $show_author,
        'show_tags'       => $show_tags,
        'show_excerpt'    => $show_excerpt,
        'num_of_words'    => $num_of_words,
        'show_button'     => $show_button,
        'img_dimension'   => $img_dimension,
        'entrance_anim'   => $entrance_anim,
        'anim_delay'      => $anim_delay,
        'featured_hover_style' => $featured_hover_style,
        'img_displacement' => $img_displacement,
        'title_hover' => $title_hover,
    );
    if($layout_type === 'grid') : 
        $pagination = $widget->get_setting('grid_pagination', '');
        $load_more = array_merge(
            $load_more, 
            [
                'orderby'         => $orderby,
                'order'           => $order,
                'limit'           => $limit,
                'post_ids'        => $post_ids,
                'startPage'       => $paged,
                'maxPages'        => $max,
                'total'           => $total,
                'perpage'         => $limit,
                'nextLink'        => $next_link,
                'source'          => $source,
                'pagination'      => $pagination,
            ]
        );
        $wrap_attrs = [
            'class'            => 'grid post-grid pxl-posts',
            'data-start-page'  => $paged,
            'data-max-pages'   => $max,
            'data-total'       => $total,
            'data-perpage'     => $limit,
            'data-next-link'   => $next_link,
            'data-layout'      => '2',
        ];
        if (!empty($pagination)){
            $wrap_attrs['data-loadmore'] = json_encode($load_more);
        }
        $widget->add_render_attribute( 'wrapper', $wrap_attrs );
    ?>
    <div <?php pxl_print_html($widget->get_render_attribute_string('wrapper')) ?>>
        
        <div class="grid__inner">
            <?php komestic_get_post_template($posts, $load_more); ?>
        </div>
        <?php if ($pagination == 'pagination') : ?>
            <div class="pagination">
                <?php echo komestic()->page->get_pagination($query, true); ?>
            </div>
        <?php endif; 
        if (!empty($next_link) && $pagination === 'loadmore') : 
            $load_more_text = $widget->get_setting('load_more_text', 'Load More');
        ?>
            <div class="load-more">
                <button type="button" class="button button--load-more button--only-text">
                    <span class="button__loader">
                        <svg class="svg-loader" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.4999 2.32258C13.1413 2.32258 13.6612 1.80265 13.6612 1.16129C13.6612 0.519927 13.1413 0 12.4999 0C11.8586 0 11.3386 0.519927 11.3386 1.16129C11.3386 1.80265 11.8586 2.32258 12.4999 2.32258Z" fill="currentcolor"/>
                            <path d="M12.4999 24.0003C13.1413 24.0003 13.6612 23.4804 13.6612 22.839C13.6612 22.1977 13.1413 21.6777 12.4999 21.6777C11.8586 21.6777 11.3386 22.1977 11.3386 22.839C11.3386 23.4804 11.8586 24.0003 12.4999 24.0003Z" fill="currentcolor"/>
                            <path d="M7.08072 3.7552C7.72209 3.7552 8.24201 3.23527 8.24201 2.59391C8.24201 1.95254 7.72209 1.43262 7.08072 1.43262C6.43936 1.43262 5.91943 1.95254 5.91943 2.59391C5.91943 3.23527 6.43936 3.7552 7.08072 3.7552Z" fill="currentcolor"/>
                            <path d="M18.9258 20.8256C19.2355 21.3675 19.042 22.0643 18.5 22.4126C17.9581 22.7223 17.2613 22.5288 16.9129 21.9868C16.6033 21.4449 16.7968 20.7481 17.3387 20.3997C17.8807 20.0901 18.6162 20.2836 18.9258 20.8256Z" fill="currentcolor"/>
                            <path d="M3.6741 5.57427C4.21603 5.88395 4.40958 6.58072 4.09991 7.16137C3.79023 7.7033 3.09345 7.89685 2.51281 7.58718C1.97087 7.2775 1.77732 6.58072 2.087 6.00008C2.39668 5.41943 3.13216 5.26459 3.6741 5.57427Z" fill="currentcolor"/>
                            <path d="M22.4871 16.4124C23.029 16.7221 23.2226 17.4189 22.9129 17.9995C22.6032 18.5415 21.9064 18.735 21.3258 18.4253C20.7839 18.1157 20.5903 17.4189 20.9 16.8382C21.2097 16.2963 21.9064 16.1028 22.4871 16.4124Z" fill="currentcolor"/>
                            <path d="M1.66129 13.1614C2.30265 13.1614 2.82258 12.6415 2.82258 12.0002C2.82258 11.3588 2.30265 10.8389 1.66129 10.8389C1.01993 10.8389 0.5 11.3588 0.5 12.0002C0.5 12.6415 1.01993 13.1614 1.66129 13.1614Z" fill="currentcolor"/>
                            <path d="M23.3388 13.1614C23.9801 13.1614 24.5001 12.6415 24.5001 12.0002C24.5001 11.3588 23.9801 10.8389 23.3388 10.8389C22.6974 10.8389 22.1775 11.3588 22.1775 12.0002C22.1775 12.6415 22.6974 13.1614 23.3388 13.1614Z" fill="currentcolor"/>
                            <path d="M2.51291 16.4124C3.05485 16.1028 3.75162 16.2963 4.10001 16.8382C4.40969 17.3802 4.21614 18.077 3.67420 18.4253C3.13227 18.735 2.43549 18.5415 2.08711 17.9995C1.73872 17.4576 1.97098 16.7608 2.51291 16.4124Z" fill="currentcolor"/>
                            <path d="M21.3258 5.57455C21.8677 5.26487 22.5645 5.45842 22.9129 6.00036C23.2226 6.54229 23.029 7.23907 22.4871 7.58745C21.9452 7.89713 21.2484 7.70358 20.9 7.16165C20.5903 6.61971 20.7839 5.88423 21.3258 5.57455Z" fill="currentcolor"/>
                            <path d="M6.07431 20.8256C6.38398 20.2836 7.08076 20.0901 7.66140 20.3997C8.20334 20.7094 8.39689 21.4062 8.08721 21.9868C7.77753 22.5288 7.08076 22.7223 6.50011 22.4126C5.95818 22.0643 5.76463 21.3675 6.07431 20.8256Z" fill="currentcolor"/>
                            <path d="M16.9129 2.01305C17.2226 1.47112 17.9194 1.27757 18.5 1.58725C19.042 1.89692 19.2355 2.59370 18.9258 3.17434C18.6162 3.71628 17.9194 3.90983 17.3387 3.60015C16.7968 3.29047 16.6033 2.59370 16.9129 2.01305Z" fill="currentcolor"/>
                        </svg>
                    </span>
                    <div class="button__blobs">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <span class="button__text">
                        <?php echo esc_html($load_more_text); ?>
                    </span>
                </button>
            </div>
        <?php endif; ?>
    </div>
<?php else: 
    wp_enqueue_script('komestic-swiper');
    $allow_touch_move = $widget->get_setting('allow_touch_move', '');
    $autoplay = $widget->get_setting('autoplay', false);
    $disable_on_interaction = $widget->get_setting('disable_on_interaction', false);
    $delay = $widget->get_setting('delay', 5000);
    $loop  = $widget->get_setting('loop', false);
    $speed = $widget->get_setting('speed', 500);
    $pagination = $widget->get_setting('swiper_pagination', '');
    $navigation = (bool)$widget->get_setting('swiper_navigation', false);
    $custom_slides = (bool)$widget->get_setting('custom_slides', '');
    $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 3);
    $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 3);
    $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 3);
    $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 3);
    $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 3);
    $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 3);
    $swiper_params = [
        'effect'                 => 'slide',
        'direction'              => 'vertical',
        'allow_touch_move'       => (bool)$allow_touch_move,
        'autoplay'               => (bool)$autoplay,
        'disable_on_interaction' => (bool)$disable_on_interaction,
        'delay'                  => $delay,
        'loop'                   => (bool)$loop,
        'speed'                  => $speed,
        'pagination'             => $pagination,
        'navigation'             => $navigation,
        'space_between'          => 0,
        'slides_per_view_xs'     => (int)$slides_per_view_xs,
        'slides_per_view_sm'     => (int)$slides_per_view_sm,
        'slides_per_view_md'     => (int)$slides_per_view_md,
        'slides_per_view_lg'     => (int)$slides_per_view_lg,
        'slides_per_view_xl'     => (int)$slides_per_view_xl,
        'slides_per_view_xxl'    => (int)$slides_per_view_xxl,
    ];
    $swiper_params = json_encode($swiper_params); 
    $swiper_boxshadow = $widget->get_setting('slide_boxshadow', 'swiper-normal');
    $swiper_navigation_icon_prev = $widget->get_setting('swiper_navigation_icon_prev', []);
    $swiper_navigation_icon_next = $widget->get_setting('swiper_navigation_icon_next', []);
    $nav_widget_id = $widget->get_setting('nav_widget_id', '');
    $navigation_hidden_class = !empty($nav_widget_id) ? 'swiper-navigation-hidden' : null;
?>
    <div class="pxl-swiper pxl-posts pxl-post-carousel <?php echo esc_attr($swiper_boxshadow); ?>" data-layout="2">
        <div class="swiper-inner">
            <div class="swiper-container" data-swiper = "<?php echo esc_attr($swiper_params); ?>">
                <div class="swiper-wrapper">
                    <?php komestic_get_post_template($posts, $load_more); ?>
                </div>
                <?php if(!empty($pagination)) : ?>
                    <div class="swiper-pagination"></div>
                <?php endif; ?>
                <?php if($navigation) : ?>
                    <div class="swiper-navigation <?php echo esc_attr($navigation_hidden_class); ?>" <?php if(!empty($nav_widget_id)) : ?> data-navigation-id="<?php echo esc_attr($nav_widget_id); ?>" <?php endif; ?>>
                        <div class="pxl-swiper-button swiper-button-prev <?php echo esc_attr($swiper_btn_hover_style); ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $swiper_btn_icon_prev, [ 'aria-hidden' => 'true', 'class' => 'pxl-button-icon' ], 'i' ); ?>
                        </div>
                        <div class="pxl-swiper-button swiper-button-next <?php echo esc_attr($swiper_btn_hover_style); ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $swiper_btn_icon_next, [ 'aria-hidden' => 'true', 'class' => 'pxl-button-icon' ], 'i' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif;
