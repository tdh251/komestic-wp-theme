<?php
/**
 * @package Case-Themes
 */
?>
<?php
    $post_id = get_the_ID();
    $show_author = komestic()->get_theme_opt('blog_show_aut$show_author', 'true');
    $show_reading_time = komestic()->get_theme_opt('blog_show_reading_time', 'true');
    $show_comment = komestic()->get_theme_opt('blog_show_comment', 'true');
    $show_excerpt = komestic()->get_theme_opt('blog_show_excerpt', 'true');    
    $num_of_words = komestic()->get_theme_opt('blog_excerpt_num_of_words', 50);
    $show_button = komestic()->get_theme_opt('blog_show_button', 'true');
    $button_text = komestic()->get_theme_opt('blog_button_text', esc_html__('Read More', 'komestic'));
    $featured_image = komestic_get_image_by_size([
        'img_dimension' => 'full',
        'attr' => [
            'class' => 'pxl-image',
        ],
    ], $post_id);
    $author_id = get_post_field ('post_author', $post_id);
    $comment_count = (get_comments_number($post_id) < 10 && get_comments_number($post_id) != 0) ? '0'.get_comments_number($post_id) : get_comments_number($post_id);
    $post_content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($post_content));
    $reading_time = ceil($word_count / 200);
    $post_featured_type = get_post_meta($post_id, 'post_featured_type', true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl-post-standard pxl-post pxl-post-layout1'); ?>>
    <div class="pxl-post-item">
        <?php if($post_featured_type == 'video') : 
            $video_link = get_post_meta($post_id, 'post_video_link', true);
        ?>
            <div class="pxl-post-featured">
                <a href="<?php echo esc_url($video_link); ?>" class="pxl-featured-link pxl-action-popup">
                    <?php echo wp_kses_post($featured_image); ?>
                </a>
                <a href="<?php echo esc_url($video_link); ?>" class="pxl-button-play-video pxl-action-popup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 20 24" fill="none">
                        <path d="M19.4806 11.1317C20.1524 11.5156 20.1524 12.4843 19.4806 12.8682L1.49614 23.1451C0.829484 23.526 9.00035e-07 23.0446 9.33598e-07 22.2768L1.83203e-06 1.72318C1.86559e-06 0.955355 0.829485 0.473988 1.49614 0.854934L19.4806 11.1317Z" fill="currentcolor"/>
                    </svg>
                </a>
            </div>
        <?php elseif($post_featured_type == 'carousel') : 
            $gallery_images = get_post_meta($post_id, 'post_gallery_images', true);
            if(!empty($gallery_images)) :
                $image_arr = explode(',', $gallery_images);
        ?>
                <div class="pxl-carousel pxl-post-featured">
                    <div class="carousel-inner">
                        <div class="carousel-item item-featured active">
                            <?php echo wp_kses_post($featured_image); ?>
                        </div>
                        <?php foreach($image_arr as $image_id) : 
                            $gallery_image = komestic_get_image_by_size([
                                'img_id' => $image_id,
                                'img_dimension' => ['width' => 869, 'height' => 462],
                                'attr' => [
                                    'class' => 'pxl-image',
                                ],
                            ]);
                        ?>
                            <div class="carousel-item">
                                <?php echo wp_kses_post($gallery_image); ?>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <div class="carousel-navigation">
                        <div class="navigation-button navigation-button-prev">
                            <svg width="37" height="37" viewBox="0 0 37 37" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.24454 19.093L8.65344 27.502C8.9555 27.8547 9.48636 27.8958 9.83908 27.5937C10.1918 27.2916 10.2329 26.7607 9.93078 26.408C9.9026 26.3751 9.87196 26.3444 9.83908 26.3163L2.8681 19.3369L36.1591 19.3369C36.6235 19.3369 37 18.9604 37 18.4959C37 18.0315 36.6235 17.6551 36.1591 17.6551L2.8681 17.6551L9.83908 10.6841C10.1918 10.382 10.2329 9.85117 9.93078 9.49844C9.62864 9.14572 9.09786 9.1046 8.74514 9.40674C8.71226 9.43492 8.68155 9.46556 8.65344 9.49844L0.244468 17.9074C-0.0815171 18.2353 -0.0815171 18.765 0.24454 19.093Z" fill="currentcolor"/>
                            </svg>
                        </div>
                        <div class="navigation-button navigation-button-next">
                            <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M36.7555 17.907L28.3466 9.49805C28.0445 9.14532 27.5136 9.10421 27.1609 9.40634C26.8082 9.70841 26.7671 10.2393 27.0692 10.592C27.0974 10.6249 27.128 10.6556 27.1609 10.6837L34.1319 17.6631H0.840868C0.376497 17.6631 0 18.0396 0 18.5041C0 18.9685 0.376497 19.3449 0.840868 19.3449H34.1319L27.1609 26.3159C26.8082 26.618 26.7671 27.1488 27.0692 27.5016C27.3714 27.8543 27.9021 27.8954 28.2549 27.5933C28.2877 27.5651 28.3185 27.5344 28.3466 27.5016L36.7555 19.0926C37.0815 18.7647 37.0815 18.235 36.7555 17.907Z" fill="currentcolor"/>
                            </svg>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="pxl-box-link"></a>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="pxl-post-featured">
                <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="pxl-featured-link">
                    <?php echo wp_kses_post($featured_image); ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="pxl-post-meta">
            <?php if($show_author == 'true') : ?>
                <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="pxl-post-author meta-info">
                    <svg class="meta-icon" width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.5 10.2381C11.5312 10.2381 14 12.7068 14 15.7381C14 16.3006 13.5312 16.7381 13 16.7381H1C0.4375 16.7381 0 16.3006 0 15.7381C0 12.7068 2.4375 10.2381 5.5 10.2381H8.5ZM1.5 15.2381H12.4688C12.2188 13.2693 10.5312 11.7381 8.5 11.7381H5.5C3.4375 11.7381 1.75 13.2693 1.5 15.2381ZM7 8.7381C4.78125 8.7381 3 6.95685 3 4.7381C3 2.5506 4.78125 0.738098 7 0.738098C9.1875 0.738098 11 2.5506 11 4.7381C11 6.95685 9.1875 8.7381 7 8.7381ZM7 2.2381C5.59375 2.2381 4.5 3.3631 4.5 4.7381C4.5 6.14435 5.59375 7.2381 7 7.2381C8.375 7.2381 9.5 6.14435 9.5 4.7381C9.5 3.3631 8.375 2.2381 7 2.2381Z" fill="currentcolor"/>
                    </svg>
                    <span class="pxl-author-name meta-text">
                        <?php echo esc_attr(get_the_author_meta('display_name', $author_id)); ?>
                    </span>
                </a>
            <?php endif; ?>
            <?php if($show_comment == 'true') : ?>
                <span class="pxl-post-comment meta-info">
                    <svg class="meta-icon" width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.1289 2.74068C9.24249 2.39409 8.28938 2.2208 7.26962 2.2208C6.24986 2.2208 5.29675 2.39409 4.41029 2.74068C3.52383 3.08726 2.81733 3.55715 2.29079 4.15035C1.77091 4.74354 1.51097 5.38006 1.51097 6.0599C1.51097 6.60644 1.6876 7.13298 2.04085 7.63953C2.3941 8.14608 2.89065 8.58597 3.5305 8.95922L4.50027 9.51909L4.15035 10.3589C4.37696 10.2256 4.58358 10.0956 4.77021 9.96898L5.2101 9.65906L5.73998 9.75903C6.25986 9.85234 6.76974 9.899 7.26962 9.899C8.28938 9.899 9.24249 9.72571 10.1289 9.37912C11.0154 9.03254 11.7186 8.56265 12.2385 7.96945C12.765 7.37626 13.0283 6.73974 13.0283 6.0599C13.0283 5.38006 12.765 4.74354 12.2385 4.15035C11.7186 3.55715 11.0154 3.08726 10.1289 2.74068ZM3.73045 1.63094C4.81686 1.17105 5.99658 0.941102 7.26962 0.941102C8.54265 0.941102 9.71904 1.17105 10.7988 1.63094C11.8852 2.08417 12.7417 2.70402 13.3682 3.4905C13.9947 4.27699 14.308 5.13345 14.308 6.0599C14.308 6.98635 13.9947 7.84282 13.3682 8.6293C12.7417 9.41578 11.8852 10.039 10.7988 10.4989C9.71904 10.9521 8.54265 11.1787 7.26962 11.1787C6.69642 11.1787 6.10989 11.1254 5.51003 11.0187C4.68356 11.6053 3.75711 12.0318 2.73068 12.2984C2.49074 12.3584 2.20414 12.4117 1.87089 12.4584H1.84089C1.76758 12.4584 1.69759 12.4317 1.63094 12.3784C1.57096 12.3251 1.5343 12.2551 1.52097 12.1685C1.5143 12.1485 1.51097 12.1285 1.51097 12.1085C1.51097 12.0818 1.51097 12.0585 1.51097 12.0385C1.51764 12.0185 1.5243 11.9985 1.53097 11.9785C1.5443 11.9585 1.55429 11.9419 1.56096 11.9285C1.56762 11.9152 1.57762 11.8985 1.59095 11.8785C1.61095 11.8519 1.62428 11.8352 1.63094 11.8285C1.64427 11.8152 1.66093 11.7986 1.68093 11.7786C1.70093 11.7519 1.71426 11.7352 1.72092 11.7286C1.75425 11.6886 1.83089 11.6053 1.95087 11.4786C2.07084 11.352 2.15748 11.2553 2.21081 11.1887C2.26413 11.1154 2.33744 11.0187 2.43075 10.8988C2.53073 10.7721 2.61404 10.6422 2.6807 10.5089C2.75401 10.3756 2.824 10.2289 2.89065 10.069C2.06417 9.58907 1.41433 8.99921 0.941104 8.29937C0.467881 7.59954 0.23127 6.85305 0.23127 6.0599C0.23127 5.13345 0.54453 4.27699 1.17105 3.4905C1.79757 2.70402 2.6507 2.08417 3.73045 1.63094ZM15.4877 12.6284C15.5543 12.7883 15.621 12.935 15.6876 13.0683C15.761 13.2016 15.8443 13.3315 15.9376 13.4582C16.0376 13.5781 16.1142 13.6714 16.1675 13.7381C16.2209 13.8114 16.3075 13.9114 16.4275 14.038C16.5474 14.1647 16.6241 14.248 16.6574 14.288C16.6641 14.2946 16.6774 14.308 16.6974 14.328C16.7174 14.3546 16.7307 14.3713 16.7374 14.3779C16.7507 14.3913 16.7641 14.4079 16.7774 14.4279C16.7974 14.4546 16.8107 14.4746 16.8174 14.4879C16.824 14.5013 16.8307 14.5179 16.8374 14.5379C16.8507 14.5579 16.8574 14.5779 16.8574 14.5979C16.864 14.6179 16.8674 14.6379 16.8674 14.6579C16.8674 14.6845 16.864 14.7079 16.8574 14.7279C16.8374 14.8212 16.794 14.8945 16.7274 14.9478C16.6607 15.0011 16.5874 15.0245 16.5075 15.0178C16.1742 14.9711 15.8876 14.9178 15.6477 14.8578C14.6212 14.5912 13.6948 14.1647 12.8683 13.5781C12.2684 13.6848 11.6819 13.7381 11.1087 13.7381C9.30247 13.7381 7.72951 13.2982 6.38983 12.4184C6.7764 12.4451 7.06967 12.4584 7.26962 12.4584C8.3427 12.4584 9.37246 12.3084 10.3589 12.0085C11.3453 11.7086 12.2251 11.2787 12.9983 10.7188C13.8314 10.1056 14.4713 9.39912 14.9178 8.5993C15.3644 7.79949 15.5877 6.95302 15.5877 6.0599C15.5877 5.54669 15.511 5.04014 15.3577 4.54026C16.2175 5.01348 16.8974 5.60667 17.3972 6.31984C17.8971 7.03301 18.1471 7.79949 18.1471 8.6193C18.1471 9.41911 17.9105 10.1689 17.4372 10.8688C16.964 11.5619 16.3142 12.1485 15.4877 12.6284Z" fill="currentcolor"/>
                    </svg>
                    <div class="pxl-comment-count meta-text">
                        <?php echo esc_html('Coments ('.$comment_count.')'); ?>
                    </div>
                </span>
            <?php endif; ?>
            <?php if($show_reading_time == 'true') : ?>
                <span class="pxl-post-reading-time meta-info">
                    <svg class="meta-icon" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.19727 0.96875C10.9434 0.96875 13.9785 4.00391 13.9785 7.75C13.9785 11.4961 10.9434 14.5312 7.19727 14.5312C3.45117 14.5312 0.416016 11.4961 0.416016 7.75C0.416016 4.00391 3.45117 0.96875 7.19727 0.96875ZM7.19727 13.2188C10.2051 13.2188 12.666 10.7852 12.666 7.75C12.666 4.74219 10.2051 2.28125 7.19727 2.28125C4.16211 2.28125 1.72852 4.74219 1.72852 7.75C1.72852 10.7852 4.16211 13.2188 7.19727 13.2188ZM8.86523 10.375L6.54102 8.67969C6.45898 8.625 6.43164 8.51562 6.43164 8.43359V3.92188C6.43164 3.75781 6.56836 3.59375 6.75977 3.59375H7.63477C7.79883 3.59375 7.96289 3.75781 7.96289 3.92188V7.80469L9.76758 9.14453C9.93164 9.25391 9.95898 9.44531 9.84961 9.60938L9.33008 10.293C9.2207 10.457 9.0293 10.4844 8.86523 10.375Z" fill="currentcolor"/>
                    </svg>
                    <div class="pxl-estimated-reading-time meta-text">
                        <?php echo esc_html($reading_time . ' Min read'); ?>
                    </div>
                </span>
            <?php endif; ?>
        </div>
        <div class="pxl-post-content">
            <h4 class="pxl-post-title">
                <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="pxl-title-link">
                    <?php echo esc_html(get_the_title($post_id)); ?>
                </a>
            </h4>
            <?php if($show_excerpt == 'true') : ?>
                <p class="pxl-post-excerpt">
                    <?php echo wp_trim_words( $post->post_excerpt, $num_of_words, $more = null); ?>
                </p>
            <?php endif; ?>
            <?php if($show_button == 'true') : ?>
                <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="button pxl-post-button pxl-button-default">
                    <span class="button__text">
                        <span class="button__icon icon-duplicated">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M10.0035 3.4083L1.41176 12L0 10.5882L8.59171 1.99654H1.01905V0H12V10.981H10.0035V3.4083Z" fill="currentcolor"/>
                            </svg>                                    
                        </span>
                        <?php echo esc_html($button_text); ?>
                        <span class="button__icon icon-main">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M10.0035 3.4083L1.41176 12L0 10.5882L8.59171 1.99654H1.01905V0H12V10.981H10.0035V3.4083Z" fill="currentcolor"/>
                            </svg>                                    
                        </span>
                    </span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</article>