<?php
global $product;

$product_url   = get_permalink( ($product) ? $product->get_id() : '' );
$product_title = get_the_title( ($product) ? $product->get_id() : 0 );
$socials = array(
    'facebook' => array(
        'label' => 'Facebook',
        'icon'  => 'fab fa-facebook-f',
        'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $product_url ),
        'show'  => (bool)$widget->get_setting('facebook', ''),
    ),
    'twitter' => array(
        'label' => 'Twitter / X',
        'icon'  => 'fab fa-twitter',
        'url'   => 'https://twitter.com/intent/tweet?url=' . urlencode( $product_url ) . '&text=' . urlencode( $product_title ),
        'show'  => (bool)$widget->get_setting('twitter', ''),
    ),
    'pinterest' => array(
        'label' => 'Pinterest',
        'icon'  => 'fab fa-pinterest-p',
        'url'   => 'https://pinterest.com/pin/create/button/?url=' . urlencode( $product_url ) . '&description=' . urlencode( $product_title ),
        'show'  => (bool)$widget->get_setting('pinterest', ''),
    ),
    'linkedin' => array(
        'label' => 'LinkedIn',
        'icon'  => 'fab fa-linkedin-in',
        'url'   => 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode( $product_url ),
        'show'  => (bool)$widget->get_setting('linkedin', ''),
    ),
    'whatsapp' => array(
        'label' => 'WhatsApp',
        'icon'  => 'fab fa-whatsapp',
        'url'   => 'https://api.whatsapp.com/send?text=' . urlencode( $product_title . ' ' . $product_url ),
        'show'  => (bool)$widget->get_setting('whatsapp', ''),
    ),
    'telegram' => array(
        'label' => 'Telegram',
        'icon'  => 'fab fa-telegram-plane',
        'url'   => 'https://t.me/share/url?url=' . urlencode( $product_url ) . '&text=' . urlencode( $product_title ),
        'show'  => (bool)$widget->get_setting('telegram', ''),
    ),
    'instagram' => array(
        'label' => 'Instagram',
        'icon'  => 'fab fa-instagram',
        'url'   => $widget->get_setting('instagram_link', ['url' => ''])['url'],
        'show'  => (bool)$widget->get_setting('instagram', ''),
    ),
    'youtube' => array(
        'label' => 'YouTube',
        'icon'  => 'fab fa-youtube',
        'url'   => $widget->get_setting('youtube_link', ['url' => ''])['url'], 
        'show'  => (bool)$widget->get_setting('youtube', ''),
    ),
    'tiktok' => array(
        'label' => 'TikTok',
        'icon'  => 'fab fa-tiktok',
        'url'   => $widget->get_setting('tiktok_link', ['url' => ''])['url'],
        'show'  => (bool)$widget->get_setting('tiktok', ''),
    ),
    'snapchat' => array(
        'label' => 'Snapchat',
        'icon'  => 'fab fa-snapchat-ghost',
        'url'   => $widget->get_setting('snapchat_link', ['url' => ''])['url'],
        'show'  => (bool)$widget->get_setting('snapchat', ''),
    ),
);
$socials = array_filter($socials, function($social) {
    return !empty($social['show']) && !empty($social['url']);
});
?>
<ul class="product-share">
    <?php foreach ( $socials as $key => $social ) : ?>
        <li class="share-item <?php echo esc_attr('share-'.$key); ?>">
            <a class="pxl-button button--only-icon <?php echo esc_attr('share-link-'.$key); ?>" href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noopener noreferrer nofollow" aria-label="<?php echo esc_attr( $social['label'] ); ?>" title="<?php echo esc_attr( 'Share on ' . $social['label'] ); ?>" >
                <span class="button__icon">
                    <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                </span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
