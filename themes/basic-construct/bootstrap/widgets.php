<?php
/**
  *
  *   Register Widgets
  *
**/
//wp_enqueue_editor();




//Register all from lib/Widgets directory
$widgets = glob(__DIR__ . "/../lib/Widgets/*.php");
foreach ($widgets as $widget) {
  $widget = 'BC\\Widgets\\' . rtrim(basename($widget), '.php');
  add_action('widgets_init', function() use ($widget) {
     register_widget(new $widget);
  });
}
