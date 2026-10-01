<?php
$btn_text = isset($args['btn_text']) ? $args['btn_text'] : 'Click here';
?>
<span class="button__text">
    <?php echo esc_html($btn_text); ?>
</span>
<span class="button__icon button__icon--main">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
        <path d="M12.5044 4.89676L1.76441 15.6367L0 13.8723L10.7387 3.13235H1.27402V0.636719H15V14.3627H12.5044V4.89676Z" fill="white"/>
    </svg>
</span>