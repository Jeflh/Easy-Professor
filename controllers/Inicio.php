<?php

class InicioController {

  public function __construct() {
    require_once 'models/M_inicio.php';
  }
  
  public function index() {
    require_once 'views/V_inicio.php';
  }
}

?>