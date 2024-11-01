<?php

function tiger_form_data_insert_form_ultimate_radio_shortcode( $option ) {

	global $tiger_form_radio_columns, $tiger_form_materials;

	extract( shortcode_atts( array(
		'name'    => '',
		'label'   => '',
		'options' => '',
		'checked' => '',
		'class'   => '',

	), $option ) );

	$args = array(
		'name'    => $name,
		'label'   => $label,
		'options' => $options,
		'checked' => $checked,
		'class'   => $class,
	);
	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Radio Button Name is Missing !</div>';
	} else {
		$tiger_form_radio_columns = 'radio-' . $tiger_form_materials->tiger_form_name_sanitization( $name );
		$optionArr                = explode( '/', $options );
		$output                   = '';
		$output                   .= '<div class="dfu-input-div ' . trim( $class ) . '">';
		if ( ! empty( esc_html( trim( $label ) ) ) ) {
			$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '</label>';
		}

		foreach ( $optionArr as $value ) {
			$output .= '<input id="' . $tiger_form_materials->tiger_form_name_sanitization( $value ) . '" type="radio" class="dfu-input dfu-radio-button" name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '" value="' . trim( $value ) . '"';
			if ( strtolower( trim( $checked ) ) == strtolower( trim( $value ) ) ) {
				$output .= 'checked />';
			} else {
				$output .= ' />';
			}

			$output .= '<label class="dfu-span" for="' . $tiger_form_materials->tiger_form_name_sanitization( $value ) . '">' . esc_html( trim( $value ) ) . '</label>';
		}
		$output .= '</div>';

		return $output;
	}

}

add_shortcode( 'dfu_radio', 'tiger_form_data_insert_form_ultimate_radio_shortcode' );