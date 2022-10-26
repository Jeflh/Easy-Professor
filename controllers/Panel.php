<?php

class PanelController{
  public function __construct() {
    require_once 'models/M_usuario.php';
  }
  
  public function index() {

    $auth = autenticado();

    if($auth){  
      require_once 'views/V_panel.php'; // Si el usuario está autenticado
    } else {
      header('Location: index.php?c=login'); // Si no está autenticado se va al login
    }
  }
}

?>