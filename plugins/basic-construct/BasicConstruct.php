<?php
/*
Plugin name: Basic Construct
Plugin URI: https://github.com/s-n-i-p-e-r
Description: Collection of Bootstrap 4 Components.
Version: 1.0.0
Author: sniper@openmail.cc
Author URI: https://github.com/s-n-i-p-e-r
Text Domain: basic-construct
Domain Path: /basic-construct/
License: "CC BY-ND 2.0"
*/
namespace BC;

use BC\Components\Accordians\Accordians;
use BC\Components\Tabs\Tabs;
use BC\Components\Carousels\Carousels;
use BC\Components\Shop\Products;
use BC\Layout\Grid;

defined('ABSPATH') or die("No");

require_once(__DIR__ . '/vendor/autoload.php');

if(!class_exists('BasicConstruct')) {

  class BasicConstruct {

    private $pd;

    function __construct()
    {
      $this->pd = plugin_dir_url(__FILE__);

      add_action('init', [$this, 'addPagesCategory']);

      if (!is_admin()) {
        add_action('pre_get_posts', [$this, 'getPagesCategory']);
      }

      add_action('admin_menu', [$this, 'adminMenu']);
      add_action('wp_print_styles', [$this, 'deRegister'], 10);
      add_action('admin_enqueue_scripts', [$this, 'adminScripts']);
      add_action('wp_enqueue_scripts', [$this, 'publicScripts']);

      add_filter('admin_post_thumbnail_html', [$this, 'addImageDisplay'], 10, 2);
      add_action('save_post', [$this, 'saveImageDisplay'], 10, 3);


    }

    //TODO: mv all these admin gui scripts

    function addImageDisplay($content, $id)
    {
      $sel = get_post_meta($id, 'bc_featured_image_hover_effect', true);

      $rv = '<p><h5 style="margin: 5px">Hover Effect:</h5>
          <select name="bc_featured_image_hover_effect" style="width: 100%">
            <option value="0" ' . selected($sel, 0, false) . '></option>
            <option value="1" ' . selected($sel, 1, false) . '>Line</option>
            <option value="2" ' . selected($sel, 2, false) . '>Top-Caption</option>
            <option value="3" ' . selected($sel, 3, false) . '>Bottom-Caption</option>
          </select>
          </p>';

      $lightbox = get_post_meta($id, 'bc_featured_image_show_lightbox', true);

      $rv .= '<p><h5 style="margin: 5px">Show Lightbox: </h5>
        <input class="checkbox" name="bc_featured_image_show_lightbox" ' . checked($lightbox, 1, false) . ' value="' . ((strlen($lightbox)) ? '1' : '0') . '" type="checkbox">
      </p>';

      $caption = get_post_meta($id, 'bc_featured_image_show_caption', true);

      $rv .= '<p><h5 style="margin: 5px">Show Caption: </h5>
        <input class="checkbox" name="bc_featured_image_show_caption" ' . checked($caption, 1, false) . ' value="' . ((strlen($caption)) ? '1' : '0') . '" type="checkbox">
      </p>';

      $sel = get_post_meta($id, 'bc_featured_image_link', true);
      $i = 0;
      $options = '<option value="0"></option>';

      $query = new \WP_Query(['post_type' => 'page']);

      $items = $query->get_posts();

      foreach ($items as $item) {
        $i++;
        $options .= '<option value="' . $item->ID . '" ' . (($sel == $item->ID) ? 'selected="selected"' : '') . '>' . $item->post_title . '</option>';
      }

      return $content .= $rv . '<p><h5 style="margin: 5px">On Click:</h5>
             <select name="bc_featured_image_link" style="width: 100%">' . $options . '</select>
         </p>';
    }

    function saveImageDisplay($id, $post, $update)
    {
      if(isset($_POST['bc_featured_image_hover_effect'])) {
        update_post_meta($id, 'bc_featured_image_hover_effect', $_POST['bc_featured_image_hover_effect']);
      }

      if (isset($_POST['bc_featured_image_show_lightbox'])) {
        update_post_meta($id, 'bc_featured_image_show_lightbox', 1);
      } else {
        update_post_meta($id, 'bc_featured_image_show_lightbox', 0);
      }

      if (isset($_POST['bc_featured_image_show_caption'])) {
        update_post_meta($id, 'bc_featured_image_show_caption', 1);
      } else {
        update_post_meta($id, 'bc_featured_image_show_caption', 0);
      }

      if(isset($_POST['bc_featured_image_link'])) {
        update_post_meta($id, 'bc_featured_image_link', $_POST['bc_featured_image_link']);
      }
    }

    function addPagesCategory()
    {
      register_taxonomy_for_object_type('category', 'page');
    }

    function getPagesCategory($wp_query)
    {
      if (($wp_query->get('category_name') || $wp_query->get('cat')) && ( !$wp_query->get('post_type')))
      $wp_query->set('post_type', 'any');
    }

    function deRegister() {
      wp_deregister_style('bc-default-css');
    }


    function recursiveScripts(String $type = 'css')
    {
      $ri  = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(__DIR__));
      $ri = new \RegexIterator($ri, '/\.' . $type . '$/');
      foreach($ri as $it) {
        $f = $this->pd . substr(str_replace(__DIR__, '', $it), 1);
        if ($type == 'css') {
          wp_enqueue_style(basename(substr($it, 0, -4)), $f, ['basic-construct'], null);
        } else {
          wp_enqueue_script('basic-construct-components-' . basename(substr($it, 0, -3)), $f, ['basic-construct-js'], null, true);
        }
      }
    }

    public function publicScripts()
    {
      $this->recursiveScripts('css');
      $this->recursiveScripts('js');
    }

    function adminScripts()
    {
      wp_register_style('basic-construct-admin-styles', $this->pd . 'css/admin.css');
      wp_enqueue_style('basic-construct-admin-styles');

      wp_register_script('basic-construct-admin-script', $this->pd . 'js/admin.js');
      wp_enqueue_script('basic-constrct-admin-script');
    }

    function adminMenu()
    {
      add_menu_page(
        'Basic Construct',
        'Basic Construct',
        'manage_options',
        'basic_construct',
        [$this, 'adminPage'],
        $this->pd . '/images/icon.png'
      );
      //add_submenu_page('my-menu', 'Submenu Page Title', 'Whatever You Want', 'manage_options', 'my-menu' );
    }

    function adminPage()
    {
      $rv = '
      <div class="basic-construct-wrapper">
        <h1>Basic Construct</h1>
        <p>Bootstrap 4 Components, Layouts and Utilities</p>
        <div class="container">
          <div class="left">
            <h3>Components</h3>
            <ul>
              <li>
                <div><img src="' . $this->pd . '/Components/Carousels/images/icon.png' . '" alt="Carousels"/></div>
                <a href="/wp-admin/edit.php?post_type=bc-carousels" title="Carousels">Carousels</a>
              </li>
              <li>
                <div><img src="' . $this->pd . '/Components/Tabs/images/icon.png' . '" alt="Carousels"/></div>
                <a href="/wp-admin/edit.php?post_type=bc-tabs" title="Tabs">Tabs</a>
              </li>
              <li>
                <div><img src="' . $this->pd . '/Components/Accordians/images/icon.png' . '" alt="Carousels"/></div>
                <a href="/wp-admin/edit.php?post_type=bc-accordians" title="Accordians">Accordians</a>
              </li>
            </ul>
          </div>
          <div class="right">
          <h3>Layouts</h3>
          <ul>
            <!--<li>
              <div><img src="' . $this->pd . '/Components/Carousels/images/icon.png' . '" alt="Carousels"/></div>
              <a href="/wp-admin/edit.php?post_type=bc-carousels" title="Carousels">Carousels</a>
            </li>-->
          </ul>
        </div>
      </div>';
      print $rv;
    }
  }
}

$bc = new BasicConstruct();

//TODO: Load all classes

//$accordians = new Accordians('bc-accordians', 'Accordians', 'Accordian');
$tabs = new Tabs('bc-tabs', 'Tabs', 'Tab');
$carousels = new Carousels('bc-carousels', 'Carousels', 'Carousel');
$grid = new Grid();
$products = new Products();
$cardColumns = new CardColumns('bc-cardcolumns', 'Card Columns', 'Card Column');
