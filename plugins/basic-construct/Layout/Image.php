<?php
namespace BC\Layout;

class Image
{
  public static function setImage(Int $postID)
  {
    self::$image = $postID;
  }

  public static function setContent($content)
  {
    self::$content = $content;
  }

  public static function getFeaturedImage(Int $postID, String $size = 'full-size')
  {
    return wp_get_attachment_image_src(get_post_thumbnail_id($postID), $size)[0];
  }

  public static function getLink(Int $postID)
  {
      return get_post_meta($postID, 'bc_featured_image_link', true);
  }

  public static function getHover(Int $postID): Int
  {
    return intval(get_post_meta($postID, 'bc_featured_image_hover_effect', true));
  }

  public static function getHoverTitle(Int $hoverID)
  {
    $hover = [
      '',
      'lines',
      'top-caption',
      'bottom-caption'
    ];
    return $hover[$hoverID];
  }

  public static function getExcept(Int $postID)
  {
    return get_post(get_post_thumbnail_id($postID))->post_excerpt;
  }


  public static function isBool($postMeta): Bool
  {
    return filter_var($postMeta, FILTER_VALIDATE_BOOLEAN);
  }

  public static function isLightbox(Int $postID): Bool
  {
    return self::isBool(get_post_meta($postID, 'bc_featured_image_show_lightbox', true));
  }

  public static function isCaption(Int $postID): Bool
  {
    return self::isBool(get_post_meta($postID, 'bc_featured_image_show_caption', true));
  }

  public function getImageTag(&$rv, $imageSrc, $content)
  {
    $rv .= '<img src="' . $imageSrc . '" alt="' . $content->post_title . '" title="' . $content->post_title . '" class="img-responsive">';
  }

  public function getLightboxTag(&$rv, $imageSrc, $content)
  {
    if(self::isLightbox($content->ID)) {
      $rv .= '<a href="' . $imageSrc . '" data-lity="data-lity" data-lity-desc="' . $content->post_title . '">';
    }
  }

  public static function getLinkTag(&$rv, $link, $postTitle)
  {
    if(strlen($link) > 2) {
      $rv .= '<a class="btn btn-primary" href="' . get_permalink($link) .'">' . $postTitle . '</a>';
    }
  }

  public static function getCaptionTag(&$rv, $excerpt)
  {
    $rv .= '<h2>' . $excerpt . '</h2>';
  }

  public function getImage($content, Array $image = [], $imageSize = 'full-size')
  {

    if(!$image) {
      $image = self::getFeaturedImage($content->ID, $imageSize);
    } else {
      if (is_array($image)) {
        $image = $image[0];
      }
    }

    $link = self::getLink($content->ID);
    $excerpt = self::getExcept($content->ID);
    $isCaption = self::isCaption($content->ID);

    if ($hover > 0) {
      $rv = '
      <div class="bc-hover-' . self::getHoverTitle($hover) . '">
        <div class="thumbnail text-center">';
    }

    self::getLightboxTag($rv, $image, $content);
    self::getImageTag($rv, $image, $content);

    if (self::isLightbox($content->ID) == true)  {
      $rv .= '</a>';
    }

    if ($hover > 0) {
      $rv.= '<div class="overlay"' . ((self::isLightbox($content->ID) == 1) ? ' onclick="lity(' . "'". $image[0] . "'" . ')"' : '') . '>';
      if(strlen($excerpt) && $isCaption) {
        self::getCaptionTag($rv, $excerpt);
        self::getLinkTag($rv, $link, $content->post_title);
      }
      $rv .= '</div>
        </div>
      </div>';

    } else {
      if($isCaption) {
        $rv .= '<div class="caption text-center">';
          self::getCaptionTag($rv, $excerpt);
        $rv .= '</div>';
      }
    }
    return $rv;
  }
}
