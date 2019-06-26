<?php
namespace BC\Walker;

class Breadcrumbs extends \Walker_Category
{
  private static $cnt = 0;

  function start_lvl(&$output, $depth = 0, $args = [])
  {
    $output .= '
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">';
  }

  function end_lvl(&$output, $depth = 0, $args = [], $id = 0)
  {
    $output .= '</ol>';
  }

  function start_el(&$output, $item, $depth = 0, $args= [], $id = 0)
  {
    $output .= '
    <li class="breadcrumb-item">
      <a class="nav-link" href="#">'
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
    $output .= '</ol></nav>';
  }
}
