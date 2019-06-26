<?php


function woocommerce_support()
{
	add_theme_support('woocommerce');
}

add_theme_support('title-tag');

add_theme_support('post-thumbnails');

add_action('after_setup_theme', 'woocommerce_support');
add_action('wp_print_styles', 'bc_deregister_styles', 100);

add_action( 'admin_menu', 'bc_remove_submenu' );

function bc_remove_submenu()
{
    global $current_user;
    get_currentuserinfo();

    if(!is_super_admin())
    {
      remove_submenu_page( 'tools.php', 'export.php' );
    }
}

//add_image_size('small-size', 120, 140);

function bc_deregister_styles()    {
	 //wp_deregister_style( 'amethyst-dashicons-style' );
	 wp_deregister_style( 'dashicons' );


}
