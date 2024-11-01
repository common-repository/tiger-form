<?php
add_action( 'wp_ajax_difu_columns_update', 'difu_columns_update' );

function difu_columns_update() {

	if ( $_POST['action'] == 'difu_columns_update' && wp_verify_nonce( $_POST['wpnonce'], 'dfu-validate-column-update' ) ) {
		global $wpdb;
		$id         = intval( $_POST['id'] );
		$table_name = $wpdb->prefix . 'tiger_forms_main';

		if ( isset( $_POST['dfuTableName'] ) ) {
			$changeTable = sanitize_text_field( $_POST['dfuTableName'] );
			$getrow      = $wpdb->get_row( "SELECT table_columns_name FROM $table_name WHERE form_post_id = '$id'" );
			unset( $_POST['dfuTableName'] );
			unset( $_POST['action'] );
			unset( $_POST['wpnonce'] );
			unset( $_POST['id'] );
			if ( intval( $_POST['totalEditedColumn'] ) > 0 ) {
				$columnFinalizeKey   = array();
				$columnFinalizeValue = array();
				$getCurrentColumn    = explode( ',', trim( $getrow->table_columns_name, ',' ) );
				$getUpdateColumn     = array();
				for ( $i = 1; $i <= intval( $_POST['totalEditedColumn'] ); $i ++ ) {
					$column_explode = explode( "1971difu2020", sanitize_text_field( $_POST[ 'column-' . $i ] ) );
					unset( $_POST[ 'column-' . $i ] );
					array_push( $columnFinalizeKey, $column_explode[0] );
					array_push( $columnFinalizeValue, $column_explode[1] );
				}
				$columnFinalize = array_combine( $columnFinalizeKey, $columnFinalizeValue );
				$getKeys        = array_keys( $columnFinalize );
				$arr            = array();
				foreach ( $getCurrentColumn as $value ) {
					if ( in_array( trim( $value ), $getKeys ) ) {
						array_push( $arr, $columnFinalize[ trim( $value ) ] );
					} else {
						array_push( $arr, trim( $value ) );
					}
				}
				$fieldColumn = implode( ",", $arr );
				$wpdb->update( $table_name, array(
					'table_columns_name' => $fieldColumn,
					'form_display_name'  => $changeTable
				), array( 'form_post_id' => $id ) );
				set_transient( 'dfu-columntable-change-success', true, 30 );
				$response = array(
					'value' => 1,
					'id'    => $id
				);
				echo json_encode( $response );
			} else {
				$wpdb->update( $table_name, array( 'form_display_name' => $changeTable ), array( 'form_post_id' => $id ) );
				set_transient( 'dfu-table-change-success', true, 30 );
				$response = array(
					'value' => 1,
					'id'    => $id
				);
				echo json_encode( $response );
			}
		} else {
			$getrow = $wpdb->get_row( "SELECT table_columns_name FROM $table_name WHERE form_post_id = '$id'" );
			unset( $_POST['dfuTableName'] );
			unset( $_POST['action'] );
			unset( $_POST['wpnonce'] );
			unset( $_POST['id'] );
			if ( intval( $_POST['totalEditedColumn'] ) > 0 ) {
				$columnFinalizeKey   = array();
				$columnFinalizeValue = array();
				$getCurrentColumn    = explode( ',', trim( $getrow->table_columns_name, ',' ) );
				$getUpdateColumn     = array();
				for ( $i = 1; $i <= intval( $_POST['totalEditedColumn'] ); $i ++ ) {
					$column_explode = explode( "1971difu2020", sanitize_text_field( $_POST[ 'column-' . $i ] ) );
					unset( $_POST[ 'column-' . $i ] );
					array_push( $columnFinalizeKey, $column_explode[0] );
					array_push( $columnFinalizeValue, $column_explode[1] );
				}
				$columnFinalize = array_combine( $columnFinalizeKey, $columnFinalizeValue );
				$getKeys        = array_keys( $columnFinalize );
				$arr            = array();
				foreach ( $getCurrentColumn as $value ) {
					if ( in_array( trim( $value ), $getKeys ) ) {
						array_push( $arr, $columnFinalize[ trim( $value ) ] );
					} else {
						array_push( $arr, trim( $value ) );
					}

				}
				$fieldColumn = implode( ",", $arr );
				$wpdb->update( $table_name, array( 'table_columns_name' => $fieldColumn ), array( 'form_post_id' => $id ) );
				set_transient( 'dfu-column-change-success', true, 30 );
				$response = array(
					'value' => 1,
					'id'    => $id
				);
				echo json_encode( $response );
			}

		}
		wp_die();
	} else {
		$response = array(
			'value' => 2
		);
		echo json_encode( $response );
		wp_die();
	}
}
