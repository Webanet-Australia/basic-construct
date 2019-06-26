<?php
namespace BC\Components\Carousels;

use BC\Components\Base;
use BC\Layout\Card;
use BC\Layout\Image;

defined('ABSPATH') or die("No");

class Carousels extends Base {

    function feature($args)
    {
      $params = [
       'posts_per_page' => -1,
       'orderby'   => 'meta_value',
       'order' => 'ASC'
      ];

      if (!in_array($args['carousel'], ['product', 'post', 'latest'])) {
        $params['post_type'] = 'bc-carousels';
        $params['carousels'] = $args['carousel'];
      } else {

        $params['post_type'] = $args['carousel'];

        switch ($args['carousel']) {

          case 'product':
            if($args['category']) {
              $params['product_cat'] = $args['category'];
            } else {
              return 'No category set for product carousel.';
            }
          //  print_r($params);
            break;

          case 'post':
            $params['post_status'] = 'publish';
            $params['posts_per_page'] = (($args['count'] > 1) ? ($args['count'] * 3) : 10);
            if($args['category']) {
              switch ($args['category']) {
                case 'latest':
                  $params['order'] = 'DESC';
                  $params['orderby'] = 'ID';
                  break;
                default:
                  $params['category_name'] = $args['category'];
              }
            }
            break;

          default:
            $params['category_name'] = $args['category'];
        }

      }

      $query = new \WP_Query($params);

      $items = $query->get_posts();

      $n = 0;
      $rv .=  '
      <div id="bc-carousel-' . $args['carousel'] . '"
        class="carousel ' . (($args['size'] == 'full') ? 'bc-carousel-full-size' : '') . '
        data-ride="carousel"'
        . (($args['slide'] == 'false') ? ' data-interval="false"' : '') . '
      >
        <div class="carousel-inner">';

        if ($args['count'] > 1) {

          $blocks = array_chunk($items, $args['count']);

          foreach ($blocks as $block) {
            $rv .= '
            <div class="carousel-item ' . (($n==0) ? 'active':'') . '">
              <div class="row">';
              foreach ($block as $item) {
                $rv .= '
                <div class="col-md-' . (12 / ($args['count'])) . ' col-sm-' . (12 / ($args['count'] / 2)) . '">' .
                  Card::feature(
                    get_field('card_header', $item->ID),
                    $item->post_title,
                    self::getContent($item, $args),
                    Image::getImage($item),
                    get_field('card_footer', $item->ID),
                    null) . '
                </div>';
              }
              $rv .= '
              </div>
            </div>';
            $n++;
          }
        } else {
          foreach($items as $item) {
            $rv .= '
            <div class="carousel-item ' . (($n==0) ? 'active':'') . '">';
              if (get_post_thumbnail_id($item->ID)) {
                $rv .=  \BC\Layout\Image::getImage($item, [], 'full-size');
                /*$rv .= '<img
                  src="' . wp_get_attachment_url(get_post_thumbnail_id($item->ID)) . '"
                  alt="' . $item->post_title . '"
                  style="opacity: .' . get_field('bc_carousel_image_opacity', $item->ID) .'"
                >';*/
              }
              $rv .= '
              <div class="carousel-caption text-center ' .   get_field('bc_carousel_caption_class', $item->ID) .'">'
                . apply_filters('the_content', $item->post_content) . '
              </div>
            </div>';
            $n++;
          }
      }
      $rv .= '
        </div>';

      if ($args['arrows'] == 'true') {
        $rv .= '<a class="carousel-control-prev" href="#bc-carousel-' . $args['carousel'] . '" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#bc-carousel-' . $args['carousel'] . '" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>';
      }
      if (strlen($args['indicators'])) {
        $rv .= '
        <div class="carousel-indicators-wrap">
          <ol class="carousel-indicators">';
            if ($args['count'] > 1) {
              $cnt = (count($items) / $args['count']);
              for($n=0; $n < $cnt; $n++) {
                $rv .= '<li data-target="#bc-carousel-' . $args['carousel'] . '" data-slide-to="' . $n . '" class="' . (($n == 0) ? 'active':'') . '"></li>';
              }
            } else {
              $n = 0;
              foreach($items as $item) {
                $rv .= '<li data-target="#bc-carousel-' . $args['carousel'] . '" data-slide-to="' . $n . '"></li>';
                $n++;
              }
            }
            $rv .= '
          </ol>
        </div>';
      }


      return $rv . '</div>';
  }

  public static function getContent($item, $args)
  {
    if(strlen(get_field('card_copy', $item->ID) > 0)) {
      $content = get_field('card_copy', $item->ID);
    } else {
      $content = apply_filters('the_content', $item->post_content);
    }

    if($args['content-length']) {
      $content = strip_tags($content);
      $content = substr($content, 0, $args['content-length']) . '...';
    }
    return $content;
  }
}
