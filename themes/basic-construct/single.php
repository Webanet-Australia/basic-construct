<?php
/**
  * Template Name: Blog Page
 **/
 global $post;

 get_header();

?>
<div class="container bc-blog-posts">
  <div class="row">
    <div class="col-lg">
      <h5><?=BC\Posts\Blog::getDate($post->post_date)?>
      <h4><?=$post->post_title?></h4>
    </div>
  </div>
  <div class="row">
    <div class="col-lg">
      <img src="<?=BC\Posts\Blog::getImage($post->ID)?>" alt="<?=$post->post_title?>">
    </div>
  </div>
  <div class="row bc-blog-content">
    <div class="col-sm-8 blog-list pl-4 pr-4">
      <?=$post->post_content?>
    </div>
    <div class="col-sm-4 text-left bc-blog-sidebar">
      <?=BC\Posts\Recent::sidebar(3)?>
      <?=BC\Posts\Tags::popular(8)?>
    </div>
  </div>
  <div class="row">
    <div class="col-lg pl-4 pr-4">
      <p class="bc-tags"><?=BC\Posts\Tags::byPost($post->ID)?></p>
    </div>
  </div>
</div><?php
echo '<br/>';
echo comments_template();
comment_form();

get_footer();
