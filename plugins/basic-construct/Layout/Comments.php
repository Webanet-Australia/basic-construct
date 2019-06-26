<?php
namespace BC\Layout;

class Comments extends Layout
{
  public static function getFeature($post, $comments)
  {
    $rv =
        wp_list_comments([
        'walker' => new \BC\Walker\Comments,
    		 'per_page' => 10,
    		 'reverse_top_level' => false
  		  ],
        $comments) . '
       </div>
       <div class="container my-4">
          <form action="' . get_option('siteurl') . '/wp-comments-post.php" method="post" id="" class="comment-form">
            <input type="hidden" name="comment_post_ID" value="' . $post->ID . '" id="comment_post_ID" />
            <input type="hidden" name="comment_parent" id="comment_parent" value="0" />
            <div class="form-group">
              <label for="comment">Add your comments:</label>
              <textarea id="comment" class="form-control" placeholder="Message" name="comment"></textarea>
            </div>
            <input class="btn btn-primary" name="submit" type="submit" id="" value="Add Commment" />
          </form>
      </div>';
    return $rv;
  }
}
