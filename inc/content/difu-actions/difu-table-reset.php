<?php
add_action( 'wp_ajax_difu_data_table_reset', 'difu_data_table_reset' );

function difu_data_table_reset() {
	if ( isset( $_POST['table'] ) ) {
		global $wpdb;
		$table     = $wpdb->prefix . 'tiger_forms_main';
		$form_name = sanitize_text_field( $_POST['table'] );
		$tableName = $wpdb->prefix . sanitize_text_field( $_POST['table'] );
		if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $tableName ) ) === $tableName ) {
			$results   = $wpdb->get_results( "SHOW COLUMNS FROM $tableName" );
			$getColumn = array();
			foreach ( $results as $field ) {
				if ( $field->Field == 'id' ) {
					continue;
				} elseif ( $field->Field == 'time_and_date' ) {
					continue;
				} else {
					$fielEx = explode( "_", $field->Field );
					array_shift( $fielEx );
					$imploField = implode( " ", $fielEx );
					array_push( $getColumn, $imploField );
				}
			}
			$columnrearrange = implode( ",", $getColumn );
			$wpdb->update( $table, array( 'table_columns_name' => $columnrearrange ), array( 'form_name' => $form_name ) );
			$reply = array(
				'value' => 'success'
			);
			echo json_encode( $reply );
			wp_die();
		} else {
			$reply = array(
				'value' => 'failed'
			);
			echo json_encode( $reply );
			wp_die();
		}
	}
}