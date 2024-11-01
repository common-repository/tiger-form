<?php

namespace tiger_form_ultimate;
class push_notify_mail {

	function tiger_form_notification_push( $id = "", $insert_id = "", $author = "" ) {

		if ( ! empty( $id ) && ! empty( $insert_id ) ) {
			global $wpdb;
			$table_name = $wpdb->prefix . 'tiger_forms_main';
			$subject    = "Data submitted notification form " . get_option( 'blogname' );
			$message    = '';
			$message    .= "<p style='font-size: 15px;font-family: monospace;font-weight: 600;line-height: 20px;'>Dear " . $author . ",<br>A new data submitted on your website using Tiger Forms.</p>";
			$getInfo    = $wpdb->get_row( "SELECT form_name, table_columns_name, notification_email, form_display_name FROM $table_name WHERE table_columns_name != '' AND form_post_id = '$id'" );
			$message    .= "<div style='background: #d5000b;width: 100%;height: 50px;'><h2 style='font-size: 22px;color: #fff;text-align: center;line-height: 50px;font-weight: 600;'>" . $getInfo->form_display_name . "</h2></div>";

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
			$message        .= '<table style="width: 80%;text-align: center;margin: 0 auto;margin-top: 20px;">';
			$message        .= '<tr style="background: #0073b7; color: #fff;">';
			foreach ( $finalizeColumn as $value ) {
				$message .= '<th>' . $value . '</th>';
			}
			$message .= '</tr>';
			$result  = $wpdb->get_results( "SELECT * FROM $data_table WHERE id = '$insert_id'" );
			foreach ( $result as $value ) {
				$message .= '<tr style="background: #23282d;color: #fff;">';
				foreach ( $insertedColumn as $valuecolumn ) {
					$message .= '<td>' . $value->$valuecolumn . '</td>';
				}
				$message .= '</tr>';
			}
			$message   .= '</table>';
			$message   .= "<p style='font-size: 15px;font-family: monospace;font-weight: 600;line-height: 20px;'>You can also view this data from this link: <a href='" . get_option( 'siteurl' ) . "/wp-admin/admin.php?page=tiger-forms-all-inserted-data' traget='_blank'>Admin Panel</a> in your admin panel.</p>";
			$message   .= "<p style='font-size: 13px; text-align:center; font-family: monospace;font-weight: 500;line-height: 20px;'>This e-mail was sent from a Tiger Form on " . get_option( 'blogname' ) . ". Tiger Forms - Drag and Drop From Builder.</p>";
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$headers[] = 'From: ' . get_option( 'blogname' ) . ' <' . get_option( 'admin_email' ) . '>';

			return wp_mail( $getInfo->notification_email, $subject, $message, $headers );
		}
	}
}