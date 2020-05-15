<?php
function wpload_bootstrap_css() {
    $plugin_url = plugin_dir_url( __FILE__ );
    // <!-- Bootstrap CSS -->
    //<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    wp_enqueue_style( 'style1', $plugin_url . 'styles/css/style1.css' );
    wp_enqueue_style( 'style2', $plugin_url . 'css/style2.css' );
}
add_action( 'wp_enqueue_scripts', 'wpload_plugin_css' );