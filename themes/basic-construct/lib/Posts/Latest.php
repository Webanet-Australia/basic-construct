<?php
/**
  *
  *   Latest (News/Media)
  *
**/
namespace BC\Posts;

class Latest extends Blog {

  public static function list($category = null, $postPerPage = 10)
  {
    //get latest 3 posts for $category
    $blogs = [
      'orderby' => 'post_date',
      'order' => 'DESC',
      'post_status' => 'publish',
      'posts_per_page'  => $postPerPage,
      'post_type' => 'post'
    ];

    if (isset($category)) {
      $blogs['category_name'] = $category;
    }

    $blogs = get_posts($blogs);

    $result = '
      <div class="bc-late-posts">
        <div class="container">
          <div class="row">';
              foreach($blogs as $blog) {
                $url = esc_url(get_permalink($blog->ID));
                $title = esc_html($blog->post_title);
                $result .= '
                <div class="col-md-6 text-left">
                  <div class="card card-inverse">
                    <img class="card-img" src="' . parent::getImage($blog->ID) . '" alt="' . $title . '">
                    <div class="card-img-overlay d-flex">
                      <a href="' . get_permalink($blog->ID) . '" class="mx-auto my-auto">
                        Read Article
                      </a>
                    </div>
                  </div>
                  <div class="container ml-4 mr-4" style="min-height: 190px;">
                    <h5>' . parent::getDate($blog->post_date) . '</h5>
                    <h4>' . $title . '</h4>
                    <p>' . strip_tags(substr($blog->post_content, 0, 256)) . '</p>
                  </div>
                </div>';
              }
              $result .= '
          </div>
        </div>
      </div>';

    return $result;

  }




}
