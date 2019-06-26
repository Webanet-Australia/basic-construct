<?php
/*
  Page Content (Default)
*/
use BC\Layout\Image;

global $post;

get_header();

print '<div class="container-flex">';

print '<header class="banner">' . Image::getImage($post) .' </header>';

print apply_filters('the_content', $post->post_content);

get_footer();
