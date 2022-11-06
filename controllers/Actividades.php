<?php

class ActividadesController{

  public function __construct(){
    require_once 'models/M_asignatura.php';
    require_once 'models/M_actividad.php';
    
    $auth = autenticado();
    if ($auth == false) {
      header('Location: index.php?c=login');
    }
  }
  public function index(){
    $asignatura = new AsignaturaModel();
    $materia['materia'] = $asignatura->getAsignatura();

    $actividades = new ActividadModel();
    $datos['actividades'] = $actividades->getActividades();
    
    require_once 'views/actividades/V_actividades.php';
  }
}

?>