<?php 
if(!function_exists('komestic_get_theme_setting')){
    function komestic_get_theme_setting($key){
        $configs = [
            'theme_colors' => [
                'primary'   => [
                    'title' => esc_html__('Primary', 'komestic'), 
                    'value' => komestic()->get_opt('color_primary', '#FF6333')
                ],
                'secondary'   => [
                    'title' => esc_html__('Secondary', 'komestic'), 
                    'value' => komestic()->get_opt('color_secondary', '#EDDD5E')
                ],
                'tertiary'   => [
                    'title' => esc_html__('Third', 'komestic'), 
                    'value' => komestic()->get_opt('color_tertiary', '#252525')
                ],
            ],
            'gradient' => [
                'from' => komestic()->get_opt('color_gradient', ['from' => '#6000ff'])['from'],
                'to' => komestic()->get_opt('color_gradient', ['to' => '#fe0054'])['to'],
            ],
            'theme_typography' => [
                'primary' => [
                    'title' => esc_html__('Primary', 'komestic'),
                    'value' => komestic()->get_opt('font_primary', 'DM Sans')
                ],
                'secondary' => [
                    'title' => esc_html__('Secondary', 'komestic'),
                    'value' => komestic()->get_opt('font_secondary', 'Syne')
                ],
                'tertiary' => [
                    'title' => esc_html__('Tertiary', 'komestic'),
                    'value' => komestic()->get_opt('font_tertiary', 'Open Sans')
                ],
                'tertiary' => [
                    'title' => esc_html__('Tertiary', 'komestic'),
                    'value' => komestic()->get_opt('font_tertiary', 'Open Sans')
                ],
                'quaternary' => [
                    'title' => esc_html__('Quaternary', 'komestic'),
                    'value' => komestic()->get_opt('font_quaternary', 'Playfair Display')
                ],
                'heading' => [
                    'title' => esc_html__('Heading', 'komestic'),
                    'value' => komestic()->get_opt('font_heading', 'DM Sans')
                ],
            ]
        ];
        return $configs[$key];
    }
}
if(!function_exists('komestic_generate_inline_style')) {
    function komestic_generate_inline_style() {  
        $theme_colors      = komestic_get_theme_setting('theme_colors');
        $color_gradient    = komestic_get_theme_setting('gradient');
        $theme_typography  = komestic_get_theme_setting('theme_typography');
        ob_start();
        echo ':root{';
            foreach ($theme_colors as $color => $value) {
                printf('--color-%1$s: %2$s;', str_replace('#', '',$color),  $value['value']);
            }
            foreach ($color_gradient as $color => $value) {
                printf('--color-%1$s: %2$s;', $color, $value);
            }
            foreach ($theme_typography as $font => $value) {
                $font_family = is_array($value['value']) ? $value['value']['font-family'] : $value['value'];
                printf('--font-%1$s: %2$s;', str_replace('#', '',$font),  $font_family);
            }
        echo '}';

        return ob_get_clean();
    }
}
 
/**
 * Custom Comment List
 */
function komestic_comment_list( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    $comment_class = 'comment__item';
    $comment_class .= empty($args['has_children']) ? ' comment__item--single' : ' comment__item--parent'
    ?>
    <<?php echo ''.$tag ?> id="comment-<?php comment_ID() ?>"  <?php comment_class($comment_class); ?>>
        <div class="comment__item-inner">
            <div class="comment__item-user">
                <?php if ($args['avatar_size'] != 0) : ?> 
                    <div class="comment__user-avatar">
                        <?php echo get_avatar($comment, 90); ?>
                    </div>
                <?php endif; ?>
                <div class="comment__user-group">
                    <div class="comment__user-name">
                        <?php printf( '%s', get_comment_author_link() ); ?>
                    </div>
                    <div class="comment__item-date">
                        <?php echo get_comment_date('d F Y'); ?>
                    </div>
                </div>
            </div>
            <div class="comment__item-content"><?php comment_text(); ?></div>
            <div class="comment__item-reply">
                <?php comment_reply_link( array_merge( $args, array(
                    'add_below' => $add_below,
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'reply_text' => esc_html__('Reply', 'komestic'),
                ))); ?>
            </div>
        </div>
    <?php
}

/**
 * Search Form Mobile
*/
function komestic_mobile_search_form() { 
    ?>
        <form class="search-form" role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
            <input type="text" placeholder="<?php echo esc_attr('Search here...', 'komestic') ?>" name="s" class="search-field" />
            <button type="submit" class="search-submit">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.8906 13.5742C14.0273 13.7109 14.0273 13.9297 13.8906 14.0391L13.2617 14.668C13.1523 14.8047 12.9336 14.8047 12.7969 14.668L9.48828 11.3594C9.43359 11.2773 9.40625 11.1953 9.40625 11.1133V10.7578C8.39453 11.6055 7.10938 12.125 5.6875 12.125C2.54297 12.125 0 9.58203 0 6.4375C0 3.32031 2.54297 0.75 5.6875 0.75C8.80469 0.75 11.375 3.32031 11.375 6.4375C11.375 7.85938 10.8281 9.17188 9.98047 10.1562H10.3359C10.418 10.1562 10.5 10.2109 10.582 10.2656L13.8906 13.5742ZM5.6875 10.8125C8.09375 10.8125 10.0625 8.87109 10.0625 6.4375C10.0625 4.03125 8.09375 2.0625 5.6875 2.0625C3.25391 2.0625 1.3125 4.03125 1.3125 6.4375C1.3125 8.87109 3.25391 10.8125 5.6875 10.8125Z" fill="currentcolor"/>
                </svg>
            </button>
        </form>
    <?php
}

/**
 * Custom Widget Tag Cloud
*/
function custom_tag_cloud_args($args) {
    $args['format'] = 'flat'; 
    $args['separator'] = ' / '; 
    return $args;
}
add_filter('widget_tag_cloud_args', 'custom_tag_cloud_args');
function custom_tag_cloud_add_hash($tag_cloud) {    
    $tag_cloud = str_replace('<a ', '<a class="tag-cloud__link" ', $tag_cloud);
    $tag_cloud = str_replace('</a>', '</a>', $tag_cloud);
    $tag_cloud = preg_replace_callback(
        '#<a.+?>(.+?)<\/a>#',
        function ($matches) {
            return str_replace($matches[1], '#' . $matches[1], $matches[0]);
        },
        $tag_cloud
    );

    return $tag_cloud;
}
add_filter('wp_tag_cloud', 'custom_tag_cloud_add_hash');


/* Search Result  */
function komestic_custom_post_types_in_search_results( $query ) {
    if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
        $query->set( 'post_type', array( 'post', 'product' ) );
    }
}
add_action( 'pre_get_posts', 'komestic_custom_post_types_in_search_results' );