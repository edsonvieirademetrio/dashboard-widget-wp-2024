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
function cdw_get_data_db(){
    global $wpdb;
    $res = $wpdb->get_results("SELECT * FROM `wp_visits_table`", ARRAY_A);
    return rest_ensure_response( $res );
}