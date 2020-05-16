<?php

class MesseMainClass
{
	// class instance
	static $instance;

	// customer WP_List_Table object
	public $messe_obj;

	// class constructor
	public function __construct() {
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen_messe' ], 10, 3 );
		add_action( 'admin_menu', [ $this, 'plugin_menu_messe' ] );
	}


	public static function set_screen_messe( $status, $option, $value ) {
		return $value;
	}

	public function plugin_menu_messe() 
	{
		$hook = add_menu_page(
			'Sitepoint WP_List_Table Example', //page title
			'Messe Demo Test', //menu title
			'manage_options', //capabilities
			'page_list_demande', //menu slug
			[ $this, 'get_page_list_demande' ] //function
		);

		//this is a submenu
		add_submenu_page('page_list_demande', //parent slug
			'Add New Messe', //page title
			'Add New', //menu title
			'manage_options', //capability
			'messe_create', //menu slug
			[ $this, 'get_form_create_messe']
		); //function

		add_action( "load-$hook", [ $this, 'screen_option_messe' ] );
	}

	/**
	 * Plugin settings page
	 */
	public function get_page_list_demande() 
	{
		?>
		<div class="wrap">
			<h1 class="wp-heading-inline">Demande de Messe</h1>
			<a href="?page=messe_create" class="page-title-action">Add New</a>
			<hr class="wp-header-end">

			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-12">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
								<?php
								$this->messe_obj->prepare_items();
								echo '<form method="post" name="frm_search_post" action="'.$_SERVER["PHP_SELF"].'?page='.$_GET['page'].'">';
								$this->messe_obj->search_box("Recherche","search_post_id");
								echo '</form>';   
								$this->messe_obj->display(); 
								?>
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
	public function screen_option_messe() {
		$option = 'per_page';
		$args   = [
			'label'   => 'Messe',
			'default' => 5,
			'option'  => 'messe_per_page'
		];

		add_screen_option( $option, $args );

		$this->messe_obj = new WP_DmdDeMesse();
	}


	public function get_form_create_messe()
	{
		ob_start();
		include_once plugin_dir_path(__FILE__) .'views/frm_create_form.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}

	/** Singleton instance */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}
