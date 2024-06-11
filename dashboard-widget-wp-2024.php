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


//Auto generate data for example plugin
function check_and_create_visits_table() {
  global $wpdb;

  //error_log('Test msg: Função check_and_create_visits_table chamada', 0);

  $table_name = $wpdb->prefix . 'visits_table';

  if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
      error_log('Mensagem de teste: Tabela não existe, criando tabela e inserindo dados', 0);

      $create_table_sql = "
      CREATE TABLE {$table_name} (
          id INT AUTO_INCREMENT PRIMARY KEY,
          date DATE NOT NULL,
          num_visits INT NOT NULL
      );";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

      dbDelta($create_table_sql);

      $insert_data_sql = "
      INSERT INTO {$table_name} (date, num_visits)
      WITH RECURSIVE DateGenerator AS (
          SELECT CURDATE() AS date
          UNION ALL
          SELECT DATE_SUB(date, INTERVAL 1 DAY)
          FROM DateGenerator
          WHERE DATE_SUB(date, INTERVAL 1 DAY) >= DATE_SUB(CURDATE(), INTERVAL 59 DAY)
      )
      SELECT date, FLOOR(RAND() * 91) + 10 AS num_visits
      FROM DateGenerator;";

      $wpdb->query($insert_data_sql);
  }
}
register_activation_hook(__FILE__, 'check_and_create_visits_table');

