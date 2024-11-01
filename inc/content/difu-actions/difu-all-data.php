<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class tiger_form_all_table_list extends WP_List_Table {
	public function __construct() {
		parent::__construct( array(
			'singular' => 'dfutable',
			'plural'   => 'dfutables',
			'ajax'     => false
		) );
	}

	public function get_columns( $columnDisplayName = '', $columnRealName = '', $tableName = '' ) {
		$columnDisplayNameConvert = explode( ",", $columnDisplayName );
		$columnRealNameConvert    = explode( ",", $columnRealName );
		if ( count( $columnRealNameConvert ) != count( $columnDisplayNameConvert ) ) {
			$col = array(
				'error' => "Something went wrong ! Resolve now <a href='javascript:void(0)' class='difu-table-refresh' data-table='" . $tableName . "'> click here </a>",
			);

			return $col;
		} else {
			$getColumn = array_combine( $columnRealNameConvert, $columnDisplayNameConvert );
			$columns   = array_merge( array( 'cb' => '<input type="checkbox">' ), $getColumn, array( "time_and_date" => "Date" ) );

			return $columns;
		}
	}

	protected function column_default( $item, $column_name ) {
		return $item[ $column_name ];
	}


	protected function get_sortable_columns() {
		$sortable_columns = array(
			'time_and_date' => array( 'time_and_date', false )
		);

		return $sortable_columns;
	}


	public function no_items() {
		_e( 'No Items Found.' );
	}

	public function column_error() {
		return "Something went wrong !";
	}

	public function column_time_and_date( $item ) {
		$datadate = $item['time_and_date'];
		if ( empty( $datadate ) ) {
			return;
		}
		$t_time    = mysql2date( __( 'Y/m/d H:i:s' ),
			$datadate, true );
		$m_time    = $datadate;
		$time      = mysql2date( 'G', $datadate ) - get_option( 'gmt_offset' ) * 3600;
		$time_diff = time() - $time;
		if ( $time_diff > 0 and $time_diff < 24 * 60 * 60 ) {
			$h_time = sprintf( __( '%s ago' ), human_time_diff( $time ) );
		} else {
			$h_time = mysql2date( __( 'd/m/Y' ), $m_time );
		}

		return sprintf( '<span title="%2$s">%1$s</span>',
			esc_html( $h_time ),
			esc_attr( $t_time )
		);
	}

	public function column_cb( $item ) {

		return sprintf( '<input type="checkbox" name="%1$s[]" value="%2$s" />', $this->_args['singular'], $item['id'] );
	}

	public function get_bulk_actions() {
		$actions = array( 'delete' => 'Delete' );

		return $actions;
	}

	public function process_bulk_action( $tableName = "" ) {
		global $wpdb;
		if ( 'delete' === $this->current_action() ) {
			if ( ! empty( $_GET['dfutable'] ) ) {
				$count = 0;
				foreach ( $_GET['dfutable'] as $dfutable ) {
					$count ++;
					$wpdb->delete( $wpdb->prefix . $tableName, array( 'id' => $dfutable ) );
				}
				echo '<div class="notice notice-success is-dismissible">';
				echo '<p><strong>' . $count . '</strong> Row deleted successfully.</p>';
				echo '</div>';
			}
		}
	}

	public function prepare_items( $tableName = '', $data_search = '' ) {


		$currentt_screen = get_current_screen();
		$per_page        = $this->get_items_per_page( 'form_per_page' );

		if ( ! empty( $tableName ) ) {
			global $wpdb;
			$main_table = $wpdb->prefix . 'tiger_forms_main';
			$getColumns = $wpdb->get_row( "SELECT form_name, table_columns_name, form_post_id FROM $main_table WHERE form_name = '$tableName'" );

			$desireTableName = $wpdb->prefix . $getColumns->form_name;
			$primaryArr      = array();
			$getRealField    = $wpdb->get_results( "SHOW COLUMNS FROM $desireTableName" );
			$output          = '';
			foreach ( $getRealField as $field ):
				if ( $field->Field == 'id' ):
					continue;
				elseif ( $field->Field == 'time_and_date' ):
					continue;
				else:
					$output .= $field->Field . ',';
					array_push( $primaryArr, $field->Field );
				endif;
			endforeach;
			$insertedColumn        = rtrim( $output, ',' );
			$columns               = $this->get_columns( rtrim( $getColumns->table_columns_name, ',' ), $insertedColumn, $getColumns->form_name );
			$hidden                = array( 'id' );
			$sortable              = $this->get_sortable_columns();
			$this->_column_headers = array( $columns, $hidden, $sortable, $primaryArr[0] );
			$this->process_bulk_action( $tableName );

			if ( isset( $_REQUEST['paged'] ) ) {
				$paged = max( 0, intval( $_REQUEST['paged'] - 1 ) * $per_page );
			} else {
				$paged = 0;
			}
			if ( isset( $_REQUEST['orderby'] ) && in_array( $_REQUEST['orderby'], array_keys( $this->get_sortable_columns() ) ) ) {
				$orderby = sanitize_title( $_REQUEST['orderby'] );
			} else {
				$orderby = 'id';
			}

			if ( isset( $_REQUEST['order'] ) && in_array( $_REQUEST['order'], array( 'ASC', 'DESC' ) ) ) {
				$order = sanitize_sql_orderby( $_REQUEST['order'] );
			} else {
				$order = 'DESC';
			}

			if ( ! empty( $data_search ) ) {
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $desireTableName WHERE CONCAT($insertedColumn) LIKE %s ORDER BY $orderby $order LIMIT %d OFFSET %d", '%' . $wpdb->esc_like( $data_search ) . '%', $per_page, $paged ), ARRAY_A );
				$total_items = $wpdb->get_var( "SELECT COUNT(id) FROM $desireTableName WHERE CONCAT($insertedColumn) LIKE '%$data_search%' " );

			} else {
				$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $desireTableName ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged ), ARRAY_A );
				$total_items = $wpdb->get_var( "SELECT COUNT(id) FROM $desireTableName " );

			}
			$this->set_pagination_args( array(
				'total_items' => $total_items,
				'per_page'    => $per_page,
				'total_pages' => ceil( $total_items / $per_page ),
			) );

		}
	}

}
