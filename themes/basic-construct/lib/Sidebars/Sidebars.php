<?php
/**
  *
  *   Base classes
  *
**/
namespace BC\Sidebars;

interface iSidebars
{
    public static function getDynamicSidebar($name);
    public static function section(String $sidebar, Array $atts = null, Callable $callBack = null);
}

abstract class Sidebars implements iSidebars
{

  public static function getDesc($name) {
    return $name;
  }

  public static function getDynamicSidebar($name)
  {
    ob_start();
    dynamic_sidebar($name);
    return ob_get_clean();
  }

  public static function section(String $sidebar, Array $atts = null, Callable $callBack = null)
  {
    return (($callBack) ? $callBack() : self::getDynamicSidebar($sidebar));
  }

}
