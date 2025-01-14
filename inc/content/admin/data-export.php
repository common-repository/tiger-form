<?php
function difu_data_insert_form_ultimate_export_data_table() {
	if ( ! current_user_can( 'administrator' ) ) {
		echo '<h1>You have no permission to access this page.</h1>';

		return;
	} else {
		if ( isset( $_GET['dfutable'] ) && wp_verify_nonce( $_GET['wpnonce'], 'dfu-validate-xls-download' ) ) {
			global $wpdb;
			$table_name     = $wpdb->prefix . 'tiger_forms_main';
			$dataTableFound = intval( $_GET['dfutable'] );
			$getInfo        = $wpdb->get_row( "SELECT form_name, table_columns_name, form_display_name FROM $table_name WHERE table_columns_name != '' AND form_post_id = '$dataTableFound'" );
			$data_table     = $wpdb->prefix . $getInfo->form_name;
			$columns        = $wpdb->get_results( "SHOW COLUMNS FROM $data_table" );
			$insertedColumn = array();
			foreach ( $columns as $field ) {
				if ( $field->Field == 'id' )
					continue;
				elseif ( $field->Field == 'time_and_date' )
					continue;
				else
					array_push( $insertedColumn, $field->Field );

			}
			$falseColumns   = explode( ",", rtrim( $getInfo->table_columns_name, ',' ) );
			$finalizeColumn = array_combine( $insertedColumn, $falseColumns );

			$output = '';
			$output .= '<table class="excel_report">';

			$output .= '<tr>';
			foreach ( $finalizeColumn as $value ) {
				$output .= '<th>' . $value . '</th>';
			}
			$output .= '</tr>';


			$result = $wpdb->get_results( "SELECT * FROM $data_table ORDER BY id DESC" );

			foreach ( $result as $value ) {
				$output .= '<tr>';
				foreach ( $insertedColumn as $valuecolumn ) {
					$output .= '<td>' . $value->$valuecolumn . '</td>';
				}
				$output .= '</tr>';
			}
			$output .= '<tr><td></td></tr>';
			$output .= '<tr><td></td></tr>';
			$output .= '<tr><td>This file automatic generated by Tiger Forms - Drag and Drop Form Builder.</td></tr>';

			$output .= '</table>';
			echo $output;
		} else {
			echo "<script>window.location.href = 'admin.php?page=tiger-forms'; </script>";
		}
	}
}
