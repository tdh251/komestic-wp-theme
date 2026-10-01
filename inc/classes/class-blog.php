<?php

if (!class_exists('Komestic_Blog')) {

    class Komestic_Blog {

        public function get_tags() {
            ?>
            <div class="blog-article__tags">
                <?php $tags = get_the_tags();
                    if ( $tags ) {
                        foreach ( $tags as $tag ) {
                            echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="pxl-button button--primary blog-article__tag"><span class="button__text">#' . esc_html( $tag->name ) . '</span></a> ';
                        }
                    }
                ?>
            </div>
            <?php
        }

        public function get_socials_share() { 
            $img_url = [0 => ''];
            if (has_post_thumbnail() && wp_get_attachment_image_src(get_post_thumbnail_id(), false)) {
                $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(), false);
            }
            $single_post_social_vimeo = (bool)komestic()->get_theme_opt( 'single_post_social_vimeo', true );
            $single_post_social_facebook = (bool)komestic()->get_theme_opt( 'single_post_social_facebook', true );
            $single_post_social_pinterest = (bool)komestic()->get_theme_opt( 'single_post_social_pinterest', true );
            $single_post_social_instagram = (bool)komestic()->get_theme_opt( 'single_post_social_instagram', true );
            $single_post_social_twitter = (bool)komestic()->get_theme_opt( 'single_post_social_twitter', true );
            ?>
            <div class="blog-article__share">
                <p class="blog-article__share-label"><?php echo esc_html__('Share:', 'komestic'); ?></p>
                <div class="blog-article__share-list">
                    <?php if($single_post_social_vimeo) : ?>
                        <a class="button button--only-icon blog-article__share-link" title="<?php echo esc_attr__('Vimeo', 'komestic'); ?>" target="_blank" href="https://vimeo.com/share?url=<?php echo urlencode(get_permalink()); ?>">
                            <span class="button__icon">
                                <svg width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.0003 0.979304C11.8891 0.852293 11.7542 0.757035 11.5954 0.693529C11.4525 0.614147 11.2938 0.55858 11.1191 0.526827C10.9445 0.495074 10.7698 0.487136 10.5952 0.503013C10.4206 0.503013 10.2539 0.510951 10.0951 0.526827C9.98395 0.542703 9.80138 0.606209 9.54735 0.717344C9.30921 0.828478 9.04725 0.987242 8.76147 1.19363C8.49157 1.40003 8.22961 1.66199 7.97559 1.97952C7.72157 2.28117 7.52312 2.65426 7.38023 3.0988C7.63425 3.08292 7.85652 3.08292 8.04704 3.0988C8.23755 3.11468 8.38838 3.16231 8.49951 3.24169C8.62652 3.32107 8.71384 3.44808 8.76147 3.62272C8.82498 3.78148 8.84085 3.99582 8.8091 4.26571C8.79323 4.37685 8.76941 4.49592 8.73766 4.62293C8.70591 4.73407 8.66621 4.85314 8.61859 4.98015C8.57096 5.10716 8.51539 5.23417 8.45188 5.36118C8.40425 5.47232 8.34869 5.59139 8.28518 5.7184C8.2058 5.86129 8.11054 6.02005 7.99941 6.19469C7.90415 6.36933 7.78508 6.52016 7.64219 6.64717C7.51518 6.77418 7.36435 6.84562 7.18971 6.8615C7.03095 6.87738 6.86425 6.78212 6.68961 6.57573C6.51497 6.40109 6.38002 6.19469 6.28476 5.95655C6.20538 5.70253 6.14187 5.44057 6.09424 5.17067C6.06249 4.90077 6.03074 4.63087 5.99898 4.36097C5.98311 4.0752 5.95929 3.82118 5.92754 3.59891C5.89579 3.47189 5.86403 3.34488 5.83228 3.21787C5.8164 3.07499 5.79259 2.9321 5.76084 2.78921C5.74496 2.64632 5.72115 2.50344 5.68939 2.36055C5.65764 2.21766 5.61795 2.07477 5.57032 1.93189C5.53857 1.82075 5.49094 1.70962 5.42743 1.59848C5.3798 1.47147 5.3163 1.36034 5.23692 1.26508C5.15754 1.16982 5.07022 1.0825 4.97496 1.00312C4.89557 0.923736 4.80825 0.868169 4.713 0.836416C4.60186 0.804664 4.48279 0.796725 4.35578 0.812602C4.24464 0.812602 4.12557 0.828478 3.99856 0.860231C3.88743 0.876107 3.77629 0.90786 3.66516 0.955489C3.5699 1.00312 3.48258 1.05075 3.4032 1.09838C3.16505 1.24126 2.93484 1.40003 2.71257 1.57467C2.50618 1.74931 2.29979 1.93189 2.09339 2.1224C1.887 2.29704 1.67267 2.47962 1.4504 2.67014C1.24401 2.84478 1.02174 3.01942 0.783594 3.19406V3.2655C0.862975 3.31313 0.918543 3.36076 0.950295 3.40839C0.997925 3.45602 1.02968 3.50365 1.04555 3.55128C1.07731 3.59891 1.10112 3.6386 1.117 3.67035C1.14875 3.7021 1.19638 3.72592 1.25988 3.74179C1.41865 3.75767 1.56947 3.74179 1.71236 3.69416C1.85525 3.64654 1.9902 3.60684 2.11721 3.57509C2.24422 3.54334 2.36329 3.54334 2.47443 3.57509C2.60144 3.59097 2.72051 3.67829 2.83165 3.83705C2.89515 3.94819 2.94278 4.05932 2.97453 4.17046C3.02216 4.26571 3.06185 4.36891 3.09361 4.48004C3.12536 4.59118 3.15711 4.70231 3.18886 4.81345C3.22062 4.92458 3.25237 5.03572 3.28412 5.14685C3.34763 5.28974 3.39526 5.44057 3.42701 5.59933C3.47464 5.74222 3.52227 5.89304 3.5699 6.05181C3.61753 6.21057 3.65722 6.37727 3.68897 6.55191C3.7366 6.71068 3.78423 6.86944 3.83186 7.0282C3.89536 7.31398 3.96681 7.63151 4.04619 7.98079C4.14145 8.31419 4.25258 8.63966 4.37959 8.95718C4.5066 9.25883 4.64949 9.53667 4.80825 9.79069C4.9829 10.0288 5.19723 10.1955 5.45125 10.2908C5.57826 10.3543 5.71321 10.3861 5.8561 10.3861C6.01486 10.3702 6.16569 10.3464 6.30857 10.3146C6.46734 10.2829 6.61022 10.2352 6.73723 10.1717C6.88012 10.1082 6.99919 10.0527 7.09445 10.005C7.34848 9.84626 7.58662 9.67956 7.80889 9.50492C8.04704 9.3144 8.2693 9.11595 8.4757 8.90955C8.69797 8.70316 8.89642 8.48883 9.07106 8.26656C9.26158 8.04429 9.44416 7.82202 9.6188 7.59975C10.0157 7.05996 10.365 6.52016 10.6666 5.98036C10.9842 5.42469 11.2461 4.90871 11.4525 4.43242C11.6748 3.94025 11.8494 3.51159 11.9764 3.14643C12.1034 2.78127 12.1828 2.51137 12.2146 2.33673C12.2305 2.20972 12.2384 2.09065 12.2384 1.97952C12.2543 1.8525 12.2543 1.73343 12.2384 1.6223C12.2384 1.51116 12.2146 1.40003 12.167 1.28889C12.1193 1.17776 12.0638 1.07456 12.0003 0.979304Z" fill="currentcolor"/>
                                </svg>
                            </span>
                        </a>
                    <?php endif; ?>
                    <?php if($single_post_social_facebook) : ?>
                        <a class="button button--only-icon blog-article__share-link" title="<?php echo esc_attr__('Facebook', 'komestic'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                            <span class="button__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="22" viewBox="0 0 12 22">
                                    <path d="M7.72053 5.44883V8.29819H11.0527L10.525 12.1365H7.72053V20.9797C7.15823 21.0622 6.58295 21.1053 5.999 21.1053C5.32494 21.1053 4.66302 21.0485 4.01842 20.9385V12.1365H0.945312V8.29819H4.01842V4.81187C4.01842 2.64894 5.67583 0.894775 7.72139 0.894775V0.89661C7.72746 0.89661 7.73266 0.894775 7.73872 0.894775H11.0535V4.21431H8.88756C8.24383 4.21431 7.72139 4.76696 7.72139 5.44791L7.72053 5.44883Z" fill="currentcolor"/>
                                </svg>
                            </span>
                        </a>
                    <?php endif; ?>
                    <?php if($single_post_social_pinterest) : ?>
                        <a class="button button--only-icon blog-article__share-link" title="<?php echo esc_attr__('Pinterest', 'komestic'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($img_url[0]); ?>&description=<?php the_title(); ?>%20">
                            <span class="button__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" viewBox="0 0 16 20">
                                    <path d="M8.25805 0.5C3.05062 0.5 0.28125 3.83702 0.28125 7.47569C0.28125 9.1632 1.22417 11.2675 2.73355 11.9349C2.96275 12.0383 3.08744 11.9943 3.1385 11.7818C3.18363 11.6202 3.38195 10.8424 3.47814 10.4754C3.50783 10.3579 3.49239 10.2557 3.39739 10.1453C2.89624 9.56578 2.49841 8.51005 2.49841 7.51963C2.49841 4.98183 4.51607 2.51765 7.94928 2.51765C10.9182 2.51765 12.9952 4.44624 12.9952 7.20493C12.9952 10.3223 11.3457 12.4788 9.20215 12.4788C8.01579 12.4788 7.13225 11.5478 7.41251 10.3959C7.75096 9.02426 8.4148 7.54932 8.4148 6.56008C8.4148 5.67298 7.91366 4.93907 6.88998 4.93907C5.68224 4.93907 4.70251 6.13494 4.70251 7.74051C4.70251 8.76062 5.06353 9.4494 5.06353 9.4494C5.06353 9.4494 3.86885 14.2756 3.64678 15.177C3.27151 16.703 3.69784 19.1743 3.73466 19.3868C3.75722 19.5044 3.88904 19.5412 3.96267 19.445C4.08023 19.2907 5.5243 17.2302 5.92925 15.7411C6.07651 15.1983 6.68098 12.9978 6.68098 12.9978C7.07881 13.7163 8.22717 14.3184 9.45035 14.3184C13.089 14.3184 15.7183 11.1203 15.7183 7.15149C15.7052 3.34657 12.4489 0.5 8.25805 0.5Z" fill="currentcolor"/>
                                </svg>
                            </span>
                        </a>
                    <?php endif; ?>
                    <?php if($single_post_social_twitter) : ?>
                        <a class="button button--only-icon blog-article__share-link" title="<?php echo esc_attr__('Twitter', 'komestic'); ?>" target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>">
                        <span class="button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20">
                                <path d="M0.939249 0.539795L8.74455 10.9753L0.890625 19.4601H2.65874L9.53552 12.0319L15.0913 19.4601H21.1071L12.863 8.43761L20.1738 0.539795H18.4057L12.0732 7.38102L6.95628 0.539795H0.940422H0.939249ZM3.53864 1.84189H6.30169L18.5053 18.1581H15.7423L3.53864 1.84189Z" fill="currentcolor"/>
                            </svg>
                        </span>    
                        </a>
                    <?php endif; ?>
                    <?php if($single_post_social_instagram) : ?>
                        <a class="button button--only-icon blog-article__share-link" title="<?php echo esc_attr__('Instagram', 'komestic'); ?>" target="_blank" href="https://www.instagram.com/?url=<?php the_permalink(); ?>">
                        <span class="button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M19.4953 19.5L19.5 19.4992V12.531C19.5 9.12204 18.7661 6.49608 14.7809 6.49608C12.865 6.49608 11.5794 7.54742 11.0545 8.54413H10.9991V6.81433H7.22046V19.4992H11.155V13.2181C11.155 11.5643 11.4685 9.96517 13.5166 9.96517C15.5345 9.96517 15.5646 11.8525 15.5646 13.3242V19.5H19.4953ZM0.8135 6.81513H4.75283V19.5H0.8135V6.81513ZM2.78158 0.5C1.52204 0.5 0.5 1.52204 0.5 2.78158C0.5 4.04113 1.52204 5.08454 2.78158 5.08454C4.04113 5.08454 5.06317 4.04113 5.06317 2.78158C5.06275 2.1766 4.82223 1.59651 4.39444 1.16872C3.96665 0.740935 3.38657 0.500419 2.78158 0.5Z" fill="currentcolor"/>
                            </svg>
                        </span>    
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }

        public function get_post_navigation() {
            $next_post = get_next_post();
            $prev_post = get_previous_post();
            $has_next_post = empty($next_post) ? 'blog-article__navigation-button--empty' : null;
            $has_prev_post = empty($prev_post) ? 'blog-article__navigation-button--empty' : null;
            $next_post_link = empty($next_post) ? '#' : get_permalink($next_post->ID);
            $prev_post_link = empty($prev_post) ? '#' : get_permalink($prev_post->ID);
            ?>
                <div class="blog-article__navigation">
                    <a href="<?php echo esc_url($prev_post_link); ?>" class="pxl-button button--primary blog-article__navigation-button blog-article__navigation-button--prev <?php echo esc_attr($has_prev_post); ?>">
                        <span class="button__text">
                            <?php echo esc_html__('Previous Post', 'komestic'); ?>
                        </span>
                    </a>
                    <a href="<?php echo esc_url($next_post_link); ?>" class="pxl-button button--primary blog-article__navigation-button blog-article__navigation-button--next <?php echo esc_attr($has_next_post); ?>">
                        <span class="button__text">
                            <?php echo esc_html__('Next Post', 'komestic'); ?>
                        </span>    
                    </a>
                </div>
             <?php
        }
    }
}
