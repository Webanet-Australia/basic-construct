<?php
/**
  *
  *   Social Media Icons
  *
**/
Child \Sidebars;

use BC\Sidebars\Sidebars as Sidebars;

class Social extends Sidebars
{
  public static function getDesc($name) {
    return 'Home | Social Media';
  }
  public static function section(String $sidebar, Array $atts = null, Callable $callBack = null)
  {
    return '<ul class="list-inline list-group-flush bc-social">' . self::getDynamicSidebar($sidebar) . '</ul>';
  }
}
