<?php

function tiger_form_data_insert_form_ultimate_date_shortcode( $option ) {

	global $tiger_form_date_columns, $tiger_form_materials;

	extract( shortcode_atts( array(
		'name'        => '',
		'label'       => '',
		'value'       => '',
		'class'       => '',
		'placeholder' => '',

	), $option ) );

	$args = array(
		'name'        => $name,
		'label'       => $label,
		'value'       => $value,
		'class'       => $class,
		'placeholder' => $placeholder,
	);

	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Date Field Name is Missing!</div>';
	} else {
		$tiger_form_date_columns = "date-" . $tiger_form_materials->tiger_form_name_sanitization( $name );
		$output                  = '';

		$output .= '<div class="dfu-input-div ' . trim( $class ) . '">';
		if ( ! empty( esc_html( trim( $label ) ) ) ) {
			$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '</label>';
		}

		$output .= '<input type="date" name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '" value="' . trim( $value ) . '" class="dfu-input dfu-date-field" autocomplete="off" placeholder="' . trim( $placeholder ) . '">';
		$output .= '</div>';

		return $output;
	}

}

add_shortcode( 'dfu_date', 'tiger_form_data_insert_form_ultimate_date_shortcode' );

function tiger_form_data_insert_form_ultimate_date_required_shortcode( $option ) {

	global $tiger_form_date_columns_req, $tiger_form_materials;
	extract( shortcode_atts( array(
		'name'        => '',
		'label'       => '',
		'value'       => '',
		'required'    => '',
		'class'       => '',
		'placeholder' => '',

	), $option ) );

	$args = array(
		'name'        => $name,
		'label'       => $label,
		'value'       => $value,
		'required'    => $required,
		'class'       => $class,
		'placeholder' => $placeholder,
	);
	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Date Field Name is Missing!</div>';
	} else {
		$tiger_form_date_columns_req = "date-" . $tiger_form_materials->tiger_form_name_sanitization( $name );
		$output                      = '';

		$output .= '<div class="dfu-input-div dfu-required ' . trim( $class ) . '">';
		if ( ! empty( esc_html( trim( $label ) ) ) ) {
			$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '<span title="Required field">*</span></label>';
		}

		$output .= '<input type="date" name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '" value="' . trim( $value ) . '" class="dfu-input dfu-date-field" required autocomplete="off" placeholder="' . trim( $placeholder ) . '">';
		$output .= '</div>';

		return $output;
	}
}

add_shortcode( 'dfu_date*', 'tiger_form_data_insert_form_ultimate_date_required_shortcode' );