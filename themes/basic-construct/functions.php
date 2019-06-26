<?php

//composer autoload
require_once( __DIR__ . '/vendor/autoload.php');

function disable_wp_emojicons()
{
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7 );
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}

//don't show admin page on frontend site
add_filter('show_admin_bar', '__return_false');

//require theme files
$bs = glob(__DIR__ . "/bootstrap/*.php");
foreach ($bs as $inc) {
  require_once($inc);
}
