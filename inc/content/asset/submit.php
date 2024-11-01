<?php

function tiger_form_data_insert_form_ultimate_submit_button_shortcode( $option ) {
	global $tiger_form_materials;
	extract( shortcode_atts( array(
		'name'  => '',
		'label' => '',
		'class' => '',

	), $option ) );

	$args = array(
		'name'  => $name,
		'label' => $label,
		'class' => $class,
	);

	if ( empty( trim( $name ) ) ) {
		return '<div class="dfu-missing-error">Submit Button Name is Missing !</div>';
	} else {
		$output = '';
		$output .= '<div class="dfu-input-div ' . trim( $class ) . '">';
		$output .= '<button type="button" name="' . $tiger_form_materials->tiger_form_name_sanitization( $name ) . '" class="dfu-input-btn dfu-btn">';

		if ( empty( esc_html( trim( $label ) ) ) ) {
			$output .= 'Submit</button>';
		} else {
			$output .= esc_html( trim( $label ) ) . '</button> <img src="' . $tiger_form_materials->tiger_form_plugin_dir_url( 'inc/image/dfu-spinner.gif' ) . '" class="dfu-spiner" style="width:25px !important;">';
		}

		$output .= '</div>';
		$output .= '</form>';

		return $output;
	}
}

// register shortcode
add_shortcode( 'dfu_submit', 'tiger_form_data_insert_form_ultimate_submit_button_shortcode' );