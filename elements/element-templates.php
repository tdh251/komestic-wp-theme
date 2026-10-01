<?php 
 
if(!function_exists('komestic_get_post_template')){
    function komestic_get_post_template($posts = [], $settings = []){ 
        if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
            return false;
        }
        switch ($settings['layout']) {
            case 'post-1':
                komestic_get_post_layout1($posts, $settings);
                break;
            case 'post-2':
                komestic_get_post_layout2($posts, $settings);
                break;
            case 'post-3':
                komestic_get_post_layout3($posts, $settings);
                break;
            case 'product-1':
                komestic_get_product_layout1($posts, $settings);
                break;
            default:
                return false;
                break;
        }
    }
}

// Post
function komestic_get_post_layout1($posts = [], $settings = []){ 
    extract($settings);
    $item_class = ($layout_type == 'carousel') ? 'swiper-slide' : 'grid__item';
    $item_class .= ' '.$entrance_anim;
    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $filter_class = !empty($tax) ? pxl_get_term_of_post_to_class($post->ID, array_unique($tax)) : '';
            $featured_image_html = komestic_get_image_by_size([
                'img_dimension' => ($show_item_first == 'true' && $key == 0) ? ['width' => 759, 'height' => 395] : $img_dimension ,
                'attr' => [
                    'class' => 'pxl-image',
                ],
            ], $post->ID);
            $author_id = get_post_field ('post_author', $post->ID);
            $author_name = get_the_author_meta('display_name', $author_id);
            $author_link = get_author_posts_url($author_id);
            $tags = get_the_tags($post->ID);
        ?>
            <div class="<?php echo esc_attr($item_class); if($show_item_first == 'true' && $key == 0) {echo 'is-item-first';} ?>">
                <div class="post">
                    <div class="post__inner">
                        <?php if(!is_null($featured_image_html)) : ?>
                            <div class="post__featured <?php echo esc_attr($featured_hover_style); ?>" <?php if($featured_hover_style == 'image--distortion-transition'): ?> data-displacement="<?php echo esc_url($img_displacement); ?>" <?php endif; ?>>
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                    <?php echo wp_kses_post($featured_image_html); ?>
                                </a>
                                <?php if($tags && $show_tags == 'true') : ?>
                                    <div class="post__tags">
                                        <?php foreach($tags as $tag) :?>
                                            <?php pxl_print_html('
                                            <a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="button button--only-text post__tag">
                                                <div class="button__blobs">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                                <span class="button__text">#' . esc_html( $tag->name ) . '</span>
                                            </a>') ?>
                                        <?php endforeach; ?>
                                    </div>
                               <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="post__content">
                            <?php if($show_author == 'true' || $show_date == 'true') : ?>
                                <div class="post__meta">
                                    <?php if($show_author == 'true') : ?>
                                        <div class="post__author">
                                            <div class="post__author-avatar">
                                                <?php echo get_avatar($author_id); ?>
                                            </div>
                                            <a href="<?php echo esc_url($author_link); ?>" class="post__author-name post__meta-info">
                                                <?php echo esc_html($author_name); ?>
                                            </a>
                                        </div>
                                        <span class="post__meta-divider"></span>
                                    <?php endif; ?>
                                    <?php if($show_date == 'true') : ?>
                                        <span class="post__date post__meta-info">
                                            <?php echo esc_attr(get_the_date('d F Y')); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <<?php echo esc_attr($title_tag); ?> class="post__title">
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="title-link<?php echo esc_attr($title_hover); ?>">
                                    <?php echo esc_html(get_the_title($post->ID)); ?>
                                </a>
                            </<?php echo esc_attr($title_tag); ?>>
                            <?php if($show_excerpt == 'true') : ?>
                                <p class="post__excerpt">
                                    <?php echo wp_trim_words( $post->post_excerpt, $num_of_words, $more = null); ?>
                                </p>
                            <?php endif; ?>
                            <?php if($show_button == 'true') : ?>
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="button button--link-underline post__button">
                                    <span class="button__text">
                                        <?php echo esc_html($button_text); ?>
                                    </span>
                                    <span class="button__icon">
                                        <svg class="button__icon--main" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10">
                                            <path d="M2.72017 0.252869L2.72037 0.809018C2.7204 0.876074 2.74705 0.940376 2.79446 0.987792C2.84188 1.03521 2.90618 1.06186 2.97324 1.06189L8.18722 1.06178L0.073992 9.17501C0.0265952 9.22247 -1.9048e-05 9.2868 1.02285e-08 9.35386C1.90685e-05 9.42093 0.0266696 9.48524 0.0740934 9.53267L0.467422 9.926C0.56611 10.0247 0.726286 10.0247 0.825076 9.9259L8.93831 1.81266L8.9381 7.02695C8.93813 7.09401 8.96478 7.15831 9.0122 7.20573C9.05961 7.25315 9.12391 7.2798 9.19097 7.27982L9.74712 7.27982C9.81418 7.2798 9.87848 7.25315 9.92589 7.20573C9.97331 7.15831 9.99996 7.09401 9.99999 7.02695L10.0001 0.252869C10.0001 0.185813 9.97341 0.121511 9.92599 0.0740953C9.87858 0.0266786 9.81428 2.81812e-05 9.74722 5.2761e-07L2.97303 1.77739e-06C2.90598 2.94369e-05 2.84168 0.0266789 2.79426 0.0740956C2.74684 0.121511 2.72019 0.185814 2.72017 0.252869Z" fill="currentcolor"/>
                                        </svg>
                                        <svg class="button__icon--copy" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10">
                                            <path d="M2.72017 0.252869L2.72037 0.809018C2.7204 0.876074 2.74705 0.940376 2.79446 0.987792C2.84188 1.03521 2.90618 1.06186 2.97324 1.06189L8.18722 1.06178L0.073992 9.17501C0.0265952 9.22247 -1.9048e-05 9.2868 1.02285e-08 9.35386C1.90685e-05 9.42093 0.0266696 9.48524 0.0740934 9.53267L0.467422 9.926C0.56611 10.0247 0.726286 10.0247 0.825076 9.9259L8.93831 1.81266L8.9381 7.02695C8.93813 7.09401 8.96478 7.15831 9.0122 7.20573C9.05961 7.25315 9.12391 7.2798 9.19097 7.27982L9.74712 7.27982C9.81418 7.2798 9.87848 7.25315 9.92589 7.20573C9.97331 7.15831 9.99996 7.09401 9.99999 7.02695L10.0001 0.252869C10.0001 0.185813 9.97341 0.121511 9.92599 0.0740953C9.87858 0.0266786 9.81428 2.81812e-05 9.74722 5.2761e-07L2.97303 1.77739e-06C2.90598 2.94369e-05 2.84168 0.0266789 2.79426 0.0740956C2.74684 0.121511 2.72019 0.185814 2.72017 0.252869Z" fill="currentcolor"/>
                                        </svg>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;
    endif;
}

function komestic_get_post_layout2($posts = [], $settings = []){ 
    extract($settings);
    $item_class = ($layout_type == 'carousel') ? 'swiper-slide' : 'grid__item';
    $item_class .= ' '.$entrance_anim;
    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $featured_image_html = komestic_get_image_by_size([
                'img_dimension' => $img_dimension ,
                'attr' => [
                    'class' => 'pxl-image',
                ],
            ], $post->ID);
            $author_id = get_post_field ('post_author', $post->ID);
            $author_name = get_the_author_meta('display_name', $author_id);
            $author_link = get_author_posts_url($author_id);
        ?>
            <div class="<?php echo esc_attr($item_class); ?>">
                <div class="post">
                    <div class="post__inner">
                        <?php if(!is_null($featured_image_html)) : ?>
                            <div class="post__featured <?php echo esc_attr($featured_hover_style); ?>" <?php if($featured_hover_style == 'image--distortion-transition'): ?> data-displacement="<?php echo esc_url($img_displacement); ?>" <?php endif; ?>>
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                    <?php echo wp_kses_post($featured_image_html); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="post__main">
                            <?php if($show_author || $show_date) : ?>
                                <div class="post__meta">
                                    <div class="post__meta-group">
                                        <?php if($show_date) : ?>
                                            <span class="post__date">
                                                <?php echo esc_attr(get_the_date('d.m.Y')); ?>
                                            </span>
                                            <span class="separator"><?php esc_html_e('/', 'komestic'); ?></span>
                                        <?php endif; ?>
                                        <?php if($show_author) : ?>
                                            <a href="<?php echo esc_url($author_link); ?>" class="post__author">
                                                <?php echo esc_html($author_name); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="post__category">
                                        <?php the_terms($post->ID, 'category', '', '') ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="post__bottom">
                                <div class="post__content">
                                    <<?php echo esc_attr($title_tag); ?> class="post__title">
                                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="post__link<?php echo esc_attr($title_hover); ?>">
                                            <?php echo esc_html(get_the_title($post->ID)); ?>
                                        </a>
                                    </<?php echo esc_attr($title_tag); ?>>
                                    <?php if($show_excerpt) : ?>
                                        <p class="post__excerpt">
                                            <?php echo wp_trim_words( $post->post_excerpt, $num_of_words, $more = null); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <?php if($show_button) : ?>
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="pxl-button post__button">
                                        <svg class="icon icon--main" xmlns="http://www.w3.org/2000/svg" width="38" height="32" viewBox="0 0 38 32" fill="none">
                                            <path d="M22.8 0.799805L20.14 3.4598L30.78 14.0998H0V17.8998H30.78L20.14 28.5398L22.8 31.1998L38 15.9998L22.8 0.799805Z" fill="black"/>
                                        </svg>
                                        <svg class="icon icon--copy" xmlns="http://www.w3.org/2000/svg" width="38" height="32" viewBox="0 0 38 32" fill="none">
                                            <path d="M22.8 0.799805L20.14 3.4598L30.78 14.0998H0V17.8998H30.78L20.14 28.5398L22.8 31.1998L38 15.9998L22.8 0.799805Z" fill="black"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;
    endif;
}

function komestic_get_post_layout3($posts = [], $settings = []){ 
    extract($settings);
    $item_class = ($layout_type == 'carousel') ? 'swiper-slide' : 'grid__item';
    $item_class .= ' '.$entrance_anim;
    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $featured_image_html = komestic_get_image_by_size([
                'img_dimension' => $img_dimension ,
                'attr' => [
                    'class' => 'pxl-image',
                ],
            ], $post->ID);
            $author_id = get_post_field ('post_author', $post->ID);
            $author_name = get_the_author_meta('display_name', $author_id);
            $author_link = get_author_posts_url($author_id);
        ?>
            <div class="<?php echo esc_attr($item_class); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                <div class="post">
                    <div class="post__inner">
                        <?php if(!is_null($featured_image_html)) : ?>
                            <div class="post__featured <?php echo esc_attr($featured_hover_style); ?>" <?php if($featured_hover_style == 'image--distortion-transition'): ?> data-displacement="<?php echo esc_url($img_displacement); ?>" <?php endif; ?>>
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                    <?php echo wp_kses_post($featured_image_html); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="post__main">
                            <?php if($show_author || $show_date) : ?>
                                <div class="post__meta">
                                    <?php if($show_date) : ?>
                                        <span class="post__date">
                                            <?php echo esc_attr(get_the_date('d.m.Y')); ?>
                                        </span>
                                        <span class="separator"><?php esc_html_e('/', 'komestic'); ?></span>
                                    <?php endif; ?>
                                    <?php if($show_author) : ?>
                                        <a href="<?php echo esc_url($author_link); ?>" class="post__author">
                                            <?php echo esc_html('By '.$author_name); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <<?php echo esc_attr($title_tag); ?> class="post__title">
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="post__link<?php echo esc_attr($title_hover); ?>">
                                    <?php echo esc_html(get_the_title($post->ID)); ?>
                                </a>
                            </<?php echo esc_attr($title_tag); ?>>
                            <?php //if($show_category) : ?>
                                <div class="post__category category">
                                    <?php the_terms($post->ID, 'category', '', '') ?>
                                </div>
                            <?php //endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;
    endif;
}

// Product
if ( class_exists( 'WooCommerce' ) ) {
    function komestic_get_product_layout1($posts = [], $settings = []){ 
        extract($settings);
        $gift_package_id = komestic()->get_theme_opt('gift_package', '');
        $item_class = ($layout_type == 'grid') ? "grid__item {$entrance_anim}" : "swiper-slide {$entrance_anim}";
        if (is_array($posts)):
            foreach ($posts as $key => $post) :
                global $product;
                $product = wc_get_product($post->ID);
                $filter_class = isset($tax) ? ' '.pxl_get_term_of_post_to_class($post->ID, array_unique($tax)) : '';
                if($gift_package_id == $post->ID) continue;
            ?>
                <div class="<?php echo esc_attr($item_class.$filter_class); ?>"
                <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
                    <div class="product" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
                        <?php 
                        wc_get_template(
                        'template-parts/woocommerce/content-product/default.php',
                            array(
                                'product'  => $product,
                                'img_dimension' => $img_dimension,
                            ),
                        );  
                        ?>
                    </div>
                </div>
            <?php endforeach;
        endif;
    }
}


// Ajax Posts
add_action( 'wp_ajax_komestic_load_more_post_grid', 'komestic_load_more_post_grid' );
add_action( 'wp_ajax_nopriv_komestic_load_more_post_grid', 'komestic_load_more_post_grid' );
function komestic_load_more_post_grid(){
    try{
        if(!isset($_POST['settings'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'komestic'));
        }
    
        $settings = isset($_POST['settings']) ? $_POST['settings'] : null;


        $source = isset($settings['source']) ? $settings['source'] : '';
        $term_slug = isset($settings['term_slug']) ? $settings['term_slug'] : '';
        if( !empty($term_slug) && $term_slug !='*'){
            $term_slug = str_replace('.', '', $term_slug);
            $source = [$term_slug.'|'.$settings['tax'][0]]; 
        }
        if( isset($_POST['handler_click']) && sanitize_text_field(wp_unslash( $_POST[ 'handler_click' ] )) == 'filter'){
            set_query_var('paged', 1);
            $settings['paged'] = 1;
        }else{
            set_query_var('paged', $settings['paged']);
        }
        extract(pxl_get_posts_of_grid($settings['post_type'], [
                'source' => $source,
                'orderby' => isset($settings['orderby'])?$settings['orderby']:'date',
                'order' => isset($settings['order'])?$settings['order']:'desc',
                'limit' => isset($settings['limit'])?$settings['limit']:'6',
                'post->IDs' => isset($settings['post->IDs'])?$settings['post->IDs']: [],
                'post_not_in' => isset($settings['post_not_in'])?$settings['post_not_in']: [],
            ],
            $settings['tax']
        ));

        ob_start();
            komestic_get_post_template($posts, $settings);
        $html = ob_get_clean();

        $pagin_html = '';
        if( isset($settings['pagination']) && $settings['pagination'] == 'pagination' ){ 
            ob_start();
            echo komestic()->page->get_pagination( $query,  true );
            $pagin_html = ob_get_clean();
        }
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'komestic'),
                'data' => array(
                    'html' => $html,
                    'pagin_html' => $pagin_html,
                    'paged' => $settings['paged'],
                    'posts' => $posts,
                    'max' => $max,
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}
