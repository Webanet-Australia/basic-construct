<?php
namespace BC\Walker;

class Header extends \Walker_Nav_Menu
{
  	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
      if ($depth == 0) {
        $class = (in_array('menu-item-has-children', $item->classes)) ? 'has-child' : '';
        $output .= '
          <li class="nav-item ' . $class . '">
            <a href="' . $item->url . '"
              class="nav-link js-scroll-trigger ' . strtolower($item->title) . ' ' . $class . '">
              ' . $item->title . '
            </a>
          </li>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
      
    }
}
