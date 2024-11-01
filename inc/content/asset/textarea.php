<?php
function tiger_form_data_insert_form_ultimate_textarea_shortcode( $option ) {
	global $tiger_form_textarea_columns, $tiger_form_materials;
	extract( shortcode_atts( array(
		'name'        => '',
		'label'       => '',
		'value'       => '',
		'readonly'    => '',
		'class'       => '',
		'placeholder' => '',

	), $option ) );

	$args = array(
		'name'        => $name,
		'label'       => $label,
		'value'       => $value,
		'readonly'    => $readonly,
		'class'       => $class,
		'placeholder' => $placeholder,
	);

	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Textarea Field Name is Missing !</div>';
	} else {
		$tiger_form_textarea_columns = 'textarea-' . $tiger_form_materials->tiger_form_name_sanitization( $name );
		$output                      = '';
		$output                      .= '<div class="dfu-input-div ' . trim( $class ) . '">';
		if ( ! empty( esc_html( trim( $label ) ) ) ) {
			$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '</label>';
		}

		$output .= '<textarea name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '" class="dfu-input dfu-textarea-field" autocomplete="off" placeholder="' . trim( $placeholder ) . '" ';

		if ( strtolower( trim( $readonly ) ) == 'no' ) {
			$output .= '>';
		} elseif ( strtolower( trim( $readonly ) ) == 'yes' ) {
			$output .= ' readonly>';
		} else {
			$output .= '>';
		}


		$output .= trim( $value ) . '</textarea>';
		$output .= '</div>';

		return $output;
	}
}

add_shortcode( 'dfu_textarea', 'tiger_form_data_insert_form_ultimate_textarea_shortcode' );


function tiger_form_data_insert_form_ultimate_textarea_required_shortcode( $option ) {
	global $tiger_form_textarea_columns_req, $tiger_form_materials;
	extract( shortcode_atts( array(
		'name'        => '',
		'label'       => '',
		'value'       => '',
		'required'    => '',
		'readonly'    => '',
		'class'       => '',
		'placeholder' => '',

	), $option ) );

	$args = array(
		'name'        => $name,
		'label'       => $label,
		'value'       => $value,
		'required'    => $required,
		'readonly'    => $readonly,
		'class'       => $class,
		'placeholder' => $placeholder,
	);
// Things that you want to do.
	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Textarea Field Name is Missing !</div>';
	} else {
		$tiger_form_textarea_columns_req = 'textarea-' . $tiger_form_materials->tiger_form_name_sanitization( $name );
		$output                          = '';

		$output .= '<div class="dfu-input-div dfu-required ' . trim( $class ) . '">';
		if ( ! empty( esc_html( trim( $label ) ) ) ) {
			$output .= '<label class="dfu-label">' . esc_html( trim( $label ) ) . '<span title="Required field">*</span></label>';
		}

		$output .= '<textarea name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '" class="dfu-input dfu-textarea-field" required placeholder="' . trim( $placeholder ) . '" ';

		if ( strtolower( trim( $readonly ) ) == 'no' ) {
			$output .= '>';
		} elseif ( strtolower( trim( $readonly ) ) == 'yes' ) {
			$output .= ' readonly>';
		} else {
			$output .= ' >';
		}


		$output .= trim( $value ) . '</textarea>';
		$output .= '</div>';

		return $output;
	}
}

// register shortcode
add_shortcode( 'dfu_textarea*', 'tiger_form_data_insert_form_ultimate_textarea_required_shortcode' );