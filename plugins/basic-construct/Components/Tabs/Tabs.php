<?php
namespace BC\Components\Tabs;

use BC\Components\Base;

defined( 'ABSPATH' ) or die( "No" );

class Tabs extends Base {

  public function feature($args)
  {
    $params = [
     'posts_per_page' => -1,
     'orderby'   => 'meta_value',
     'order' => 'ASC'
    ];

    switch ($args['tab']) {
      case 'pages':
        $params['post_type'] = 'page';
        $params['category_name'] = $args['page'];

        break;
      default:
        $params['post_type'] = 'bc-tabs';
        $params['tabs'] = $args['tab'];
    }

    $query = new \WP_Query($params);

    $tabs = $query->get_posts();

    $rv = '
      <ul id="tabs" class="nav nav-tabs bc-tabs-' . $args['tab'] . '" role="tablist">';
      $n = 0;
      foreach ($tabs as $tab) {
        $rv .= '
        <li class="nav-item">
          <a class="nav-link ' . (($n==0) ? 'active show':'') . '" href="#bc-tab-' . $tab->ID . '" role="tab" data-toggle="tab">'
            . $tab->post_title .
          '</a>
        </li>';
        $n++;
      }

      $rv .= '
        <li class="nav-item">
          <a class="nav-link" href="/regions" role="tab">More</a>
        </li>
      </ul>';

      $rv .= '
      <div id="tab-content" class="tab-content">';
        $n = 0;
        foreach ($tabs as $tab) {
          $rv .= '
          <div role="tabpanel" class="tab-pane fade in '
            . (($n==0) ? 'active show':'') . '" id="bc-tab-' . $tab->ID . '">';
              if(get_field('basic_construct_layout', $tab->ID)) {
                $layout = '\\BC\\Layout\\' . str_replace(' ', '', get_field('basic_construct_layout', $tab->ID));
                $rv .= $layout::feature($tab);
              } else {
                $rv .= apply_filters('the_content', $tab->post_content);
              }
          $rv .= '
          </div>';
          $n++;
        }
        $rv .= '
      </div>';

    return $rv;
  }
}
