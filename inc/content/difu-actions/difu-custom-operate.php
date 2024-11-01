<?php
add_action( 'wp_ajax_difu_delete_published_form', 'difu_data_insert_form_ultimate_delete_published_form' );

function difu_data_insert_form_ultimate_delete_published_form() {

	if ( $_POST['action'] == 'difu_delete_published_form' && wp_verify_nonce( $_POST['nonce'], 'dfu-validate-my-edited-nonce' ) ) {

		global $wpdb;

		$table_name = $wpdb->prefix . 'posts';
		$getId      = intval( $_POST['id'] );
		$checkId    = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_name WHERE post_type = 'tiger_form' AND ID = '$getId' " );
		if ( $checkId == 1 ) {
			$wpdb->delete( $table_name, array( 'ID' => $getId ) );
			$wpdb->update( $wpdb->prefix . 'tiger_forms_main', array( 'status' => 'Deleted' ), array( 'form_post_id' => $getId ) );
			set_transient( 'dfu-form-delete-success', true, 30 );
			$msg = array(
				'value' => 1
			);
			echo json_encode( $msg );
			wp_die();

		} else {
			$msg = array(
				'value' => 2
			);
			echo json_encode( $msg );
			wp_die();
		}
	} else {

		$msg = array(
			'value' => 2
		);
		echo json_encode( $msg );
		wp_die();
	}
}
