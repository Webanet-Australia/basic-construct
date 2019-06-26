<?php
/**
 * Login Form
 * Basic-Construct Boostrap 4
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if (! defined('ABSPATH')) {
    exit;
}

wc_print_notices();

do_action('woocommerce_before_customer_login_form');

if (!get_option('woocommerce_enable_myaccount_registration') === 'yes') {
	print '
	<h1>User accounts disabled by setting</h1>
	<h2>Settings: Allow customers to create an account on the "My account" page<h2>
	<a class="btn btn-primary" href="http://vino.local/wp-admin/admin.php?page=wc-settings&tab=account" title="Edit Account Settings">
			Edit account settings
	</a>';
} else { ?>
<div class="container-flex vingaro-gradient-v-d-l py-4 " style="margin-top: 80px;">
  <div class="row">
    <div class="col-md-5 offset-md-1 col-sm-12">
      <div class="container mt-4 text-center">
      	<div class="row justify-content-center">
      		<div class="col-md-12 text-center"> <?php
            $sm = get_field('accounts_signup_heading', $post->ID);
            if (strlen($sm) > 0) {
              print apply_filters('the_content', $sm);
            } else { ?>
        		    <h2 class="mt-2"><?php esc_html_e('Create Account', 'woocommerce'); ?></h2> <?php
            }?>
        		<form method="post" class="form-inline justify-content-center">

        			<?php do_action('woocommerce_register_form_start'); ?>
        			<div class="form-group mb-2">
        	    	<label for="reg_email" class="sr-only"><?php esc_html_e('Email address', 'woocommerce'); ?></label>
        				<input type="email" class="form-control" id="reg_email" name="email" autocomplete="email" placeholder="Email" value="<?php echo (! empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>">
        			</div>

        			<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>

              <button type="submit" class="btn btn-primary mb-2 mx-sm-3" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
        			<?php do_action('woocommerce_register_form_end'); ?>
        		</form>
        		<div class="my-2"><?php do_action('woocommerce_register_form'); ?></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5 col-sm-12">
      <div class="container text-center py-2" id="customer_login">
    		<div class="row justify-content-center">
    			<div class="col-sm-12 col-md-8">
    				<form method="post">
    					<div class="card text-center">
    						<div class="card-header">
    							<h3 class="pt-2"><?php esc_html_e('Login', 'woocommerce'); ?></h3>
    				 		</div>
    				 		<div class="card-body pt-0">

    							<?php do_action('woocommerce_login_form_start'); ?>

    							<input type="text" class="form-control my-3" id="username" name="username" placeholder="Username/ Email"
    										value="<?=((!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : '')?>">

    							<input type="password" class="form-control my-3" name="password" id="password" placeholder="Password" autocomplete="current-password">

    							<?php do_action('woocommerce_login_form'); ?>
                  <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
    							<button type="submit" class="btn btn-primary btn-block my-3"
                    name="login"
    								value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?>
    							</button>

    							<label class="checkbox float-left mt-1">
    	              <input type="checkbox" id="rememberme" value="forever">
    	              <?php esc_html_e('Remember Me', 'woocommerce'); ?>
    	            </label>

    							<a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="float-right mt-1">
    								<?php esc_html_e('Forgotten Password', 'woocommerce'); ?>
    							</a>

    							<?php do_action('woocommerce_login_form_end'); ?>
    						</div>
    					</div>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
  </div>
</div>


<?php
}

do_action('woocommerce_after_customer_login_form'); ?>
