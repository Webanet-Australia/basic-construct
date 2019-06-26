<?php
namespace BC\Components\Jumbotrons;

class Jumbotron
{

  public static function feature($content)
  {
    $rv = '
    <div class="jumbotron">
      <p class="display-' . get_field('bc_jumbotron_heading_size', $content->ID) . '">' . $content->post_title . '</p>';
      if(get_field('bc_jumbotron_lead_copy', $content->ID)) {
        $rv .= apply_filters('the_content', get_field('bc_jumbotron_lead_copy', $content->ID));
      }
      $rv .= '
        <hr class="my-4">' .

        apply_filters('the_content', $content->post_content);

        if(get_field('bc_jumbotron_link', $content->ID)) {
        $rv .= '<a class="btn ' . get_field('bc_jumbotron_link_class', $content->ID) . '" href="' . get_field('basic_construct_link', $content->ID) . '" role="button">' . get_field('basic_construct_link_title', $content->ID) . '</a>';
      }
    $rv .= '
    </div>';

    return $rv;
  }

}
