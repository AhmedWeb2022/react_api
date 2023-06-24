<?php

class DB
{

  // function to connect to database 
  
  public function connect()
  {
    $dsn = 'mysql:host=localhost;dbname=react-db';
    $user = 'root';
    $pass = '';
    $option = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    try {

      $con = new PDO($dsn, $user, $pass, $option);
      $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $con;
    } catch (PDOException $e) {
      return "Failed To Connect" . $e->getMessage();
    }
  }
}


// define('App_NAME','PHP REST API TUTORIAL');