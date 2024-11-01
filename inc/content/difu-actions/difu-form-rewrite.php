<?php

add_action( 'wp_ajax_difu_update_published_form', 'difu_data_insert_form_ultimate_update_published_form' );

function difu_data_insert_form_ultimate_update_published_form() {

	global $wpdb, $tiger_form_materials;

	if ( $_POST['action'] == 'difu_update_published_form' && wp_verify_nonce( $_POST['dfu-nonce'], 'dfu-validate-my-edited-nonce' ) ) {

		set_transient( 'dfu-form-update-success', true, 30 );
		$table = $wpdb->prefix . 'tiger_forms_main';
		if ( empty( sanitize_text_field( $_POST['data_form_title_up'] ) ) )
			$formTitle = 'Untitled';
		else
			$formTitle = sanitize_text_field( $_POST['data_form_title_up'] );

		$getId = intval( $_POST['formid'] );

		$formContent = preg_replace( '/\\\\/', '', $_POST['form-content-up'] );

		$dfu_post_update = array(
			'ID'           => $getId,
			'post_content' => sanitize_textarea_field( $formContent ),
			'post_title'   => $formTitle,
		);

		wp_update_post( $dfu_post_update );
		$checked = $wpdb->get_var( "SELECT COUNT(id) FROM $table WHERE form_post_id = '$getId'" );
		$msg     = sanitize_text_field( $_POST['successful-msg-up'] ) . '-' . sanitize_text_field( $_POST['faild-msg-up'] ) . '-' . sanitize_text_field( $_POST['error-msg-up'] ) . '-' . sanitize_text_field( $_POST['required-msg-up'] ) . '-' . sanitize_text_field( $_POST['email-invalid-msg-up'] ) . '-' . sanitize_text_field( $_POST['url-invalid-msg-up'] ) . '-' . sanitize_text_field( $_POST['number-max-msg-up'] ) . '-' . sanitize_text_field( $_POST['number-min-msg-up'] );

		$notification = sanitize_text_field( $_POST['notify-allow-up'] );

		if ( empty( $notification ) )
			$notification = 'no';
		else
			$notification = 'yes';

		$notification_email = sanitize_email( $_POST['notify-email-up'] );
		if ( $checked == 1 ) {
			$data = array(
				'form_messages'      => $msg,
				'notification'       => $notification,
				'notification_email' => $notification_email
			);
			$wpdb->update( $table, $data, array( 'form_post_id' => $getId ) );
		} else {
			$tiger_form_materials->tiger_form_create_parent_table();
			$formNameGenarate = 'tiger_form_' . $getId;
			$data             = array(
				'form_name'          => $formNameGenarate,
				'form_messages'      => $msg,
				'notification'       => $notification,
				'notification_email' => $notification_email,
				'form_post_id'       => $getId,
				'status'             => 'Active',
				'form_display_name'  => $formTitle . ' ' . $getId
			);
			$format           = array( '%s', '%s' );
			$wpdb->insert( $table, $data, $format );
		}
		$insertionAlert = array(
			'value' => 1,
			'id'    => $getId
		);
		echo json_encode( $insertionAlert );

		wp_die();
	} else {

		$insertionAlert = array(
			'value' => 2
		);
		echo json_encode( $insertionAlert );
		wp_die();
	}

}

?>