<?php
/**
 * @package Case-Themes
 */

$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$category_link = get_term_link( $category );
$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$image_html = komestic_get_image_by_size([
    'img_id' => $thumbnail_id,
    'img_dimension' => $img_dimension,
]);
?>
<div class="<?php  echo esc_attr($item_class); ?>" <?php if($anim_delay != 0) : ?> data-wow-delay="<?php echo esc_attr(($key * $anim_delay).'ms') ?>" <?php endif; ?>>
    <div class="category-item">
        <div class="category-item__featured">
            <a href="<?php echo esc_url( $category_link ); ?>">
                <?php pxl_print_html($image_html); ?>
            </a>
        </div>
        <h6 class="category-item__name">
            <a class="category-item__name-link pxl-button button--primary" href="<?php echo esc_url( $category_link ); ?>">
                <span class="button__text">
                    <?php echo esc_html( $category->name ); ?>
                </span>
            </a>
        </h6>
    </div>
</div>
