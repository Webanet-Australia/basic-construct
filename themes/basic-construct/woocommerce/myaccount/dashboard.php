<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function save_wp_editor_fields(){
    global $post;
    update_post_meta($post->ID, 'bc-editor-1', $_POST['bc-editor-1']);
}
add_action( 'save_post', 'save_wp_editor_fields' );

		do_action( 'woocommerce_account_dashboard' );
?>


<div class="row">
	<div class="col-lg"><?php
		//$current_user->display_name
		//esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
		$rv = '
		<h1>Pages</h1>
		<div class="row">
			<div class="col-md-9">';
				$params = [
					'author__in' => $current_user->user_id,
					'post_type' => 'page',
				 'posts_per_page' => -1,
					'post_parent'       => 22,
				 'orderby'   => 'meta_value',
				 'order' => 'ASC'
				];
				$query = new \WP_Query($params);
				$items = $query->get_posts();

				$rv .= '
				<div class="row">
					<div class="col-lg">
						<h4>Your Pages</h4>
					</div>
					<div class="col-sm text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
							New
						</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg">
						<ul class="list-group">';
			  			foreach ($items as $item) {
								$rv .= '
								<li class="list-group-item">
									<a href="' . get_permalink($item) . '" class="list-group-item-action">' .
								 		$item->post_title . '
								 	</a>
								</li>';
							}
				$rv .= '
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<h4>Links</h4>
				<div class="list-group">
				  <a href="' . esc_url(wc_get_endpoint_url('orders')) . '" class="list-group-item list-group-item-action">
						Orders
					</a>
					<a href="' . esc_url(wc_get_endpoint_url('edit-address')) . '" class="list-group-item list-group-item-action">
						Edit Address
					</a>
					<a href="' . esc_url(wc_get_endpoint_url('edit-account' )) . '" class="list-group-item list-group-item-action">
						Edit Account
					</a>
				</div>
			</div>
		</div>';

		print $rv;





		print '<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit: ' . $item->post_title . '</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">';
			wp_editor($item->post_content, 'bc-editor-1',
				[
					'textarea_rows' => 15,
					'teeny' => true,
					'quicktags' => false,
					'textarea_name' => 'content',
					'media_buttons' => false,
				]);

			$rv =  '
      </div>
      <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>';
		print $rv;
