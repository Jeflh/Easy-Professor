<?php
class Conectar{
  public static function conexion(){
    $conexion = new mysqli("localhost", "root", "root", "easy_professor");
    $conexion->query("SET NAMES 'utf8'");
    return $conexion;
  }
}
?>