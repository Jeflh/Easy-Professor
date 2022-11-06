<?php

class PanelController{
  private $auth;

  public function __construct() {
    $this->auth = autenticado();
  }
  
  public function index() {

    if($this->auth){  
      require_once 'views/inicio/V_panel.php'; // Si el usuario está autenticado
    } else {
      header('Location: index.php?c=login'); // Si no está autenticado se va al login
    }
  }
}

?>