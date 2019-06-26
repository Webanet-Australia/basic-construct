<?php
namespace BC\Walker;

class Footer extends \Walker_Nav_Menu
{
  	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
      if ($depth == 0) {
  			$output .= '
        <li class="list-group-item">
          <a href="' . $item->url . '" title="' . $item->title . '">
            ' .  $item->title  . '
          </a>';
      }
  	}
    function start_lvl( &$output, $depth = 0, $args = array() ) {
      $output.= '';
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
      $output.= '';
    }
}
