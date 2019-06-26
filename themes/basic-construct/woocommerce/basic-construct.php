<?php
/*
function form_field($key, $args, $value = null) {
  $defaults = array(
    'type'              => 'text',
    'label'             => '',
    'description'       => '',
    'placeholder'       => '',
    'maxlength'         => false,
    'required'          => false,
    'autocomplete'      => false,
    'id'                => $key,
    'class'             => array(),
    'label_class'       => array(),
    'input_class'       => array(),
    'return'            => false,
    'options'           => array(),
    'custom_attributes' => array(),
    'validate'          => array(),
    'default'           => '',
    'autofocus'         => '',
    'priority'          => '',
  );

  $args = wp_parse_args( $args, $defaults );
  $args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

  if ( $args['required'] ) {
    $args['class'][] = 'validate-required';
    $required        = '&nbsp;<abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
  } else {
    $required = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
  }

  if ( is_string( $args['label_class'] ) ) {
    $args['label_class'] = array( $args['label_class'] );
  }

  if ( is_null( $value ) ) {
    $value = $args['default'];
  }

  // Custom attribute handling.
  $custom_attributes         = array();
  $args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );

  if ( $args['maxlength'] ) {
    $args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
  }

  if ( ! empty( $args['autocomplete'] ) ) {
    $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
  }

  if ( true === $args['autofocus'] ) {
    $args['custom_attributes']['autofocus'] = 'autofocus';
  }

  if ( $args['description'] ) {
    $args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
  }

  if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
    foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
      $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
    }
  }

  if ( ! empty( $args['validate'] ) ) {
    foreach ( $args['validate'] as $validate ) {
      $args['class'][] = 'validate-' . $validate;
    }
  }

  $label_id        = $args['id'];
  $sort            = $args['priority'] ? $args['priority'] : '';

  $control = 'control_' . $args['type'];

  $field = '
  <div class="form-group row">'.
     $control($key, $args, $value, $custom_attributes) . '
  </div>';

  $field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

  $field = apply_filters( 'woocommerce_form_field', $field, $key, $args, $value );

  if ( $args['return'] ) {
    return $field;
  } else {
    echo $field; // WPCS: XSS ok.
  }

}

function control_text($key, $args, $value = null, $custom_attributes = null)
{
  return '
    <label for="text" class="col-form-label">' .$args['label'] . '</label>
    <input type="text" placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . ' value="' . $value . '" class="form-control">';
}

function control_textarea($key, $args, $value = null, $custom_attributes = null)
{

}

function control_state($key, $args, $value = null, $custom_attributes = null)
{

  $for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );

  $states      = WC()->countries->get_states( $for_country );

  if ( is_array( $states ) && empty( $states ) ) {

    $field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

    $field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" readonly="readonly" />';

  } elseif ( ! is_null( $for_country ) && is_array( $states ) ) {

    $field .= '
      <label for="text" class="col-form-label">' .$args['label'] . '</label>
      <select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '"
        class="form-control ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
      <option value="">' . esc_html__( 'Select a state&hellip;', 'woocommerce' ) . '</option>';

    foreach ( $states as $ckey => $cvalue ) {
      $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
    }

    $field .= '</select>';

  } else {

    $field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

  }
  return $field;
}

function control_country($key, $args, $value = null, $custom_attributes = null)
{
  $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

  if ( 1 === count( $countries ) ) {

    //$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

    //$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode(' ', $custom_attributes ) . ' class="country_to_state" readonly="readonly" />';

  } else {
    $field = '<label for="text" class="col-form-label">' .$args['label'] . '</label>
    <select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . '><option value="">' . esc_html__( 'Select a country&hellip;', 'woocommerce' ) . '</option>';

    foreach ( $countries as $ckey => $cvalue ) {
      $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
    }

    $field .= '</select>';

    $field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'woocommerce' ) . '">' . esc_html__( 'Update country', 'woocommerce' ) . '</button></noscript>';
  }
  return $field;
}

function control_tel($key, $args, $value = null)
{

}

function control_email($key, $args, $value = null)
{

}

function control_pwd($key, $args, $value = null)
{

}
*/
