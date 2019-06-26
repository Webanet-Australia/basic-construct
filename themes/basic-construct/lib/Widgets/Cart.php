<?php
namespace BC\Widgets;

class Cart extends \WP_Widget {

    private $cnt = 0;

    // constructor
    public function __construct()
    {
      $ops = array(
  			'classname' => 'bc-cart',
  			'description' => 'BC Cart',
  		);
  		parent::__construct('BC Cart', 'BC Cart', $ops );



    }
    public function widget($args, $instance)
    {
      if ($woocommerce->cart) {
        if(!$woocommerce->cart->is_empty()) {
          $html  = '
          <li class="nav-item">
            <a class="nav-link" href="/cart/" title="Cart">
              <i class="fa fa-cart-plus" aria-hidden="true"></i>
            </a>
          </li>';
        }
      } else {
        $html = '';
      }

      $this->cnt++;
      print $html;
    }

    public function form($instance)
    {
      // /$instance = wp_parse_args( (array) $instance, ['cart_title' => '', 'cart_href' => '', 'cart_id' => '']);?>
      <?php /*
      <p>
        <label for="<?php echo $this->get_field_id('cart_title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('cart_title'); ?>" name="<?php echo $this->get_field_name('cart_title'); ?>" type="text" value="<?php echo $instance['cart_title']; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('cart_href'); ?>"><?php _e('Link', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('cart_href'); ?>" name="<?php echo $this->get_field_name('cart_href'); ?>" type="text" value="<?php echo $instance['cart_href']; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('cart_id'); ?>"><?php _e('Cart ID', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('cart_id'); ?>" name="<?php echo $this->get_field_name('cart_id'); ?>" type="text" value="<?php echo $instance['cart_id']; ?>" />
      </p><?php */
    }
}
?>
