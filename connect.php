<?php

class Database{
  public function connect(){
    $dbhost = 'localhost';
    $database = 'ta_pw';
    $username = 'root';
    $password = '';

    try{
      $conn = new PDO("mysql:host=$dbhost;dbname=$database", $username,$password);
      $conn->exec("set names utf8");
      return $conn;
    }catch(\Throwable $th){
      return "koneksi gagalll";
    }
  }
}

?>