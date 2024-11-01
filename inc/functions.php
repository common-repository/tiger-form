<?php
$tiger_form_text_columns = '';
$tiger_form_text_columns_req = '';
$tiger_form_email_columns = '';
$tiger_form_email_columns_req = '';
$tiger_form_checkbox_columns = array();
$tiger_form_date_columns = '';
$tiger_form_date_columns_req = '';
$tiger_form_number_columns = '';
$tiger_form_number_columns_req = '';
$tiger_form_radio_columns = '';
$tiger_form_select_columns = '';
$tiger_form_select_columns_req = '';
$tiger_form_textarea_columns = '';
$tiger_form_textarea_columns_req = '';
$tiger_form_url_columns = '';
$tiger_form_url_columns_req = '';

function tiger_form_init_parent_table()
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

function tiger_form_insert_first_row()
{
	global $wpdb;
	$table_posts = $wpdb->prefix . 'posts';
	$cheked      = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_posts  WHERE post_type = 'tiger_form'" );
	if ( $cheked == 0 ) {
		$user_id              = get_current_user_id();
		$formContent          = "[dfu_email* name='your-email' label='Email Address' placeholder='example@domain.com' unique='yes']

[dfu_submit name='submitbtn' label='Subscribe']";
		$formTitle            = 'Tiger Form';
		$dfu_dami_post_insert = array(
			'post_author'    => $user_id,
			'post_content'   => $formContent,
			'post_title'     => $formTitle,
			'post_status'    => 'publish',
			'post_type'      => 'tiger_form',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'post_parent'    => 0,
			'menu_order'     => 0,
		);

		$postid = wp_insert_post( $dfu_dami_post_insert );
		$wpdb->update( $table_posts, [ 'guid' => get_option( 'siteurl' ) . "/?post_type=tiger_form&p=" . $postid ], [ 'ID' => $postid ] );
		$table            = $wpdb->prefix . 'tiger_forms_main';
		$formNameGenarate = 'tiger_form_' . $postid;
		$msg              = "Your data has been sent successfully.-There was an error trying to send your data. Please try again later.-One or more fields have an error. Please check and try again.-*Required field.-Invalid email address.-URL is Invalid.-Number is larger than the maximum allowed.-Number is smaller than the minimum allowed.";

		$notification       = 'no';
		$notification_email = '';
		$fieldName          = "Email Address";

		$data   = array(
			'form_name'          => $formNameGenarate,
			'table_columns_name' => $fieldName,
			'form_messages'      => $msg,
			'notification'       => $notification,
			'notification_email' => $notification_email,
			'form_post_id'       => $postid,
			'status'             => 'Active',
			'form_display_name'  => 'Tiger Form ' . $postid
		);
		$format = array( '%s', '%s' );
		$wpdb->insert( $table, $data, $format );

		$data_table      = $wpdb->prefix . $formNameGenarate;
		$charset_collate = $wpdb->get_charset_collate();
		$sql             = 'CREATE TABLE ' . $data_table . ' (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `email_your_email` text NOT NULL,
           `time_and_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
           PRIMARY KEY (`id`)
           )' . $charset_collate;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		$format = array( '%s', '%s' );
		$wpdb->insert( $data_table, array( 'email_your_email' => 'supportdfu@jakirswork.com' ), $format );
	}
}