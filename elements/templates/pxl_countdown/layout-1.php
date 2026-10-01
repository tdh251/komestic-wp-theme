<?php 
$date = new DateTime();
$date->modify('+3 days');
$date_time = $widget->get_setting('date_time', $date->format('Y-m-d H:i:s'));
$layout_style = $widget->get_setting('layout_style', 'df');

$day_unit = $widget->get_setting('day_unit', 'Days');
$hour_unit = $widget->get_setting('hour_unit', 'Hours');
$minute_unit = $widget->get_setting('minute_unit', 'Minutes');
$second_unit = $widget->get_setting('second_unit', 'Seconds');

$entrance_anim = $widget->get_setting('entrance_anim', '');
?>

<ul class="pxl-countdown <?php echo esc_attr($entrance_anim); ?>" data-time="<?php echo esc_attr($date_time); ?>" data-layout_style="<?php echo esc_attr($layout_style); ?>">
  <li class="countdown__timer days" data-unit="<?php echo esc_attr($day_unit); ?>"></li>
  <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
  <li class="countdown__timer hours" data-unit="<?php echo esc_attr($hour_unit); ?>"></li>
  <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
  <li class="countdown__timer minutes" data-unit="<?php echo esc_attr($minute_unit); ?>"></li>
  <li class="separator"><?php esc_html_e(':', 'komestic'); ?></li>
  <li class="countdown__timer seconds" data-unit="<?php echo esc_attr($second_unit); ?>"></li>
</ul>