<?php

function styles()
{
  $td = get_template_directory_uri();
  wp_deregister_style('contact-form-7');
  wp_enqueue_style('bootstrap', $td . '/css/vendor/bootstrap.min.css', null, null);
  wp_enqueue_style('fontawesome', $td . '/css/vendor/font-awesome.css', ['bootstrap'], null);
  wp_enqueue_style('lightbox', $td . '/css/vendor/lity.min.css', ['fontawesome'], null);
  wp_enqueue_style('basic-construct', $td . '/style.css', ['lightbox'], null);
  wp_enqueue_style('basic-construct-comments', $td . '/css/comments.css', ['basic-construct'], null);
  wp_enqueue_style('basic-construct-help', $td . '/css/help.css', ['basic-construct-comments'], null);

}

function scripts()
{

  $td = get_template_directory_uri();

  wp_deregister_script('jquery');

  wp_enqueue_script('jquery', $td . '/js/vendor/jquery.min.js', [], null, true);
  wp_enqueue_script('popper', $td . '/js/vendor/popper.min.js', ['jquery'], null, true);
  wp_enqueue_script('bootstrap-js', $td . '/js/vendor/bootstrap.min.js', ['popper'], null, true);
  wp_enqueue_script('lightbox-js', $td . '/js/vendor/lity.min.js', ['bootstrap-js'], null, true);
  wp_enqueue_script('basic-construct-js', $td . '/js/main.js', ['lightbox-js'], null, true);

}

function woo_remove()
{
  remove_meta_box( 'postexcerpt', 'product', 'normal');
}

function admin_scripts()
{
  $td = get_template_directory_uri();
  wp_enqueue_style('bc-widgets-admin', $td . '/css/admin.css', [], null, null);
  wp_enqueue_script('bc-widgets', $td . '/js/widgets.js', [], null, true);
}

// remove scripts on unnecessary pages
function remove_unused()
{
  /*if (function_exists( 'is_woocommerce' ) && !is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page() ) {
  	wp_dequeue_script('wc-add-to-cart');
  	wp_dequeue_script('jquery-blockui');
  	wp_dequeue_script('jquery-placeholder');
  	wp_dequeue_script('woocommerce');
  	wp_dequeue_script('jquery-cookie');
  	wp_dequeue_script('wc-cart-fragments');
  }*/
}


if (is_admin()) {
  add_action('admin_enqueue_scripts', 'admin_scripts');
}

add_action('add_meta_boxes', 'woo_remove', 999);
add_action('wp_enqueue_scripts', 'styles');
add_action('wp_enqueue_scripts', 'scripts');
//add_action( 'wp_print_scripts', 'remove_unused', 100 );
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
