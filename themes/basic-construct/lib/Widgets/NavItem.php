<?php
namespace BC\Widgets;

class NavItem extends \WP_Widget {

    private $cnt = 0;

    // constructor
    public function __construct()
    {
      $ops = [
  			'classname' => 'bc-item',
  			'description' => 'BC Nav Item',
  		];
  		parent::__construct('NavItem', 'BC Nav Item', $ops);
    }

    public function widget($args, $instance)
    {
      if (strpos($instance['navitem_href'], 'account')) {

        if (is_user_logged_in()) {
          $html = '
          <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fa fa-user" aria-hidden="true"></i>
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="/account/">Profile</a>
             <a class="dropdown-item" href="/account/customer-logout/?_wpnonce=2ecf14c121">Log Out</a>
           </div>
         </li>';
       } else {
         $html = '
          <li class="nav-item">
           <a class="nav-link" href="/account/"></i>Sign In/Up</a>
          </li>';
       }
     } else {
       $html  = '
       <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
       </li>';
     }

     $this->cnt++;
     print $html;
    }

    public function form($instance)
    {
      $instance = wp_parse_args((array) $instance, [
        'navitem_title' => '',
        'navitem_href' => '',
        'navitem_icon' => '']);?>
      <p>
        <label for="<?php echo $this->get_field_id('navitem_title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('navitem_title'); ?>" name="<?php echo $this->get_field_name('navitem_title'); ?>" type="text" value="<?php echo $instance['navitem_title']; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('navitem_href'); ?>"><?php _e('Link', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('navitem_href'); ?>" name="<?php echo $this->get_field_name('navitem_href'); ?>" type="text" value="<?php echo $instance['navitem_href']; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('navitem_icon'); ?>"><?php _e('Icon', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('navitem_icon'); ?>" name="<?php echo $this->get_field_name('navitem_icon'); ?>" type="text" value="<?php echo $instance['navitem_icon']; ?>" />
      </p><?php
    }
}
?>
