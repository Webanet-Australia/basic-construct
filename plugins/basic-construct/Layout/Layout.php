<?php
namespace BC\Layout;

class Layout
{
  public static function getFeaturedImage(Int $id)
  {
    $fi = wp_get_attachment_image_src(get_post_thumbnail_id($id));
    $fi[4] = get_field('basic_construct_layouts_image_column', $id);
    return $fi;
  }

  public static function getImage($fi, $content)
  {
    $hover = get_post_meta($content->ID, 'bc_featured_image_hover_effect', true);

    if($hover) {
      $hover = self::getHover($hover);
    }

    $link = get_post_meta($content->ID, 'bc_featured_image_link', true);
    $lightbox = get_post_meta($content->ID, 'bc_featured_image_show_lightbox', true);
    $except = get_post(get_post_thumbnail_id($content->ID))->post_excerpt;
    $caption = get_post_meta($content->ID, 'bc_featured_image_show_caption', true);;

    $rv = '
    <div' . (($hover !== "0") ? ' class="bc-hover-' . strtolower($hover) . '"': '') . '>';

      if ($lightbox == 1) {
        $rv .= '<a href="' . $fi[0] . '" data-lity="data-lity" data-lity-desc="' . $content->post_title . '">';
      }

      if ($hover !== "0" && $caption == 1) {
        $rv .= '<div class="thumbnail text-center">';
      }

      $rv .= '<img src="' . $fi[0] . '" alt="' . $content->post_title . '" title="' . $content->post_title . '" class="img-responsive">';

      if ($lightbox == 1) {
        $rv .= '</a>';
      }

      if ($hover !== "0") {
        $rv.= '
        <div
          class="overlay"' .
          (($lightbox == 1) ? ' onclick="lity(' . "'". $fi[0] . "'" . ')"' : '') .
        '>';
        if(strlen($except) && $caption == 1) {
          $rv .= '<h2>' . $except . '</h2>';
          if(strlen($link) > 2) {
            $rv .= '<a class="btn btn-primary" href="' . get_permalink($link) .'">' . $content->post_title . '</a>';
          }
        }
        $rv .= '
        </div>';
      } else {
        if(strlen($except) && $caption == 1) {
          $rv .= '
           <div class="caption">
               <h2>' . $except . '</h2>
           </div>';
        }
      }


    $rv .= '</div>
    ';
    return $rv;
  }

  public static function getColumns(int $id)
  {
    $column = get_field('basic_construct_layouts_columns', $id);
    if (strlen($column)) {
      $column = explode(',', $column);
    } else {
      $column[0] = 6;
      $column[1] = 6;
    }
    return $column;
  }

  public static function getHover(Int $hoverID = 0)
  {
    if($hoverID == 0) {
      return 0;
    }
    $hovers = [
      '',
      'lines',
      'top-caption',
      'bottom-caption'
    ];
    return $hovers[$hoverID];
  }
}
