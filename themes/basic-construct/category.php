<?php

global $post;

$args = array ( 'category' => $cat, 'posts_per_page' => 2);

$blogs = get_posts($args);
$category = get_category($cat);

$rv = '
  <section class="htc__blog__area">
    <h2>Category: ' . $category->name . '</h2>';

foreach($blogs as $blog) {
  $rv .= '
    <div class="row">
      <div class="col-xs-12">
        <img src="' . get_field('blog_image', $blog->ID) . '" alt="Blog Item Image">
        <div class="title">' . esc_html($blog->post_title) . '</div>
          ' . esc_html($blog->post_content) . '
        </div>
      </div>
    </div>';
  }

$rv .= '</section>';

print $rv;
