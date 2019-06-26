<?php
namespace BC\Layout;

class Summary extends Layout
{
  public static function getFeature($items)
  {
    $rv = '
    <div class="container">';
      foreach ($items as $item) {
            $pd = date_create($item->post_date);
            $rv .= '
            <div class="row pt-4">
              <div class="col-lg">
                <h5>' . $item->post_title . '</h5>
              </div>
              <div class="col-sm text-right">
                <span class="pr-3">' . date_format($pd, 'M d') . '</span>
                <span>' .  get_the_author_meta('display_name', $item->post_author) . '</span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-9">'
                . strip_tags(substr($item->post_content, 0 , 255)) . '...
                <a href="' . get_permalink($item->ID) .'">'
                  . $item->post_title . '
                </a>
              </div>
              <div class="col-md-3 fit">';
                $rv .= Image::getImage($item) . '
              </div>
            </div>';
          }
          $rv .= '
        </div>
      </div>
      <div class="row">
        <div class="col-lg">';
          $pages = paginate_links([
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $query->max_num_pages,
            'type'  => 'array',
          ]);

          if(is_array($pages)) {
            $paged = (get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            $rv .= '
            <div class="pagination-wrap">
              <ul class="pagination">';
              foreach ( $pages as $page ) {
                $rv .= '<li>$page</li>';
              }
              echo '
              </ul>
            </div>';
          }
    $rv .= '
    </div>';
    return $rv;
  }
}
