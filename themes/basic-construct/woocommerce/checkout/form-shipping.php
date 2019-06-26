<?php
/**
 * Checkout shipping information form
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="woocommerce-shipping-fields">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

		<h3 id="ship-to-different-address">
			<div class="form-check">
				<input id="ship-to-different-address-checkbox" class="form-check-input" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
				<label class="form-check-label">
					<?php _e( 'Ship to a different address?', 'woocommerce' ); ?>
				</label>
			</div>
		</h3>

		<div class="shipping_address" style="margin: 0; padding: 0">

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

				<?php
					$fields = $checkout->get_checkout_fields( 'shipping' );

					foreach ( $fields as $key => $field ) {
						//if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
						//	$field['country'] = $checkout->get_value( $field['country_field'] );
						//}
						//woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
						form_field( $key, $field, $checkout->get_value( $key ) );
					}
				?>
				<div class="form-group">
					<label for="order_comments">Order Comments</label>
					<textarea name="order_comments" class="form-control" id="order_comments" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
				</div>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

	<?php endif; ?>
</div>
<div class="woocommerce-additional-fields">
	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

		<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

			<h3><?php _e( 'Additional information', 'woocommerce' ); ?></h3>

		<?php endif;?>

		<div class="woocommerce-additional-fields__field-wrapper">
			<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
				<?php
					form_field( $key, $field, $checkout->get_value( $key ) ); ?>
			<?php endforeach; ?>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>
