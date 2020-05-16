<?php
/*
Plugin Name: ALta WP Plugin
Plugin URI: https://www.brain-dev.net
Description: Demande de messe, et autres... avec WP_List_Table Class
Version: 1.0
Author: Brain Dev
Author URI:  https://www.facebook.com/Grafritz
*/
// https://www.sitepoint.com/using-wp_list_table-to-create-wordpress-admin-tables/

define('CUSTOMER_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

define('LINK_BOOTSTRAP_CSS', WP_PLUGIN_URL.'/WP-Plugin-Alta/styles/bootstrap/assets/dist/css/bootstrap.css');
define('LINK_CURRENT_PLUGIN', WP_PLUGIN_URL.'/WP-Plugin-Alta/');

// Partie 1 : créer une table SQL custom
require_once(CUSTOMER_PLUGIN_DIR_PATH . 'Scripts/scripts-tables.php');
register_activation_hook(__FILE__, 'createTableCustomer');
register_activation_hook(__FILE__, 'createTableDmdDeMesse');

//require_once(CUSTOMER_PLUGIN_DIR_PATH . 'styles/style.php');
//wp_register_style('myStyleSheet', 'wp_load_plugin_css');
//wp_enqueue_style( 'myStyleSheet');

require_once(CUSTOMER_PLUGIN_DIR_PATH . 'Messes/ShortCode/ViewsForms.php');
add_shortcode( 'formDemandeDeMesse', 'formulaireMesse' ); 
add_shortcode( 'formDemandeDeMesseV2', 'formulaireMesseV2' ); 

require_once(CUSTOMER_PLUGIN_DIR_PATH . 'Customer/wp-CustomerClass.php');
require_once(CUSTOMER_PLUGIN_DIR_PATH . 'Customer/SP-PluginCust.php');

require_once(CUSTOMER_PLUGIN_DIR_PATH . 'Messes/WP_ListTable_DmdDeMesse.php');
require_once(CUSTOMER_PLUGIN_DIR_PATH . 'Messes/WP_Main_DmdDeMesse.php');

require_once( CUSTOMER_PLUGIN_DIR_PATH . 'Tools/Tools.php' );


add_action( 'plugins_loaded', function () {
	WP_Main_DmdDeMesse::get_instance();
} );

add_action( 'plugins_loaded', function () {
	SP_Plugin::get_instance();
} );


?>