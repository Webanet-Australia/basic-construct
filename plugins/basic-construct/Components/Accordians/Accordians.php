<?php
namespace BC\Components\Accordians;

use BC\Components\Base;

defined('ABSPATH') or die("No");

class Accordians extends Base {

    function feature($args)
    {
      $query = new WP_Query([
       'post_type' => 'bc-accordians',
       'tax_query' => [
           'taxonomy' => 'Accordians',
           'field' => 'slug',
           'terms' => $this->atts['accordian'],
        ],
       'orderby'   => 'meta_value',
       'order' => 'ASC',
      ]);

      $items = $query->get_posts();
      $n = 0;
      $rv = '
      <div id="bc-accordians-' . $this->atts['accordian'] . '" class="accordian slide" data-ride="accordian">
        <div class="accordian-inner">';

      if ($this->atts['count'] == 1) {
        foreach($items as $item) {
          $rv .= '
          <div class="accordian-item ' . (($n==0) ? 'active':'') . '">'
            . apply_filters('the_content', $item->post_content) .
          '</div>';
          $n++;
        }
      } else {

        $blocks = array_chunk($items, 4);

        foreach ($blocks as $block) {
          $rv .= '<div class="accordian-item ' . (($n==0) ? 'active':'') . '">';
          $n++;
          foreach ($block as $item) {
              $rv .= apply_filters('the_content', $item->post_content) . '<br/>';
          }
          $rv .= '
          </div>';
        }
      }
      $rv .= '
        </div>
      </div>';

      return $rv;
  }
}
