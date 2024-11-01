<?php
add_action( 'wp_ajax_difu_delete_auto_created_table', 'difu_data_insert_form_ultimate_delete_auto_created_table' );

function difu_data_insert_form_ultimate_delete_auto_created_table() {

	if ( $_POST['action'] == 'difu_delete_auto_created_table' && wp_verify_nonce( $_POST['wpnonce'], 'dfu-validate-table-delete' ) ) {
		global $wpdb;
		$id                 = intval( $_POST['id'] );
		$table_name         = $wpdb->prefix . 'tiger_forms_main';
		$deleted_table_name = $wpdb->prefix . 'tiger_form_' . $id;

		$getrow = $wpdb->get_row( "SELECT status FROM $table_name WHERE form_post_id = '$id'" );

		if ( $getrow->status == 'Deleted' ) {
			$wpdb->delete( $table_name, array( 'form_post_id' => $id ) );
			$wpdb->query( "DROP TABLE IF EXISTS $deleted_table_name" );
		} else {
			$wpdb->query( "DROP TABLE IF EXISTS $deleted_table_name" );
			$wpdb->update( $table_name, array( 'table_columns_name' => '' ), array( 'form_post_id' => $id ) );
		}
		set_transient( 'dfu-table-delete-success', true, 30 );
		$response = array(
			'value' => 1,
		);
		echo json_encode( $response );
		wp_die();
	} else {
		$response = array(
			'value' => 2
		);
		echo json_encode( $response );
		wp_die();
	}
}
