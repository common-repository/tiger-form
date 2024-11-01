<?php

add_action( 'wp_ajax_difu_form_alert_messages', 'difu_form_alert_messages' );
add_action( 'wp_ajax_nopriv_difu_form_alert_messages', 'difu_form_alert_messages' );


function difu_form_alert_messages() {
	global $wpdb;
	if ( $_POST['action'] == 'difu_form_alert_messages' && wp_verify_nonce( $_POST['nonce'], 'dfu-form-submit-' . intval( $_POST['formId'] ) ) ):

		$formId     = intval( $_POST['formId'] );
		$table_name = $wpdb->prefix . 'tiger_forms_main';

		$getAlertResults = $wpdb->get_row( "SELECT form_messages FROM $table_name WHERE form_post_id = '$formId' AND status = 'Active'" );
		$successArr      = array(
			'value' => 'success',
			'data'  => $getAlertResults->form_messages
		);
		echo json_encode( $successArr );
		wp_die();
	else:
		$failedArr = array(
			'value' => 'failednonce'
		);
		echo json_encode( $failedArr );
		wp_die();
	endif;
}
