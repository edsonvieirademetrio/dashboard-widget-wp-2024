<?php

if( ! defined('ABSPATH')){
    exit;
}

//Function to register widget in wp-admin
function cdw_register_dashboard_widget(){
    wp_add_dashboard_widget( 
        'cdw_dashboard_widget', 
        'Custom Dashboard Widget', 
        'cdw_render_dashboard_widget', 
        array(
            'position' => 0
        )    
    );
}
add_action( 'wp_dashboard_setup', 'cdw_register_dashboard_widget' );

//Render content widdget
function cdw_render_dashboard_widget(){
    echo '<div id="cdw-react-app" class="cdw-widget-container"></div>';
}

//Register endpoint API
function cdw_register_rest_route(){
    register_rest_route( 
        'cdw/v1',
        '/data', 
        array(
            'methods' => 'GET',
            'callback' => 'cdw_get_data',
        )
    );
}
add_action( 'rest_api_init', 'cdw_register_rest_route' );

//Select DB data
function cdw_get_data() {
    global $wpdb;
    $results = $wpdb->get_results( "SELECT * FROM `wp_visits_table`", ARRAY_A );

    return rest_ensure_response( $results );
}

//Load scripts React
function cdw_enqueue_admin_scripts($hook) {
    if ( 'index.php' !== $hook ) {
        return;
    }

    wp_enqueue_script("react_plugin_js", plugin_dir_url(__FILE__) . "../build/index.js", [ "wp-element"], "0.1.0", true);

    wp_enqueue_style("react_plugin_css", plugin_dir_url(__FILE__) . "../build/index.css");
}
add_action( 'admin_enqueue_scripts', 'cdw_enqueue_admin_scripts' );

