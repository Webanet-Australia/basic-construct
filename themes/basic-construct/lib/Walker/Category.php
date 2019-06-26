<?php
namespace BC\Walker;

class Category extends \Walker_Category
{
  private static $cnt = 0;

  function start_lvl(&$output, $depth = 0, $args = [])
  {
    $output .= '<ul class="navbar-nav">';
  }

  function end_lvl(&$output, $depth = 0, $args = [], $id = 0)
  {
    $output .= '</ul>';
  }

  function start_el(&$output, $item, $depth = 0, $args= [], $id = 0)
  {
    $output .= '
    <li class="nav-item' . ((self::$cnt == 0) ? ' active' : ' ') . '">
      <a class="nav-link" data-id="' . $item->cat_ID . '" href="' . get_term_link($item->slug, $item->taxonomy) . '">'
          . esc_attr($item->name);
        if ($args['has_children']) {
          $output .= '<span class="fa fa-caret-left rotate"></span>';
        }
        $output .= '
      </a>';
    self::$cnt++;
  }

  function end_el(&$output, $item, $depth = 0, $args = [], $id = 0)
  {
    $output .= '</li>';
  }
}
