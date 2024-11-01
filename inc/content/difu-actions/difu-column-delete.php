<?php
add_action( 'wp_ajax_difu_delete_auto_table_columns', 'difu_delete_auto_table_columns' );

function difu_delete_auto_table_columns() {

	if ( $_POST['action'] == 'difu_delete_auto_table_columns' && wp_verify_nonce( $_POST['wpnonce'], 'dfu-validate-column-delete' ) ) {
		global $wpdb;
		$id                   = intval( $_POST['id'] );
		$index                = intval( $_POST['index'] );
		$table_name           = $wpdb->prefix . 'tiger_forms_main';
		$table_deleted_column = $wpdb->prefix . 'tiger_form_' . $id;

		$getrow      = $wpdb->get_row( "SELECT table_columns_name FROM $table_name WHERE form_post_id = '$id'" );
		$getrowarray = explode( ',', rtrim( $getrow->table_columns_name, ',' ) );
		unset( $getrowarray[ $index ] );
		$finalizeField = implode( ",", $getrowarray );
		$wpdb->update( $table_name, array( 'table_columns_name' => $finalizeField ), array( 'form_post_id' => $id ) );

		$results      = $wpdb->get_results( "SHOW COLUMNS FROM $table_deleted_column" );
		$tableColumns = array();

		foreach ( $results as $value ) {
			if ( $value->Field == 'id' )
				continue;
			elseif ( $value->Field == 'time_and_date' )
				continue;
			else
				array_push( $tableColumns, $value->Field );
		}
		$getDeletedColumn = $tableColumns[ $index ];
		$wpdb->query( "ALTER TABLE $table_deleted_column DROP COLUMN $getDeletedColumn" );
		set_transient( 'dfu-column-delete-success', true, 30 );
		$response = array(
			'value' => 1,
			'id'    => $id
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
