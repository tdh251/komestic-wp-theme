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
        $img_dimension = (!empty($custom_img_dimension['width']) && !empty($custom_img_dimension['height'])) ? $custom_img_dimension : ['width' => 576, 'height' => 413];
    }

    $entrance_anim = $widget->get_setting('entrance_anim', '');
    $anim_delay    = $widget->get_setting('anim_delay', 0);

    $show_author = (bool)$widget->get_setting('show_author', '');
    $show_date = (bool)$widget->get_setting('show_date', '');
    $show_category = (bool)$widget->get_setting('show_category', '');

    $featured_hover_style = $widget->get_setting('featured_hover_style', '');
    $img_displacement = get_template_directory_uri() . '/assets/images/displacement-'.$widget->get_setting('img_displacement', '1').'.webp';

    $title_hover = (bool)$settings['show_underline'] ? ' hover-underline-slide' : '';

    $layout_type = $widget->get_setting('layout_type', 'grid');

    $load_more = array(
        'layout_type'     => $layout_type,
        'layout'          => $layout,
        'tax'             => $tax,
        'post_type'       => $post_type,   
        'title_tag'       => $title_tag,
        'show_date'       => $show_date,
        'show_author'     => $show_author,
        'show_category'       => $show_category,
        'img_dimension'   => $img_dimension,
        'entrance_anim'   => $entrance_anim,
        'anim_delay'      => $anim_delay,
        'featured_hover_style' => $featured_hover_style,
        'img_displacement' => $img_displacement,
        'title_hover' => $title_hover
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
            'data-layout'      => '3',
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
                    <?php get_template_part( 'template-parts/button/button', 'loadmore', ['load_more_text' => $load_more_text] );  ?>
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
    $space_between = $widget->get_setting('space_between', 0);
    $pagination = $widget->get_setting('swiper_pagination', '');
    $navigation = (bool)$widget->get_setting('swiper_navigation', false);
    $custom_slides = (bool)$widget->get_setting('custom_slides', '');
    $slides_per_view_xs  = $widget->get_setting('slides_per_view_xs', 1);
    $slides_per_view_sm  = $widget->get_setting('slides_per_view_sm', 2);
    $slides_per_view_md  = $widget->get_setting('slides_per_view_md', 2);
    $slides_per_view_lg  = $widget->get_setting('slides_per_view_lg', 2);
    $slides_per_view_xl  = $widget->get_setting('slides_per_view_xl', 3);
    $slides_per_view_xxl = $widget->get_setting('slides_per_view_xxl', 3);

    $swiper_params = [
        'effect'                 => 'slide',
        'allow_touch_move'       => (bool)$allow_touch_move,
        'autoplay'               => (bool)$autoplay,
        'disable_on_interaction' => (bool)$disable_on_interaction,
        'delay'                  => $delay,
        'loop'                   => (bool)$loop,
        'speed'                  => $speed,
        'pagination'             => $pagination,
        'navigation'             => $navigation,
        'space_between'          => $space_between,
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
    <div class="pxl-swiper pxl-posts pxl-post-carousel <?php echo esc_attr($swiper_boxshadow); ?>" data-layout="3">
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
