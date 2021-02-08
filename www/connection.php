<?php
	function db_connect() {
    static $connection;

      if(!isset($connection)) {
          $config = parse_ini_file('../secret/configTasks.ini'); 
          $connection = mysqli_connect($config['hostname'],$config['username'],$config['password'],$config['dbname']);
      }
      return $connection;
    }

    $connection = db_connect();
    mysqli_query($connection,"set names utf8"); 
?>