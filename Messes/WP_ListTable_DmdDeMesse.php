<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class WP_ListTable_DmdDeMesse extends WP_List_Table 
{    
	/** Class constructor */
	public function __construct() {

		parent::__construct( [
			'singular' => __( 'DmdDeMesse', 'sp' ), //singular name of the listed records
			'plural'   => __( 'DmdDeMesse', 'sp' ), //plural name of the listed records
			'ajax'     => false //does this table support ajax?
		] );

	}


	/**
	 * Retrieve customers data from the database
	 *
	 * @param int $per_page
	 * @param int $page_number
	 *
	 * @return mixed
	 */
	public static function get_list_table_data( $per_page = 5, $page_number = 1 ) {

		global $wpdb;        
		$search_term = isset($_POST['s'])?  trim($_POST['s']):'';  
		
		$sql = "SELECT * FROM ".TBL_DEMANDE_DE_MESSES;
        if(!empty($search_term))
        {
            $sql .= " WHERE (nom LIKE '%".$search_term."%' 
             OR nomUser LIKE '%".$search_term."%' 
             OR typeMesse LIKE '%".$search_term."%') ";
        }

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}else{
			$sql .= ' ORDER BY ID DESC';
		}

		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

        //print_r($sql);

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		return $result;
	}
	/**
	 * Handles data query and filter, sorting, and pagination.
	 */
	public function prepare_items() {

		//$this->_column_headers = $this->get_column_info();
		$columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        
		$this->_column_headers = array($columns, $hidden, $sortable);
		
		/** Process bulk action */
		$this->process_bulk_action();

		$per_page     = $this->get_items_per_page( 'dmd_de_messe_per_page', 10 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );

		$this->items = self::get_list_table_data( $per_page, $current_page );
	}


	/**
	 * Delete a customer record.
	 *
	 * @param int $id customer ID
	 */
	public static function delete_customer( $id ) {
		global $wpdb;

		$wpdb->delete( TBL_DEMANDE_DE_MESSES,
			[ 'ID' => $id ],
			[ '%d' ]
		);
	}


	/**
	 * Returns the count of records in the database.
	 *
	 * @return null|string
	 */
	public static function record_count() {
		global $wpdb;
		$sql = "SELECT COUNT(*) FROM ".TBL_DEMANDE_DE_MESSES;
		return $wpdb->get_var( $sql );
	}


	/** Text displayed when no customer data is available */
	public function no_items() {
		_e( 'No customers avaliable.', 'sp' );
	}


	/**
	 * Render a column when no column specific method exist.
	 *
	 * @param array $item
	 * @param string $column_name
	 *
	 * @return mixed
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'ID':
			case 'nom':
			//case 'nomUser':
			case 'dateMesse':
			case 'heureMesse':
			case 'offrande':
			case 'typeMesse':
			case 'typeMonnaie':
			case 'dateEnreg':
				return $item[ $column_name ];
			//case 'action':
			//	return ''.sprintf('<a href="?page=%s&action=%s&post_id=%s">Edit</a>', $_GET['page'], 'owt-edit', $item['id'])
			//	.' | '.sprintf('<a href="?page=%s&action=%s&post_id=%s">Delete</a>', $_GET['page'], 'owt-delete', $item['id']);
			
			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

    public function get_hidden_columns()
    {
        return array('ID','dateEnreg');
	}
	
	function get_columns() {
		$columns = [
			'cb'      => '<input type="checkbox" />',
			'ID'    => __( 'ID', 'sp' ),
			'nom'    => __( 'Nom, Prenom', 'sp' ),
			//'nomUser' => __( 'Nom User', 'sp' ),
			'dateMesse'    => __( 'date Messe', 'sp' ),
			'heureMesse' => __( 'heure Messe', 'sp' ),
			'offrande' => __( 'offrande', 'sp' ),
			'typeMesse' => __( 'type Messe', 'sp' ),
			'typeMonnaie' => __( 'type Monnaie', 'sp' ),
			'dateEnreg' => __( 'date Enreg', 'sp' ),
            //'action' => 'Actions'
		];

		return $columns;
	}

	/**
	 * Render the bulk edit checkbox
	 *
	 * @param array $item
	 *
	 * @return string
	 */
	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
		);
	}


	/**
	 * Method for name column
	 *
	 * @param array $item an array of DB data
	 *
	 * @return string
	 */
	function column_nom( $item ) {

		$delete_nonce = wp_create_nonce( 'sp_delete_DmdDeMesse' );

		$title = '<strong>' . $item['nom'] . '</strong>';

		$actions = [
			'edit' => sprintf( '<a href="?page=messe_create&id=%s">Edit</a>', absint( $item['ID'] ) ),
			'delete' => sprintf( '<a href="?page=messe_create&action=del&id=%s">Delete</a>', absint( $item['ID'] ) )
		];

		return $title . $this->row_actions( $actions );
	}




	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			'ID' => array( 'ID', true ),
			'nom' => array( 'nom', false ),
			'dateMesse' => array( 'dateMesse', false ),
			'offrande' => array( 'offrande', false ),
			'typeMesse' => array( 'typeMesse', false ),
			'typeMonnaie' => array( 'typeMonnaie', false )
		);

		return $sortable_columns;
	}

	/**
	 * Returns an associative array containing the bulk action
	 *
	 * @return array
	 */
	public function get_bulk_actions() {
		$actions = [
			'bulk-delete' => 'Delete'
		];

		return $actions;
	}



	public function process_bulk_action() {

		//Detect when a bulk action is being triggered...
		if ( 'delete' === $this->current_action() ) {

			// In our file that handles the request, verify the nonce.
			$nonce = esc_attr( $_REQUEST['_wpnonce'] );

			if ( ! wp_verify_nonce( $nonce, 'sp_delete_DmdDeMesse' ) ) {
				die( 'Go get a life script kiddies' );
			}
			else {
				self::delete_customer( absint( $_GET['customer'] ) );

		                // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
		                // add_query_arg() return the current url
		                wp_redirect( esc_url_raw(add_query_arg()) );
				exit;
			}

		}

		// If the delete bulk action is triggered
		if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
		     || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
		) {

			$delete_ids = esc_sql( $_POST['bulk-delete'] );

			// loop over the array of record IDs and delete them
			foreach ( $delete_ids as $id ) {
				self::delete_customer( $id );

			}

			// esc_url_raw() is used to prevent converting ampersand in url to "#038;"
		        // add_query_arg() return the current url
		        wp_redirect( esc_url_raw(add_query_arg()) );
			exit;
		}
	}

}



