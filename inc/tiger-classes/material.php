<?php

namespace tiger_form_ultimate;
class tiger_form_material {
	public function tiger_form_plugin_dir_path( $difupath = "" ) {
		$getPath = rtrim( plugin_dir_path( tiger_form_insert_form_ultimate_plugin ), '\inc/' ) . '/';

		return path_join( $getPath, $difupath );
	}

	public function tiger_form_plugin_dir_url( $difuurl = "" ) {
		return path_join( plugin_dir_url( tiger_form_insert_form_ultimate_plugin ), $difuurl );
	}

	public function tiger_form_shortcode_validate_error( $value ) {
		$getDifuShortcode = explode( "]", $value );
		$token            = strtok( $getDifuShortcode[0], " " );
		$getFirstWord     = "$token";
		if ( $getFirstWord == 'dfu_checkbox' || $getFirstWord == 'dfu_date' || $getFirstWord == 'dfu_date*' || $getFirstWord == 'dfu_email' || $getFirstWord == 'dfu_email*' || $getFirstWord == 'dfu_number' || $getFirstWord == 'dfu_number*' || $getFirstWord == 'dfu_radio' || $getFirstWord == 'dfu_select' || $getFirstWord == 'dfu_select*' || $getFirstWord == 'dfu_submit' || $getFirstWord == 'dfu_text*' || $getFirstWord == 'dfu_text' || $getFirstWord == 'dfu_textarea' || $getFirstWord == 'dfu_textarea*' || $getFirstWord == 'dfu_url' || $getFirstWord == 'dfu_url*' ) {
			return $getDifuShortcode[0] . "]";
		} else {
			return false;
		}

	}

	public function tiger_form_info_icon_produce() {
		echo $this->tiger_form_plugin_dir_url( 'inc/image/info-icon.png' );
	}

	public function extendedFilePath() {
		return 'inc/options/extended-file.php';
	}

	public function user_end_operation() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/admin/userend.php' );
	}

	public function tiger_form_function() {
		return $this->tiger_form_plugin_dir_path( 'inc/functions.php' );
	}

	public function tiger_form_name_sanitization( $name ) {
		return str_replace( "_", "", sanitize_title( $name ) );
	}

	public function data_purify( $data = "" ) {
		$step1 = htmlentities( $data );

		return strip_tags( $step1 );
	}

	public function textField() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/text.php' );
	}

	public function textAreaField() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/textarea.php' );
	}

	public function selectField() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/select.php' );
	}

	public function submitButton() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/submit.php' );
	}

	public function dateField() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/date.php' );
	}

	public function checkBoxField() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/checkbox.php' );
	}

	public function radioButton() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/radio.php' );
	}

	public function emailField() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/email.php' );
	}

	public function urlField() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/url.php' );
	}

	public function numberField() {
		return $this->tiger_form_plugin_dir_path( 'inc/content/asset/number.php' );
	}

	public function tiger_form_userend_columns_operation(array $columns)
	{
		if (count($columns) > 0) {
			$newColumnFound = array();
			foreach ( $columns as $value ) {
				$prefixDetuch = explode( "_", $value );
				array_shift( $prefixDetuch );
				$implodeMainColumns = implode( " ", $prefixDetuch );
				array_push( $newColumnFound, $implodeMainColumns );
			}
			$newColumnFound = implode( ",", $newColumnFound );
			$newColumnFound = str_replace( "_", " ", $newColumnFound );

			return $newColumnFound;
		}
	}

	public function tiger_form_columns_alter(array $alterColumns, $table)
	{
		if (count($alterColumns) > 0 && !empty($table)) {
			global $wpdb;
			$columnFormtion = implode( ',', $alterColumns );

			return $wpdb->query( "ALTER TABLE $table ADD COLUMN ($columnFormtion)" );
		}
	}

	public function tiger_form_field_type($value)
	{
		$token = strtok($value, " ");
		$getFirstWord = "$token";
		if ($getFirstWord == 'dfu_checkbox' || $getFirstWord == 'dfu_date' || $getFirstWord == 'dfu_date*' || $getFirstWord == 'dfu_email' || $getFirstWord == 'dfu_email*' || $getFirstWord == 'dfu_number' || $getFirstWord == 'dfu_number*' || $getFirstWord == 'dfu_radio' || $getFirstWord == 'dfu_select' || $getFirstWord == 'dfu_select*' || $getFirstWord == 'dfu_submit' || $getFirstWord == 'dfu_text*' || $getFirstWord == 'dfu_text' || $getFirstWord == 'dfu_textarea' || $getFirstWord == 'dfu_textarea*' || $getFirstWord == 'dfu_url' || $getFirstWord == 'dfu_url*') {
			$splitPrefix = explode( "_", $getFirstWord );

			return trim( $splitPrefix[1], '*' );
		}

	}

	public function tiger_form_create_parent_table()
	{
		global $wpdb;
		$table_name      = $wpdb->prefix . 'tiger_forms_main';
		$charset_collate = $wpdb->get_charset_collate();
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == 0 ) {
			$sql = 'CREATE TABLE ' . $table_name . ' (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `form_name` varchar(30) NOT NULL,
           `table_columns_name` text NOT NULL,
           `form_messages` text NOT NULL,
           `notification` varchar(5),
           `notification_email` varchar(255),
           `form_post_id` int(11) NOT NULL,
           `status` varchar(10) NOT NULL,
           `form_display_name` varchar(255) NOT NULL,
           PRIMARY KEY (`id`)
           )' . $charset_collate;
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
	}

}