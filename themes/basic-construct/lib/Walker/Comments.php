<?php
namespace BC\Walker;

class Comments extends \Walker
{
  static $cnt = 0;

	function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
  {
    $cd = date_create($item->comment_date);

    if ($depth == 0) {
      //$class = '';// (in_array('menu-item-has-children', $item->classes)) ? 'has-child' : '';
      $output .= '
      <div class="container comment">
        <div class="row">
          <div class="col-sm-6">' . $item->comment_author . '</div>
          <div class="col-sm-6 text-right">' . date_format($cd, 'M d') . '</div>
        </div>
        <div class="row">
          <div class="col-sm-12">' . $item->comment_content . '</div>
        </div>
      </div>';
      self::$cnt++;
    }


  }

  function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {

  }
}
