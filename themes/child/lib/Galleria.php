<?php

namespace Child;

class Galleria
{
  public static function header()
  {

    $img = get_post_meta(21, 'wpbgallery_gallery', true);
    //$gallery = (is_string($gallery)) ? @unserialize($gallery) : $gallery;
    if (is_array($img)) {
        $img = wp_get_attachment_image_src($img[0])[0];
    }

    $html = '
    <div class="child-header-nav child-nav-galleria">
      <div class="child-header-nav-wrap">
        <div class="container">
          <div class="row justify-content-end">
            <div class="col-3">
              <img src="' . $img . '" title="Gallery">
            </div>
            <div class="col-7">
              <div class="row">
                <div class="col-lg">
                  <ul class="list-inline list-group-flush child-header-nav">
                    ' . do_shortcode('[get_sidebar name=Galleria]') . '
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="col-lg pl-3 child-header-nav-copy edm-grey">
                ' . get_field('galaria_copy', 21) . '
                </div>
              </div>
              <div class="row">
                <div class="col-lg">
                  <div class="row">
                    <div class="col-md-7">
                      <a class="child-header-nav-btn" href="/gallery/#21" title="See More" data-type="galleria">
                        <button class="btn btn-default">See More</button>
                      </a>
                    </div>
                    <div class="col-md-5">
                      ' . do_shortcode('[get_sidebar name="Social"]') . '
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';
    return $html;
  }



}
