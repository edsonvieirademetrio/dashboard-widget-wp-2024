<?php

/**
 * Plugin Name: Dashboard Widget 2024
 * Description: Add a custom dashboard widget in WordPress Admin
 * Version: 1.0
 * Author: Edson Vieira Demetrio
 */

if( ! defined('ABSPATH')){
    exit;
}

 //Functions plugin
 $template = plugin_dir_path( __FILE__ ) . 'inc/functions.php';
 if(file_exists($template)){
   include_once $template;
 }else{
   echo '<p>Template is not exist</p>';
 }