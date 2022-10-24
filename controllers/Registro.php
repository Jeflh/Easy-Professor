<?php

class RegistroController {

  public function __construct() {
    require_once 'models/usuario.php';
  }
  

  public function index() {
    require_once 'views/registro.php';
  }
}


?>