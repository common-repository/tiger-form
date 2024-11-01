<?php

function tiger_form_data_insert_form_ultimate_email_shortcode( $option ) {
	global $tiger_form_email_columns, $tiger_form_materials;
	extract( shortcode_atts( array(
		'name'        => '',
		'label'       => '',
		'value'       => '',
		'readonly'    => '',
		'class'       => '',
		'placeholder' => '',
		'unique'      => '',

	), $option ) );

	$args = array(
		'name'        => $name,
		'label'       => $label,
		'value'       => $value,
		'readonly'    => $readonly,
		'class'       => $class,
		'placeholder' => $placeholder,
		'unique'      => $unique,
	);
	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Email Field Name is Missing!</div>';
	} else {
		$tiger_form_email_columns = "email-" . $tiger_form_materials->tiger_form_name_sanitization( $name );
		$output                   = '';

		$output .= '<div class="dfu-input-div ' . trim( $class ) . '">';
		if ( ! empty( esc_html( trim( $label ) ) ) ) {
			$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '</label>';
		}

		$output .= '<input type="email" name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '" value="' . trim( $value ) . '" class="dfu-input dfu-email-field" autocomplete="off" placeholder="' . trim( $placeholder ) . '" ';

		if ( strtolower( trim( $unique ) ) == 'yes' ) {
			$output .= ' data-unique="yes"';
		}

		if ( strtolower( trim( $readonly ) ) == 'no' ) {
			$output .= ' />';
		} elseif ( strtolower( trim( $readonly ) ) == 'yes' ) {
			$output .= ' readonly />';
		} else {
			$output .= ' />';
		}

		$output .= '</div>';

		return $output;
	}

}

add_shortcode( 'dfu_email', 'tiger_form_data_insert_form_ultimate_email_shortcode' );

function tiger_form_data_insert_form_ultimate_email_required_shortcode( $option ) {
	global $tiger_form_email_columns_req, $tiger_form_materials;
	extract( shortcode_atts( array(
		'name'        => '',
		'label'       => '',
		'value'       => '',
		'required'    => '',
		'readonly'    => '',
		'class'       => '',
		'placeholder' => '',
		'unique'      => '',

	), $option ) );

	$args = array(
		'name'        => $name,
		'label'       => $label,
		'value'       => $value,
		'required'    => $required,
		'readonly'    => $readonly,
		'class'       => $class,
		'placeholder' => $placeholder,
		'unique'      => $unique,
	);
	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Email Field Name is Missing!</div>';
	} else {
		$tiger_form_email_columns_req = "email-" . $tiger_form_materials->tiger_form_name_sanitization( $name );
		$output                       = '';

		$output .= '<div class="dfu-input-div dfu-required ' . trim( $class ) . '">';
		if ( ! empty( esc_html( trim( $label ) ) ) ) {
			$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '<span title="Required field">*</span></label>';
		}

		$output .= '<input type="email" name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '" value="' . trim( $value ) . '" class="dfu-input dfu-email-field" required autocomplete="off" placeholder="' . trim( $placeholder ) . '" ';

		if ( strtolower( trim( $unique ) ) == 'yes' ) {
			$output .= ' data-unique="yes"';
		}

		if ( strtolower( trim( $readonly ) ) == 'no' ) {
			$output .= ' />';
		} elseif ( strtolower( trim( $readonly ) ) == 'yes' ) {
			$output .= ' readonly />';
		} else {
			$output .= ' />';
		}

		$output .= '</div>';

		return $output;
	}
}

add_shortcode( 'dfu_email*', 'tiger_form_data_insert_form_ultimate_email_required_shortcode' );