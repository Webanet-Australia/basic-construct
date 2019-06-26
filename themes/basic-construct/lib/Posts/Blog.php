<?php
/**
  *
  *   Latest (News/Media)
  *
**/
namespace BC\Posts;

class Blog {

  public static function getImage($postID)
  {
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($postID), 'single-post-thumbnail');
    if (isset($img[0])) {
      return esc_url($img[0]);
    }
  }

  public static function getDate($postDate)
  {
    return date("d F Y", strtotime($postDate));
  }
}
