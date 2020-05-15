<?php

class SP_Plugin 
{
	
	// class instance
	static $instance;

	// customer WP_List_Table object
	public $customers_obj;

	// class constructor
	public function __construct() {
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'admin_menu', [ $this, 'plugin_menu' ] );

		//add_action('admin_menu', [ $this, 'plugin_messe_menu' ]);
	}


	public static function set_screen( $status, $option, $value ) {
		return $value;
	}

	public function plugin_menu() 
	{
		$hook = add_menu_page(
			'Sitepoint WP_List_Table Example',
			'Custumer Demo',
			'manage_options',
			'wp_list_table_class',// slug / Url : ?page=wp_list_table_class 
			[ $this, 'plugin_settings_page' ]
		);

		add_action( "load-$hook", [ $this, 'screen_option' ] );
	}

	/**
	 * Plugin settings page
	 */
	public function plugin_settings_page() 
	{
		?>
		<div class="wrap">
			<h2>WP_List_Table Class Example</h2>

			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-12">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<!--<form method="post">-->
								<?php
								$this->customers_obj->prepare_items();
								echo '<form method="post" name="frm_search_post" action="'.$_SERVER["PHP_SELF"].'?page='.$_GET['page'].'">';
								$this->customers_obj->search_box("Recherche","search_post_id");
								echo '</form>';   
								$this->customers_obj->display(); 
								?>
							<!--</form>-->
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	<?php
	}

	/**
	 * Screen options
	 */
	public function screen_option() {
		$option = 'per_page';
		$args   = [
			'label'   => 'Customers',
			'default' => 5,
			'option'  => 'customers_per_page'
		];

		add_screen_option( $option, $args );
		$this->customers_obj = new WPCustomers_List();
	}


	/** Singleton instance */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}
