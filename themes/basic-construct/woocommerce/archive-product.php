<?php
use BC\Layout\Image;
use BC\Layout\Card;

//TODO: Hard coded parent category for walker
$args = array(
    'taxonomy'   => "product_cat",
    'number'     => null,
    'orderby'   => 'meta_value',
    'order' => 'ASC',
    'hide_empty' => false,
    'hierarchical' => 1,
    'child_of' => 43,
    'walker'=> new \BC\Walker\Category,
    'title_li'=> false
);

//TODO: hard coded post ID for shop
$shop = get_post(406);

//TODO: hard coded first product category id (featured)
$firstCategoryID = 84;

get_header();

print '<div class="container-flex">';

print '<header class="banner">' . Image::getImage($shop) .' </header>';

print '<div class="container-flex">
  <div class="row no-gutters">
    <div class="col-md-3 col-sm-12">
      <div class="navbar navbar-expand-sm bsnav bsnav-sidebar bsnav-sidebar-left pt-5">
        <button class="navbar-toggler toggler-spring">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-sm-end align-items-start">
          <ul class="navbar-nav mr-0 bc-shop-nav">';
            print wp_list_categories($args) . '
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9 col-sm-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2 ml-3">
          <li class="breadcrumb-item active" aria-current="page">Featured</li>
        </ol>
      </nav>
      <input id="bc-shop-category-id" type="hidden" value="' . $firstCategoryID . '">
      <div class="container bc-shop-products-page">';


        $featured = $products->getList($firstCategoryID);
        $rv = '';
        $n = 0;

        foreach($featured as $product) {
          $n++;

          if($n % 3 == 1) {
          //  $rv .= '<div class="row my-2">';
          }

          $rv .= '
          <div class="card-wrapper float-left">' .
            Card::feature(
              $product['title'],
              null,
              null,
              '<img
                class="card-img-top"
                title="' . $product['title'] . '"
                src="' . Image::getFeaturedImage($product['id'], 'medium') . '"
                alt="' . $product['title'] . '">',
              '<button class="btn btn-primary">$' . $product['price'] . '</button>',
              $product['url']) . '
          </div>';

          if($n % 3 == 0) {
            //$rv .= '</div>';
           }
        }
        print $rv . '
      </div>
    </div>
  </div>
</div>';

//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );

//wp_enqueue_script('basic-construct-woocommerce', get_template_directory_uri() . '/js/shop.js', ['basic-construct-js'], null, true);
