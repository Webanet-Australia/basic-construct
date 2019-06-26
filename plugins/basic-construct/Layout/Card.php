<?php
namespace BC\Layout;

class Card
{
  //TODO: params
  public static function feature(String $header = null, String $title = null, String $copy = null, String $image, String $footer = null, String $link = null, String $subtitle = null)
  {
    $rv = '<div class="card text-center">';

      if(isset($link)) {
        $rv .= '<a href="' . $link . '" title="122' . $title . '">';
      }

      if (strlen($header)) {
        $rv .= '
        <div class="card-header">
        ' . $header . '
        </div>';
      }

      $rv .= '
      <div class="card-image-wrap text-center">' . $image . '</div>
      <div class="card-body">';
        if (isset($title) && strlen($header) == 0) {
          $rv .= '<h5 class="card-title">' . $title . '</h5>';
        }
        //TODO: subtitle is undefined
        if (isset($subtitle)) {
          $rv .= '<h6 class="card-subtitle">' . $subtitle . '</h6>';
        }
        $rv .= '<p class="card-text">' . strip_tags($copy) . '</p>
      </div>';
      if (strlen($footer)) {
        $rv .= '<div class="card-footer">' . $footer . '</div>';
      }
      if(isset($link)) {
        $rv .= '</a>';
      }
      $rv .= '
    </div>';

    return $rv;
  }

}
