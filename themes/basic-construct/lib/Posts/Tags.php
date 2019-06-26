<?php
/**
  *
  *   Latest (News/Media)
  *
**/
namespace BC\Posts;

class Tags extends Blog {

  public static function byPost($postID): String
  {
    $rv = '';
    $tags = wp_get_post_terms($postID, 'post_tag', array("fields" => "all"));

    foreach ($tags as $tag) {
      $rv .= $tag->name . ', ';
    }
    return substr($rv, 0, strlen($rv)-2);
  }

  public static function popular(Int $count = 10): String
  {
    $rv = '<div class="container bc-tags-pop"><h4>Popular Tags</h4>';

    $tags = get_tags([
        'hide_empty' => false
    ]);

    foreach ($tags as $tag) {
      $rv .= '<a href="#" class="badge badge-light">' . $tag->name . '</a>';
    }

    return $rv . '</div>';
  }

}
