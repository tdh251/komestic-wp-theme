<?php 
    $sidebar = $widget->get_settings_for_display( 'sidebar' ?? '' );
?>
<aside class="sidebar sidebar--shop woocommerce">
    <?php dynamic_sidebar($sidebar); ?>
</aside>