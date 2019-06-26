<?php
/**
  *
  *   Social Media Icons
  *
**/
Child \Sidebars;

use BC\Sidebars\Sidebars as Sidebars;

class Galleria extends Sidebars
{
  public static function getDesc($name) {
    return 'Home | Galleria List';
  }
  public static function section(String $sidebar, Array $atts = null, Callable $callBack = null)
  {
    return self::getDynamicSidebar($sidebar);

  }
}
