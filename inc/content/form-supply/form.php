<?php

add_action( 'wp_ajax_difu_forntend_data_submit', 'difu_forntend_data_submit' );
add_action( 'wp_ajax_nopriv_difu_forntend_data_submit', 'difu_forntend_data_submit' );

function difu_forntend_data_submit() {
	global $tiger_form_materials;
	if ( $_POST['action'] == 'difu_forntend_data_submit' && wp_verify_nonce( $_POST['wp_nonce'], 'dfu-form-submit-' . intval( $_POST['form-id'] ) ) ) {

		global $wpdb;
		$myFormId    = intval( $_POST['form-id'] );
		$searchTable = $wpdb->prefix . 'tiger_form_' . $myFormId;
		$table       = $wpdb->prefix . 'tiger_forms_main';
		$table_post  = $wpdb->prefix . 'posts';
		$results            = $wpdb->get_results( "SHOW COLUMNS FROM $searchTable" );
		$columnForInsertion = array();
		foreach ( $results as $field ) {
			if ( $field->Field == 'id' )
				continue;
			elseif ( $field->Field == 'time_and_date' )
				continue;
			else
				array_push( $columnForInsertion, $field->Field );
		}
		$insertionValue = array();
		foreach ( $columnForInsertion as $column ) {
			$columnExplode = explode( "_", $column );
			$firstPrefix   = $columnExplode[0];
			array_shift( $columnExplode );
			$tiger_form_data_purify = $tiger_form_materials->data_purify($_POST[ implode( "-", $columnExplode ) ]);
			if ( $firstPrefix == 'email' )
				array_push( $insertionValue,  sanitize_email($tiger_form_data_purify) );
			elseif ( $firstPrefix == 'number' )
				array_push( $insertionValue, intval( $tiger_form_data_purify ) );
			elseif ( $columnExplode[0] == 'textarea' )
				array_push( $insertionValue, sanitize_textarea_field( $tiger_form_data_purify ) );
			elseif ( $columnExplode[0] == 'url' )
				array_push( $insertionValue, esc_url_raw( $tiger_form_data_purify ) );
			else
				array_push( $insertionValue, sanitize_text_field( $tiger_form_data_purify ) );
		}
		if ( empty( get_option( 'timezone_string' ) ) ) {
			$min        = 60 * get_option( 'gmt_offset' );
			$sign       = $min < 0 ? "-" : "+";
			$absmin     = abs( $min );
			$timezone   = sprintf( "UTC%s%02d:%02d", $sign, $absmin / 60, $absmin % 60 );
			$insertDate = get_date_from_gmt( $timezone, "Y-m-d H:i:s" );
		} else {
			date_default_timezone_set( get_option( 'timezone_string' ) );
			$insertDate = date( "Y-m-d" ) . ' ' . date( "H:i:s" );
		}
		array_push( $insertionValue, $insertDate );
		array_push( $columnForInsertion, 'time_and_date' );
		$finalValue = array_combine( $columnForInsertion, $insertionValue );
		$format     = array( '%s', '%s' );
		$wpdb->insert( $searchTable, $finalValue, $format );
		$insertId        = $wpdb->insert_id;
		$getAlertResults = $wpdb->get_row( "SELECT form_messages, notification, notification_email FROM $table WHERE form_post_id = '$myFormId' AND status = 'Active'" );

		if ( strtolower( $getAlertResults->notification ) == 'yes' ) {
			$getAuthorInfo = $wpdb->get_row( "SELECT post_author FROM $table_post WHERE ID = '$myFormId'" );
			$author        = get_the_author_meta( 'display_name', $getAuthorInfo->post_author );
			require_once $tiger_form_materials->tiger_form_plugin_dir_path( 'inc/tiger-classes/push-mail.php' );
			$notifyMail = new tiger_form_ultimate\push_notify_mail();
			$notifyMail->tiger_form_notification_push( $myFormId, $insertId, $author );
		}

		$alertFinding = explode( "-", $getAlertResults->form_messages );
		$response     = array(
			'value' => 'success',
			'Msg'   => $alertFinding[0]
		);
		echo json_encode( $response );
		wp_die();
	}
}
