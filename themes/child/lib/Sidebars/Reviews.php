<?php
/**
  *
  *   Social Media Icons
  *
**/
Child \Sidebars;

use BC\Sidebars\Sidebars as Sidebars;

class Reviews extends Sidebars
{
  public static function getDesc($name) {
    return 'Home | Random Reviews';
  }
  public static function section(String $sidebar, Array $atts = null, Callable $callBack = null)
  {
    $html ='
    <div class="container">
      <div id="carouselReviews" class="carousel slide" data-ride="carousel">
      <div class="container"  style=" flex-wrap: wrap;">
        <div class="carousel-inner">
        ' . self::getDynamicSidebar($sidebar) . '
        </div>
      </div>
        <ol class="carousel-indicators">';
        $cnt = \BC\Widgets\Review::count($sidebar);
        for($n = 0; $n < $cnt; $n++) {
          $html .= '
          <li data-target="#carouselReviews" data-slide-to="' . $n . '" ' . (($cnt == 0) ? 'class="active"': '') . '></li>';
        }
        $html .= '
        </ol>

      </div>
    </div>';
    return $html;
  }


}
