<?php

function menus()
{
  register_nav_menus(
    array(
      'header' => __( 'Header' ),
      'footer' => __( 'Footer' )
    )
  );
}

add_action('init', 'menus');
