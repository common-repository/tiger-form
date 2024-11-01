<?php

add_action( 'wp_ajax_difu_form_alert_unique_validate', 'difu_form_alert_unique_validate' );
add_action( 'wp_ajax_nopriv_difu_form_alert_unique_validate', 'difu_form_alert_unique_validate' );

function difu_form_alert_unique_validate() {
	global $tiger_form_materials;
	if ( $_POST['action'] == 'difu_form_alert_unique_validate' && wp_verify_nonce( $_POST['wp_nonce'], 'dfu-form-submit-' . intval( $_POST['formId'] ) ) ) {
		global $wpdb;
		$getId       = intval( $_POST['formId'] );
		$searchTable = $wpdb->prefix . 'tiger_form_' . $getId;
		$table_name  = $wpdb->prefix . 'tiger_forms_main';
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $searchTable ) ) === $searchTable ) {
			$getColumn      = $tiger_form_materials->tiger_form_name_sanitization( $_POST['name'] ); //ref functions.php
			$getFieldId     = $tiger_form_materials->tiger_form_name_sanitization( $_POST['fieldId'] ); //ref functions.php
			$concludeColumn = str_replace( "-", "_", $getColumn );
			$getVal         = sanitize_text_field( $_POST['val'] );
			$getVal         = $tiger_form_materials->data_purify( $getVal );
			$checkId        = $wpdb->get_var( "SELECT COUNT(id) FROM $searchTable  WHERE $concludeColumn = '$getVal'" );
			if ( $checkId > 0 ) {
				$getAlertResults = $wpdb->get_row( "SELECT form_messages FROM $table_name WHERE form_post_id = '$getId' AND status = 'Active'" );
				$alertFinding    = explode( "-", $getAlertResults->form_messages );
				$returnMsg       = array(
					'value'    => 'Found',
					'name'     => $getFieldId,
					'status'   => 'success',
					'errorMsg' => $alertFinding[2]
				);
				echo json_encode( $returnMsg );
				wp_die();
			} else {
				$returnMsg = array(
					'value'  => 'notFound',
					'status' => 'success'
				);
				echo json_encode( $returnMsg );
				wp_die();
			}
		} else {
			$returnMsg = array(
				'value'  => 'notFound',
				'status' => 'success'
			);
			echo json_encode( $returnMsg );
			wp_die();
		}
	} else {
		$returnMsg = array(
			'status' => 'failed'
		);
		echo json_encode( $returnMsg );
		wp_die();
	}
}
