<?php

class InicioModel {
  private $db;
  private $data;

  public function __construct() {
    $this->db = Conectar::conexion();
    $this->data = array();
  }
}


?>