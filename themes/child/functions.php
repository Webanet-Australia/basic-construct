<?php

function custom_logo_setup()
{
    $defaults = [
        'width'       => 111,
        'height'      => 39,
        'flex-height' => false,
        'flex-width'  => false,
        'header-text' => ['site-title', 'site-description']
    ];

    add_theme_support('custom-logo', $defaults);
}


add_action('after_setup_theme', 'custom_logo_setup');

function enqueue_child()
{
  wp_deregister_script('wp-embed');
  wp_deregister_script('contact-form-7');

  wp_enqueue_style('child', get_stylesheet_directory_uri() . '/style.css', ['basic-construct'], null);
  wp_enqueue_style('child-main', get_stylesheet_directory_uri() . '/css/main.css', ['child'], null);
  wp_enqueue_style('child-main-nav', get_stylesheet_directory_uri() . '/css/nav.css', ['child-main'], null);
  wp_enqueue_style('child-sections', get_stylesheet_directory_uri() . '/css/sections.css', ['child-main-nav'], null);

  if (is_page_template('page-regions.php')) {
    wp_enqueue_style('regions-page-template', get_stylesheet_directory_uri() . '/css/regions.css', ['child-sections'], null);
  }
  if (is_page_template('page.php')) {
    wp_enqueue_style('default-page-template-css', get_stylesheet_directory_uri() . '/css/page.css', ['child-sections'], null);
  }
  wp_enqueue_script('child-main-js', get_stylesheet_directory_uri() . '/js/main.js', ['basic-construct-js'], null, true);
}

add_action('wp_enqueue_scripts', 'enqueue_child');

/*
add_action('rest_api_init', function () {
  register_rest_route( 'services', '/(?P<id>\d+)', [
    'methods' => 'GET',
    'callback' => 'rest_services'
  ]);
});

add_action('rest_api_init', function () {
  register_rest_route( 'services/header', '/(?P<id>\d+)', [
    'methods' => 'GET',
    'callback' => 'rest_services_header'
  ]);
});

//services as in EHM services, that sort
function rest_services(WP_REST_Request $request)
{
  $p = get_post($request['id']);
  if ($p) {
    return rest_ensure_response(['content' => do_shortcode(get_post_field('post_content', $p->ID))]);//$p->post_content]);
  }
}

function rest_services_header(WP_REST_Request $request)
{
  $p = get_post($request['id']);
  if ($p) {

    $img = wp_get_attachment_image_src(get_post_thumbnail_id($p->ID), 'single-post-thumbnail');
    if (is_array($img)) {
      $img = esc_url($img[0]);
    }
    $rv = [
      'copy' => get_field('service_copy', $p->ID),
      'thumb' => $img,
      'type' => 'services'
    ];

    return rest_ensure_response($rv);
  }
}
*/
?>
