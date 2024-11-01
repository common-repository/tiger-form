<?php

function tiger_form_data_insert_form_ultimate_checkbox_shortcode( $option ) {

	global $tiger_form_checkbox_columns, $tiger_form_materials;

	extract( shortcode_atts( array(
		'label'   => '',
		'options' => '',
		'checked' => '',
		'class'   => '',
		'value'   => '',

	), $option ) );

	$args   = array(
		'label'   => $label,
		'options' => $options,
		'checked' => $checked,
		'class'   => $class,
		'value'   => $value,
	);
	$output = '';

	$output .= '<div class="dfu-input-div ' . trim( $class ) . ' ">';
	if ( ! empty( esc_html( trim( $label ) ) ) ) {
		$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '</label>';
	}

	if ( ! empty( $options ) ) {
		$optionArr = explode( '/', $options );
		if ( empty( $value ) ) {
			$dvalueArr  = array();
			$countValue = count( $dvalueArr );
		} else {
			$dvalueArr  = explode( '/', $value );
			$countValue = count( $dvalueArr );
		};
		$countOption = count( $optionArr );
		if ( $countOption > $countValue ) {
			$loopvalue = $countOption - $countValue;
			for ( $i = 0; $i < $loopvalue; $i ++ ) {
				array_push( $dvalueArr, $optionArr[ $countValue + $i ] );
			}

		} elseif ( $countOption < $countValue ) {
			$loopvalue = $countValue - $countOption;
			for ( $i = 0; $i < $loopvalue; $i ++ ) {
				array_pop( $dvalueArr );
			}
		}
		$optionArrCom = array_combine( $dvalueArr, $optionArr );
		foreach ( $optionArrCom as $key => $value ) {
			$tvalue = $tiger_form_materials->tiger_form_name_sanitization( $label );
			array_push( $tiger_form_checkbox_columns, 'checkbox-' . $tvalue . '-' . $tiger_form_materials->tiger_form_name_sanitization( $key ) );
			$output .= '<input id="' . $tvalue . '-' . $tiger_form_materials->tiger_form_name_sanitization( $key ) . '" type="checkbox" name="' . $tvalue . '-' . $tiger_form_materials->tiger_form_name_sanitization( $key ) . '" value="' . trim( $key ) . '" class="dfu-input dfu-checkbox"';
			if ( trim( $checked ) == '' ) {
				$output .= ' />';
			} elseif ( strtolower( trim( $checked ) ) == strtolower( trim( $value ) ) ) {
				$output .= ' checked />';
			} else {
				$output .= ' />';
			}

			$output .= '<label class="dfu-span" for="' . $tvalue . '-' . $tiger_form_materials->tiger_form_name_sanitization( $key ) . '">' . esc_html( trim( $value ) ) . '</label>';
		}
	} else {
		$output .= 'Option is Missing ! Add at Least One Option';
	}
	$output .= '</div>';

	return $output;
}

add_shortcode( 'dfu_checkbox', 'tiger_form_data_insert_form_ultimate_checkbox_shortcode' );