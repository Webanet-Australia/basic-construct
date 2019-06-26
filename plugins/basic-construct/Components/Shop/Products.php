<?php
namespace BC\Components\Shop;

use BC\Components\Base;

defined( 'ABSPATH' ) or die( "No" );

class Products
{

  public function __construct()
  {
    add_action('rest_api_init', function () {
      register_rest_route( 'products', '/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => [$this, 'restList']
      ]);
    });
  }

  function restList(\WP_REST_Request $request)
  {
    $rv = self::getList($request['id'], $request['page'], $request['postsPerPage']);
    //var_dump($request['postsPerPage']);exit;
    return rest_ensure_response(['products' => $rv]);
  }

  public static function getList(Int $categoryID = -1, $page = 1, $postsPerPage = null)
  {
    if (!isset($postsPerPage)) {
      $postsPerPage = 12;
    }

    $rv = [];

    $params = [
      'posts_per_page' => $postsPerPage,
      'paged' => $page,
      'orderby'=> 'meta_value',
      'order' => 'ASC',
      'post_type' => 'product',
      'post_status' => 'publish',
      'tax_query' => [
        [
          'taxonomy'      => 'product_cat',
          'terms'         => $categoryID,
          'operator'      => 'IN'
        ]
      ]
    ];

    $query = new \WP_Query($params);

    $products = $query->get_posts();

    foreach ($products as $product) {
      $rv[] = [
        'id' => $product->ID,
        'title' => $product->post_title,
        'content' => $product->post_content,
        'url' => $product->guid,
        'image' => self::getImage($product->ID, 'medium'),
        'price' => self::getPrice($product->ID),
        'ppp' => $postsPerPage,
        'page' => $page,
        'pageCount' => ceil($query->found_posts / $postsPerPage)
      ];
    }

    return $rv;

  }

  public static function getPrice(Int $productID)
  {
    $rv = get_post_meta($productID, '_price', true);
    if ($rv) {
      return number_format($rv, 2, '.', ',');
    }
  }

  public static function getImage(Int $productID, String $size = 'full-size')
  {
    $rv = wp_get_attachment_image_src(get_post_thumbnail_id($productID), $size);
    if ($rv) {
      return $rv[0];
    }
  }
}
