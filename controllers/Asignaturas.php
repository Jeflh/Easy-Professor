<?php

class AsignaturasController{

  public function __construct(){
    require_once 'models/M_asignatura.php';
    
    $auth = autenticado();
    if ($auth == false) {
      header('Location: index.php?c=login');
    }
  }
  public function index(){
    $asignaturas = new AsignaturaModel();
    $datos['asignaturas'] = $asignaturas->getAsignaturas();

    require_once 'views/actividades/V_asignaturas.php';
  }
}

?>