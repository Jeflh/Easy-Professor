<?php
class Conectar{

  public static function conexion(){

    $host = "localhost";
    $user = "root";
    $pass = "root";
    $db = "easy_professor";

    $conexion = new mysqli($host, $user, $pass, $db);
    $conexion->query("SET NAMES 'utf8'");
    return $conexion;

  }
}
?>