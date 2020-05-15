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

		//add_shortcode( 'formDemandeDeMesse', 'formulaireMesse' );
	}


	public static function set_screen_messe( $status, $option, $value ) {
		return $value;
	}

	public function plugin_menu_messe() 
	{
		$hook = add_menu_page(
			'Sitepoint WP_List_Table Example',
			'Messe Demo Test',
			'manage_options',
			'wp_list_table_class_messe',// slug / Url : ?page=wp_list_table_class 
			[ $this, 'plugin_settings_page_messe' ]
		);

		add_action( "load-$hook", [ $this, 'screen_option_messe' ] );
	}

	/**
	 * Plugin settings page
	 */
	public function plugin_settings_page_messe() 
	{
		?>
		<div class="wrap">
			<h2>Demande de Messe</h2>

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

	/** Singleton instance */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}
