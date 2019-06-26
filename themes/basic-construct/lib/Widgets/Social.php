<?php
namespace BC\Widgets;

class Social extends \WP_Widget {

    private static $glyphs;

    // constructor
    public function __construct()
    {
      $ops = array(
  			'classname' => 'bc-social',
  			'description' => 'Social',
  		);
  		parent::__construct( 'Social', 'Social', $ops );

      self::$glyphs  = [
          'Facebook' => [
              'color' => 'fi-color-facebook',
              'glyph' => 'fa-facebook'
          ],
          'Twitter' => [
              'color' => 'fi-color-twitter',
              'glyph' => 'fa-twitter'
          ],
          'Google+' => [
              'color' => 'fi-color-googleplus',
              'glyph' => 'fa-google-plus'
          ],
          'LinkedIn' => [
              'color' => 'fi-color-linkedin',
              'glyph' => 'fa-linkedin'
          ],
          'YouTube' => [
              'color' => 'fi-color-youtube',
              'glyph' => 'fa-youtube-play'
          ],
          'Instagram' => [
              'color' => 'fi-color-instagram',
              'glyph' => 'fa-instagram'
          ],
          'Email' => [
              'color' => 'fi-color-email',
              'glyph' => 'fa-envelope'
          ]
      ];

    }

    public static function getGlyph(Int $index)
    {
      $glyphs = array_keys(self::$glyphs);
      return self::$glyphs[$glyphs[$index]];
    }

    public function widget($args, $instance)
    {
      //extract($args, EXTR_SKIP);
      $title = $instance['social_title'];
      $href   = esc_url($instance['social_href']);
      $glyph  = self::getGlyph((Int) $instance['social_glyph']);
      $html  = '
      <li class="list-inline-item">
        <a href="' . $href . '" target="_blank" class="fi-social ' . $glyph['color'] . '" title="' . $title. '">
          <i class="fa-sm">
            <span class="fa ' . $glyph['color'] . '"></span>
            <span class="fa ' . $glyph['glyph'] . '"></span>
          </i>
        </a>
      </li>';
      print $html;
    }

    public function form($instance)
    {
      $instance = wp_parse_args( (array) $instance, ['social_title' => '', 'social_href' => '', 'social_color' => '', 'social_glyph' => '']);
      $selected = (isset($instance['social_glyph'])) ? $instance['social_glyph'] : 0;
      $rv = ''; ?>
      <p>
        <label for="<?php echo $this->get_field_id('social_title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('social_title'); ?>" name="<?php echo $this->get_field_name('social_title'); ?>" type="text" value="<?php echo $instance['social_title']; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('social_href'); ?>"><?php _e('Link', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('social_href'); ?>" name="<?php echo $this->get_field_name('social_href'); ?>" type="text" value="<?php echo $instance['social_href']; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('social_glyph'); ?>"><?php _e('Glyph', 'wp_widget_plugin'); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id('social_glyph'); ?>" name="<?php echo $this->get_field_name('social_glyph'); ?>"><?php

          if($selected == 0) {
            $rv = '<option value="0" selected="selected"></option>';
          }
          foreach(self::$glyphs as $key => $glyph) {
            $rv .= '<option value="' . $n . '" ';
            if($selected == $n) {
              $rv .= 'selected="selected"';
            }
            $rv .= '>' . $key . '</option>';
            $n++;
          }
          print $rv;
          ?>
        </select>
      </p><?php
    }
}
?>
