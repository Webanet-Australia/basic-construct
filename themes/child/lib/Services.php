<?php

Child ;

class Services
{
  public static function header()
  {
    $menu = wp_get_nav_menu_object( 'Header' );

    $menuitems = wp_get_nav_menu_items( $menu->term_id);
    $first = get_post(76);
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($first->ID), 'single-post-thumbnail');
    $img = esc_url($img[0]);
    $n = 0;
    $html = '
    <div class="ehm-header-nav ehm-nav-services">
      <div class="ehm-header-nav-wrap">
        <div class="container">
          <div class="row justify-content-end">
            <div class="col-3">
              <img src="' . $img . '" title="' . $first->post_title . '">
            </div>
            <div class="col-7">
              <div class="row">
                <div class="col-lg">
                  <ul class="list-inline list-group-flush ehm-header-nav">';
                  foreach ($menuitems as $mi) {
                		if ($mi->menu_item_parent == "258") {
                      if ($n == 0) {
                        $cls = 'active';
                      } else {
                        $cls = '';
                      }
                			$html .= '
                      <li class="list-inline-item">
                        <a href="#" class="' . $cls . '" data-id="' . substr($mi->url, strpos($mi->url, "#") + 1) . '" data-uri="services">' . $mi->post_title . '</a>
                      </li>';
                      $n++;
                		}
                	}
                  $html .= '
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="col-lg pl-3 ehm-header-nav-copy">
                  <p class="font-italic edm-font-feature edm-grey">' . get_field('service_copy', $first->ID) . '</p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg">
                  <div class="row">
                    <div class="col-md-7">
                      <a class="ehm-header-nav-btn" href="/services/#76" data-type="services" title="See More">
                        <button class="btn btn-default">See More</button>
                      </a>
                    </div>
                    <div class="col-md-5">
                      ' . do_shortcode('[get_sidebar name="Social"]') . '
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';
    return $html;
  }

  public static function listItems($postID)
  {
    $n = 0;
    $html = '';

    $args = [
      'post_type' => 'page',
      'post_parent' => $postID,
      'posts_per_page' => -1,
      'orderby' => 'menu_order'
    ];

    $services = get_posts($args);

    foreach($services as $service) {
      $cls = ($n == 0) ? 'class="active"': '';
      $html .= '
      <li class="list-inline-item">
        <a href="#" ' . $cls . ' data-id="' . $service->ID . '">' . $service->post_title . '</a>
      </li>';
      $n++;
    }
    return $html;

  }


}
