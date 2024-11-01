<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class tiger_form_data_table extends WP_List_Table {
	public function __construct() {
		parent::__construct( array(
			'singular' => 'post',
			'plural'   => 'posts',
			'ajax'     => false
		) );
	}

	public function get_columns() {
		$columns = array(
			'cb'          => '<input type="checkbox">',
			'post_title'  => 'Title',
			'shortcode'   => 'Shortcode',
			'post_author' => 'Author',
			'post_date'   => __( 'Date', 'difu' ),
		);

		return $columns;
	}

	protected function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'post_title':

			case 'shortcode':

			case 'post_author':

			case 'post_date':
				return ucfirst( $item[ $column_name ] );

			default:
				return print_r( $item, true );
		}
	}

	protected function get_sortable_columns() {
		$sortable_columns = array(
			'post_title' => array( 'post_title', false ),
			'post_date'  => array( 'post_date', false ),
		);

		return $sortable_columns;
	}

	public function column_post_title( $item ) {
		$actions = array(
			'edit' => sprintf( '<a href="admin.php?page=%s&actions=%s&post=%s"><span class="dashicons dashicons-edit"></span>Edit</a>', 'tiger-forms', 'edit', $item['ID'] )
		);

		return sprintf(
			'<strong style="font-size:14px;"><a href="admin.php?page=%1$s&actions=%2$s&post=%3$s"> %4$s </a></strong> %5$s', 'tiger-forms', 'edit', $item['ID'], $item['post_title'], $this->row_actions( $actions )
		);
	}

	public function column_shortcode( $item ) {

		$shortcode = '[tiger-form id="' . $item["ID"] . '" title="' . $item["post_title"] . '"]';
		$output    = '';
		$output    .= '<span><input type="text" class="shortcode-input-row" readonly value="' . esc_attr( $shortcode ) . '"';
		$output    .= '></span>';

		return $output;
	}

	public function no_items() {
		_e( 'No Items Found.' );
	}

	public function column_post_author( $item ) {

		$post_author = get_post( $item['ID'] );
		if ( ! $post_author ) {
			return;
		}
		$author = get_userdata( $post_author->post_author );
		if ( false === $author ) {
			return;
		}

		return esc_html( $author->display_name );
	}

	public function column_post_date( $item ) {
		$post_date = get_post( $item['ID'] );
		if ( ! $post_date ) {
			return;
		}
		$t_time    = mysql2date( __( 'Y/m/d g:i:s A' ),
			$post_date->post_date, true );
		$m_time    = $post_date->post_date;
		$time      = mysql2date( 'G', $post_date->post_date ) - get_option( 'gmt_offset' ) * 3600;
		$time_diff = time() - $time;
		if ( $time_diff > 0 and $time_diff < 24 * 60 * 60 ) {
			$h_time = sprintf( __( '%s ago' ), human_time_diff( $time ) );
		} else {
			$h_time = mysql2date( __( 'd/m/Y' ), $m_time );
		}

		return sprintf( '<abbr title="%2$s">%1$s</abbr>',
			esc_html( $h_time ),
			esc_attr( $t_time )
		);
	}

	public function column_cb( $item ) {

		return sprintf( '<input type="checkbox" name="%1$s[]" value="%2$s" />', $this->_args['singular'], $item['ID'] );
	}

	protected function get_bulk_actions() {
		$actions = array( 'delete' => 'Delete' );

		return $actions;
	}

	public function process_bulk_action() {
		global $wpdb;
		if ( 'delete' === $this->current_action() ) {
			if ( ! empty( $_GET['post'] ) ) {
				$count = 0;
				foreach ( $_GET['post'] as $post ) {
					$count ++;
					$wpdb->delete( $wpdb->prefix . 'posts', array( 'ID' => $post ) );
					$wpdb->update( $wpdb->prefix . 'tiger_forms_main', array( 'Status' => 'Deleted' ), array( 'Form_Post_Id' => $post ) );
				}
				echo '<div class="notice notice-success is-dismissible">';
				echo '<p><strong>' . $count . '</strong> Form deleted successfully.</p>';
				echo '</div>';
			}
		}
	}


	public function prepare_items( $form_search = '' ) {

		$current_screen = get_current_screen();
		$per_page       = $this->get_items_per_page( 'form_per_page' );
		global $wpdb;
		$table_name = $wpdb->prefix . 'posts';

		$columns               = $this->get_columns();
		$hidden                = array( 'ID' );
		$sortable              = $this->get_sortable_columns();
		$primary               = 'post_title';
		$this->_column_headers = array( $columns, $hidden, $sortable, $primary );
		$this->process_bulk_action();

		if ( isset( $_REQUEST['paged'] ) ) {
			$paged = max( 0, intval( $_REQUEST['paged'] - 1 ) * $per_page );
		} else {
			$paged = 0;
		}
		if ( isset( $_REQUEST['orderby'] ) && in_array( $_REQUEST['orderby'], array_keys( $this->get_sortable_columns() ) ) ) {
			$orderby = sanitize_title( $_REQUEST['orderby'] );
		} else {
			$orderby = 'ID';
		}

		if ( isset( $_REQUEST['order'] ) && in_array( $_REQUEST['order'], array( 'ASC', 'DESC' ) ) ) {
			$order = sanitize_sql_orderby( $_REQUEST['order'] );
		} else {
			$order = 'DESC';
		}


		if ( ! empty( $form_search ) ) {
			$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE post_type = 'tiger_form' AND post_title LIKE %s ORDER BY $orderby $order LIMIT %d OFFSET %d", '%' . $wpdb->esc_like( $form_search ) . '%', $per_page, $paged ), ARRAY_A );
			$total_items = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_name  WHERE post_type = 'tiger_form' AND post_title LIKE '%$form_search%' " );

		} else {
			$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE post_type = 'tiger_form' ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged ), ARRAY_A );
			$total_items = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_name  WHERE post_type = 'tiger_form' " );

		}
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page'    => $per_page,
			'total_pages' => ceil( $total_items / $per_page ),
		) );

	}

}
