<?php
namespace BC\Layout;

class Columns2 extends Layout
{
  public static function getContent($content, int $column = 1)
  {
    if(get_field('basic_construct_component', $content->ID)) {

      $component = str_replace(' ', '', get_field('basic_construct_component', $content->ID));
      $component = '\\BC\\Components\\' . $component . 's\\' . $component;
      if($component) {
        $rv = $component::feature($content);
      }
    } else {
      if ($column == 2) {
        $rv = get_field('basic_construct_layouts_column2_content', $content->ID);
      } else {
        $rv = apply_filters('the_content', $content->post_content);
      }
    }
    return $rv;
  }

  public static function feature($content)
  {
    $fi = parent::getFeaturedImage($content->ID);
    $columns = self::getColumns($content->ID);
    $image = Image::getImage($content, $fi);

    $rv = '
    <div class="row">
      <div class="col-md-' . $columns[0] . ' col-sm-6">';
      if($fi[4] == 'Left') {
        $rv .= $image;
      } else {
        $rv .= self::getContent($content);
      }
      $rv .= '
      </div>
      <div class="col-md-' . $columns[1] . ' col-sm-6">';
      if($fi[4] == 'Right') {
        $rv .= $image;
      } else {
        $rv .= self::getContent($content, 2);
      }
      $rv .= '
      </div>
    </div>';
    return $rv;
  }
}
