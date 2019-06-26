<?php
/**
  *
  *   Latest (News/Media)
  *
**/
namespace BC\Posts;

class Recent extends Blog {

  public static function sidebar($postPerPage = 10)
  {
    //get latest 3 posts for $category
    $blogs = [
      'orderby' => 'post_date',
      'order' => 'DESC',
      'post_status' => 'publish',
      'posts_per_page'  => $postPerPage,
      'post_type' => 'post'
    ];

    $blogs = get_posts($blogs);

    $result = '
    <div class="bc-posts-recent-sidebar">
      <h4>Recent Posts</h4>
      <ul class="list-group">';
        foreach($blogs as $blog) {
          $url = esc_url(get_permalink($blog->ID));
          $title = esc_html($blog->post_title);
          $result .= '
          <li class="list-group-item">

              <div class="row">
                <div class="col-xs-4 col-lg-4">
                  <img src="' . parent::getImage($blog->ID) . '" alt="' . $title . '">
                </div>
                <div class="col-xs-8 col-lg-8">
                <a href="' . get_permalink($blog->ID) . '">
                  <h4>' . $title . '</h4>
                  <h5>' . parent::getDate($blog->post_date) . '</h5>
                </a>

            </div>
          </li>';
        }
        $result .= '
      </ul>
    </div>';

    return $result;

  }

  public static function getDate($postDate)
  {
    return date("d F Y", strtotime($postDate));
  }

  public static function getImage($id)
  {
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'single-post-thumbnail');
    if (isset($img[0])) {
      return esc_url($img[0]);
    }
  }

}
