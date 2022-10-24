<?php

class InicioController {

  public function __construct() {
    require_once 'models/inicio.php';
  }
  

  public function index() {
    require_once 'views/inicio.php';
  }
}

?>