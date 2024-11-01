<?php

add_action( 'wp_ajax_difu_form_insert_action', 'difu_data_insert_form_ultimate_form_insert_action' );

function difu_data_insert_form_ultimate_form_insert_action() {

	global $wpdb, $tiger_form_materials;


	if ( isset( $_POST['action'] ) && wp_verify_nonce( $_POST['dfu-nonce'], 'dfu-validate-my-nonce' ) ) {

		set_transient( 'dfu-form-insert-success', true, 30 );

		if ( empty( sanitize_text_field( $_POST['data_form_title'] ) ) ) {
			$formTitle = 'Untitled';
		} else {
			$formTitle = sanitize_text_field( $_POST['data_form_title'] );
		}

		$formContent = preg_replace( '/\\\\/', '', $_POST['form-content'] );

		$user_id         = get_current_user_id();
		$dfu_post_insert = array(
			'post_author'    => $user_id,
			'post_content'   => sanitize_textarea_field( $formContent ),
			'post_title'     => $formTitle,
			'post_status'    => 'publish',
			'post_type'      => 'tiger_form',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'post_parent'    => 0,
			'menu_order'     => 0,
		);

		$postid      = wp_insert_post( $dfu_post_insert );
		$table_posts = $wpdb->prefix . 'posts';
		$wpdb->update( $table_posts, [ 'guid' => get_option( 'siteurl' ) . "/?post_type=tiger_form&p=" . $postid ], [ 'ID' => $postid ] );


		$table            = $wpdb->prefix . 'tiger_forms_main';
		$formNameGenarate = 'tiger_form_' . $postid;

		$tiger_form_materials->tiger_form_create_parent_table();

		$msg = sanitize_text_field( $_POST['successful-msg'] ) . '-' . sanitize_text_field( $_POST['faild-msg'] ) . '-' . sanitize_text_field( $_POST['error-msg'] ) . '-' . sanitize_text_field( $_POST['required-msg'] ) . '-' . sanitize_text_field( $_POST['email-invalid-msg'] ) . '-' . sanitize_text_field( $_POST['url-invalid-msg'] ) . '-' . sanitize_text_field( $_POST['number-max-msg'] ) . '-' . sanitize_text_field( $_POST['number-min-msg'] );

		$notification = sanitize_text_field( $_POST['notify-allow'] );

		if ( empty( $notification ) ) {
			$notification = 'no';
		} else {
			$notification = 'yes';
		}

		$notification_email = sanitize_email( $_POST['notify-email'] );

		$data   = array(
			'form_name'          => $formNameGenarate,
			'form_messages'      => $msg,
			'notification'       => $notification,
			'notification_email' => $notification_email,
			'form_post_id'       => $postid,
			'status'             => 'Active',
			'form_display_name'  => $formTitle . ' ' . $postid
		);
		$format = array( '%s', '%s' );
		$wpdb->insert( $table, $data, $format );

		$insertionAlert = array(
			'value' => 1,
			'id'    => $postid
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
