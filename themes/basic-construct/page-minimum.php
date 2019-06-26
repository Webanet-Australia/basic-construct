<?php
/**
  * Template Name: Minimum
**/
global $post;

get_header();

print apply_filters('the_content', $post->post_content);

get_footer();
