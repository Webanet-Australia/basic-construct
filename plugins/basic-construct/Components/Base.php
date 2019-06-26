<?php
namespace BC\Components;

class Base {

  private $pd;
  private $ns;

  function __construct(String $ns, String $plural, String $singular)
  {
    $this->pd = plugin_dir_url(__FILE__);
    $this->ns = $ns;
    $this->plural = $plural;
    $this->singular = $singular;

    add_action('init', array($this, 'init') );
    add_action('admin_menu', [$this, 'removeAdminMenu']);
    add_action('wp_enqueue_scripts', [$this, 'publicScripts']);
    add_shortcode($ns, [$this, 'feature']);
  }

  public function init()
  {
    $labels = [
       'name' => _x($this->plural, 'post type general name'),
       'singular_name' => _x('Items', 'post type singular name'),
       'add_new' => _x('Add New', $this->singular . ' item'),
       'add_new_item' => __('Add New ' . $this->singular . ' item'),
       'edit_item' => __('Edit ' . $this->singular . ' item'),
       'new_item' => __('New ' . $this->singular . ' item'),
       'view_item' => __('View ' . $this->singular . ' item'),
       'search_items' => __('Search ' . $this->singular . ' items'),
       'not_found' =>  __('Nothing found'),
       'not_found_in_trash' => __('Nothing found in Trash'),
       'parent_item_colon' => ''
    ];

    $post = [
       'labels' => $labels,
       'public' => false,
       'publicly_queryable' => true,
       'show_ui' => true,
       'query_var' => true,
       'rewrite' => ['slug' => 'bc-' . strtolower($this->singular)],
       'taxonomies' => [$this->plural],
       'capability_type' => 'post',
       'hierarchical' => false,
       'show_in_admin_bar' => true,
       'supports' => ['title', 'editor', 'thumbnail', 'page-attributes']
     ];

     $tax = [
         'name' => __($this->plural, $this->ns),
         'singular_name' => __($this->singular, $this->ns),
         'search_items' => __('Search ' . $this->plural, $this->ns),
         'popular_items' => __('Popular ' . $this->plural, $this->ns),
         'all_items' => __('All ' . $this->plural, $this->ns),
         'parent_item' => null,
         'parent_item_colon' => null,
         'edit_item' => __('Edit ' . $this->singular, $this->ns),
         'update_item' => __('Update ' . $this->singular, $this->ns),
         'add_new_item' => __('Add New ' . $this->singular, $this->ns),
         'new_item_name' => __('New ' . $this->singular . ' Name', $this->ns),
         'separate_items_with_commas' => __('Separate ' . $this->plural . ' with commas', $this->ns),
         'add_or_remove_items' => __('Add or remove ' . $this->singlular, $this->ns),
         'choose_from_most_used' => __('Choose from the most used ' . $this->singular, $this->ns),
         'not_found' => __('No ' . $this->plural . ' Found.', $this->ns),
         'menu_name' => __($this->plural, $this->ns),
     ];

     register_taxonomy($this->plural, $this->ns, [
       'labels' => $tax,
       'rewrite' => ['slug' => 'bc-' . strtolower($this->singular)],
       'hierarchical' => true,
       'show_admin_column' => false
     ]);

     register_post_type($this->ns, $post);

     $this->atts = shortcode_atts([
        strtolower($this->singular) => 'uncatgorized',
       'count' => 1,
       'size' => null
     ], $atts);
   }

   public function removeAdminMenu()
   {
     //remove_menu_page('edit.php?post_type=' . $this->ns);
   }

   public function publicScripts()
   {
     wp_enqueue_style(
       'basic-construct-' . $this->ns . '-style',
       $this->pd . $this->plural . '/css/basic-construct-' . strtolower($this->singular) . '.css',
       ['basic-construct-style'],
       null
     );
     //wp_enqueue_script('apif-frontend-js', '/frontend.js', array('jquery'), null, true);
   }

}
