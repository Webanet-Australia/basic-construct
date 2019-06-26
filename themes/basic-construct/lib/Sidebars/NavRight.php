<?php
/**
  *
  *   Promo Section
  *
**/
namespace BC\Sidebars;

class NavRight extends Sidebars implements iSidebars
{
  public static function getClass()
  {
    return 'NavRight';
  }
  public static function section(String $sidebar, Array $atts = null, Callable $callBack = null)
  {
      $rv = '<ul class="navbar-nav float-xs-right mt-1">' .
        parent::getDynamicSidebar('navright') . '
        </ul>';
      return  $rv;
  }

}
