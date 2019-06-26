<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.9
 */

if (!defined('ABSPATH')) {
	exit;
}

include_once(__DIR__ . '/../basic-construct.php');
?>
	<h3 style="margin-left: -15px">
	<?php
		if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) {
			echo _e( 'Billing &amp; Shipping', 'woocommerce' );
		} else {
			echo _e( 'Billing details', 'woocommerce' );
		}
	?>
	</h3>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php

		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {

			form_field( $key, $field, $checkout->get_value( $key ) );

		}
	?>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="createaccount" name="createaccount"
				 <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?>>
			  <label class="form-check-label" for="createaccount">
			    <?php _e( 'Create an account?', 'woocommerce' ); ?>
			  </label>
			</div>
		<!--	<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="form-check-input" id=""  type="checkbox"  value="1" />
				</label>
				<span></span>
			</p>-->

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
