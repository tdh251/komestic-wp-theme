<?php
/**
 * @package Case-Themes
 */
?>
<?php
    $post_id = get_the_ID();
    $show_author = komestic()->get_theme_opt('blog_show_show_author', 'true');
    $show_date = komestic()->get_theme_opt('show_date', 'true');
    $show_excerpt = komestic()->get_theme_opt('blog_show_excerpt', 'true');    
    $num_of_words = komestic()->get_theme_opt('blog_excerpt_num_of_words', 16);
    $show_button = komestic()->get_theme_opt('blog_show_button', 'true');
    $button_text = komestic()->get_theme_opt('blog_button_text', esc_html__('Read More', 'komestic'));

    $featured_image_html = komestic_get_image_by_size([
        'img_dimension' => ['width' => 1000, 'height' => 813] ,
    ], $post_id);

    $author_id = get_post_field ('post_author', $post_id);
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_link = get_author_posts_url($author_id);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>
    <div class="blog-article__inner">
        <?php if(!empty($featured_image_html)) : ?>
            <div class="blog-article__featured image--distortion-transition" data-displacement="<?php echo esc_attr(get_template_directory_uri() . '/assets/images/displacement-5.webp'); ?>">
                <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                    <?php echo wp_kses_post($featured_image_html); ?>
                </a>
                <?php komestic()->blog->get_tags(); ?>
            </div>
        <?php endif; ?>
        <?php if($show_author || $show_date) : ?>
            <div class="blog-article__meta">
                <?php if($show_author) : ?>
                    <div class="blog-article__author">
                        <div class="blog-article__author-avatar">
                            <?php echo get_avatar($author_id); ?>
                        </div>
                        <a href="<?php echo esc_url($author_link); ?>" class="blog-article__author-name blog-article__meta-info">
                            <?php echo esc_html($author_name); ?>
                        </a>
                    </div>
                    <span class="blog-article__meta-divider"></span>
                <?php endif; ?>
                <?php if($show_date) : ?>
                    <span class="blog-article__date blog-article__meta-info">
                        <?php echo esc_attr(get_the_date('d F Y')); ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="blog-article__content">
            <h6 class="blog-article__title">
                <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="title-link">
                    <?php echo esc_html(get_the_title($post_id)); ?>
                </a>
            </h6>
            <?php if($show_excerpt) : ?>
                <p class="blog-article__excerpt">
                    <?php echo wp_trim_words( $post->post_excerpt, $num_of_words, $more = null); ?>
                </p>
            <?php endif; ?>
            <?php if($show_button) : ?>
                <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="button button--link-underline blog-article__button">
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
</article>