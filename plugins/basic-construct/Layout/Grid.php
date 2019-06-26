<?php
namespace BC\Layout;

class Grid
{
	function __construct()
  {
		add_action('init', [$this, 'init']);
	}

	function init()
  {
		add_shortcode('row', [$this, 'row']);
		add_shortcode('column', [$this, 'column']);
	}

	function column($attr, $content = null)
  {
    $attr = shortcode_atts([
			'span' => 12,
      'style' => ''
		], $attr);
		return '<div class="col-md-' . $attr['span'] . ' ' . $attr['style'] . '">' . do_shortcode($content) . '</div>';
  }

	function row($attr, $content = null)
  {
		return '<div class="row">' . do_shortcode($content) . '</div>';
	}
}
