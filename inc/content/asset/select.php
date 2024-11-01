<?php

function tiger_form_data_insert_form_ultimate_select_shortcode( $optionData ) {
	global $tiger_form_select_columns, $tiger_form_materials;

	extract( shortcode_atts( array(
		'label'    => '',
		'name'     => '',
		'options'  => '',
		'selected' => '',
		'class'    => '',

	), $optionData ) );

	$args = array(
		'label'    => $label,
		'name'     => $name,
		'options'  => $options,
		'selected' => $selected,
		'class'    => $class,
	);


	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Select Dropdown Name is Missing !</div>';
	} else {
		$tiger_form_select_columns = 'select-' . $tiger_form_materials->tiger_form_name_sanitization( $name );
		if ( ! empty( $options ) ) {
			$optionArr = explode( '/', $options );
			$optionArr = array_unique( $optionArr );
		} else {
			$optionArr = array( "Option is missing ! Add at least one option" );
		}
		$implodeOption = implode( " ", $optionArr );
		$output        = '';
		$output        .= '<div class="dfu-input-div ' . trim( $class ) . '">';
		if ( ! empty( esc_html( trim( $label ) ) ) ) {
			$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '</label>';
		}

		$output .= '<select class="dfu-input dfu-select-field" name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '">';
		if ( empty( trim( $selected ) ) && $implodeOption != "Option is Missing ! Add at Least One Option" ) {
			$output .= '<option value="">Select Option</option>';
		}

		foreach ( $optionArr as $opt ) {
			$output .= '<option value="' . trim( $opt ) . '"';
			if ( ! empty( $selected ) && strtolower( trim( $selected ) ) == strtolower( trim( $opt ) ) ) {
				$output .= ' selected>';
			} else {
				$output .= ' >';
			}

			$output .= trim( $opt ) . '</option>';

		}

		$output .= '</select>';
		$output .= '</div>';

		return $output;
	}
}

add_shortcode( 'dfu_select', 'tiger_form_data_insert_form_ultimate_select_shortcode' );

function tiger_form_data_insert_form_ultimate_select_required_shortcode( $optionData ) {
	global $tiger_form_select_columns_req, $tiger_form_materials;
	extract( shortcode_atts( array(
		'label'    => '',
		'name'     => '',
		'options'  => '',
		'selected' => '',
		'required' => '',
		'class'    => '',

	), $optionData ) );

	$args = array(
		'label'    => $label,
		'name'     => $name,
		'options'  => $options,
		'selected' => $selected,
		'required' => $required,
		'class'    => $class,
	);


	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Select Dropdown Name is Missing !</div>';
	} else {
		$tiger_form_select_columns_req = 'select-' . $tiger_form_materials->tiger_form_name_sanitization( $name );
		if ( ! empty( $options ) ) {
			$optionArr = explode( '/', $options );
			$optionArr = array_unique( $optionArr );
		} else {
			$optionArr = array( "Option is Missing ! Add at Least One Option" );
		}
		$implodeOption = implode( " ", $optionArr );
		$output        = '';
		$output        .= '<div class="dfu-input-div dfu-required ' . trim( $class ) . '">';
		if ( ! empty( esc_html( trim( $label ) ) ) ) {
			$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '<span title="Required field">*</span></label>';
		}

		$output .= '<select class="dfu-input dfu-select-field" name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '" required >';

		if ( empty( trim( $selected ) ) && $implodeOption != "Option is Missing ! Add at Least One Option" ) {
			$output .= '<option value="">Select Option</option>';
		}

		foreach ( $optionArr as $opt ) {
			$output .= '<option value="' . trim( $opt ) . '"';
			if ( ! empty( trim( $selected ) ) && strtolower( trim( $selected ) ) == strtolower( trim( $opt ) ) ) {
				$output .= ' selected>';
			} else {
				$output .= ' >';
			}

			$output .= trim( $opt ) . '</option>';
		}

		$output .= '</select>';
		$output .= '</div>';

		return $output;
	}
}

add_shortcode( 'dfu_select*', 'tiger_form_data_insert_form_ultimate_select_required_shortcode' );