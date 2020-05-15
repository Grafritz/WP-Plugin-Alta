<?php
function wp_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );
    //wp_enqueue_style( 'stylebootstrap', $plugin_url . 'bootstrap/assets/dist/css/bootstrap.css' );
}
//add_action( 'wp_enqueue_scripts', 'wp_load_plugin_css' );
