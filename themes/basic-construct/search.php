<?php

//global $wp_query;
$query = new WP_Query( [
  's' => $_GET['s'],
  'post_type' => 'post',
  'post_status' => 'publish'
]);

$responses = $query->posts;

$results = '<div class="search-results"><h2>Search Results</h2>';

foreach($responses as $response) {
  // /var_dump($response);
  $results .= '
      <div class="row">
        <div class="col-xs-12">
          <h3><a class="a-result" href="' . get_permalink($response->ID) .'">' . $response->post_title . '</a></h3>
          <ul>
            <li><img src="' . get_field('blog_thumbnail', $response->ID) . '" alt="Blog Item Image"></li>
            <li>' . substr($response->post_content, 0, 256)  . '
              ...<a href="#">Read More</a>
            </li>
          </ul>
          <div class="h-readmore">

          </div>
        </div>
      </div>';
}

$results .= '</div>';

print $results;
 // echo paginate_links();
