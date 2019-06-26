<?php
/**
 * Lost password form
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

wc_print_notices(); ?>

<div class="container-flex vingaro-gradient-v-d-l py-4 " style="margin-top: 70px; height: 90vh">
	<div class="container text-center py-2" id="customer_login">
		<div class="row justify-content-center">
			<div class="col-sm-6 col-md-4">
				<form method="post">
					<p>
						<?php
							echo apply_filters( 'woocommerce_lost_password_message',
								esc_html__( 'Lost your password? Please enter your username or email address, you will
									receive a link to create a new password via email.', 'woocommerce' ) );
						?>
					</p>
					<div class="form-group my-2">
				    <label for="user_login" class="sr-only"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
				    <input type="text" readonly class="form-control" id="user_login" name="user_login"
							autocomplete="username" placeholder="Username/Email">
				  </div>

				  <button type="submit" class="btn btn-primary my-2" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>">
						<?php esc_html_e( 'Reset password', 'woocommerce' ); ?>
					</button>

					<!--<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
						<label for="user_login"><?php //esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
						<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
					</p>

					<div class="clear"></div>-->

					<?php do_action( 'woocommerce_lostpassword_form' ); ?>

					<!--<p class="woocommerce-form-row form-row">
						<input type="hidden" name="wc_reset_password" value="true" />
						<button type="submit" class="woocommerce-Button button" value="<?php //esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
					</p>-->

					<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

				</form>
			</div>
		</div>
	</div>
</div>
