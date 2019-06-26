<?php

function get_bc_sidebars($atts, $content = "null")
{

    extract(shortcode_atts(['name' => ''], $atts));

    $cls = "BC\\Sidebars\\" . $name;

    if (class_exists($cls)) {
      return $cls::section($name, $atts);
    }

    $cls = "EHM\\Sidebars\\" . $name;

    if (class_exists($cls)) {
      return $cls::section($name, $atts);
    }

}

 function get_id($name)
{
  $parts = preg_split('/(?=[A-Z])/', $name);

  $id = (count($parts) > 0) ? implode('-', $parts) : $name;

  return ltrim(strtolower($id), '-');

}


//Register fi sidebars in lib/Sidebars directory
autoload_sidebars('BC\\Sidebars', glob(__DIR__ . "/../lib/Sidebars/*.php"));
//register go sidebars
//autoload_sidebars('EHM\\Sidebars', glob(__DIR__ . "/../../ehm/lib/Sidebars/*.php"));

function autoload_sidebars($ns, $sidebars)
{
  foreach ($sidebars as $sidebar) {
    //class name
    $name = rtrim(basename($sidebar), '.php');
    //exclude base class
    if ($name !== 'Sidebars') {
      //split class name by captials
      $cls = $ns . '\\' . $name;
      //registior
      $register = [
        'name' => $name,
        'id' => get_id($name),
        'description' => $cls::getDesc($name) . ':' . get_id($name),
        'class' => 'bc',
        'before_widget' => '',
  	    'after_widget'  => '',
        'before_title' => '<span style="display:none">',
        'after_title' => '</span>'
      ];

      add_action('widgets_init', function() use ($register) {
      	register_sidebar($register);
      });

    }
  }
}

add_shortcode('get_sidebar', 'get_bc_sidebars');

function posts_recent()
{
  return BC\Posts\Latest::list(null, 2);
}

// Add Shortcode for blogs latest
add_shortcode('bc_recent_posts', 'posts_recent');
