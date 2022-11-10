<?php

class ActividadController{

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

  public function ver(){
    if(isset($_GET)){
      $id = $_GET['id'];
      $actividad = new ActividadModel();
      $datos['actividad'] = $actividad->getActividad($id);
      require_once 'views/actividades/V_actividad.php';
    }
  }

  public function nueva(){
    if(isset($_POST)){
      $actividad = new ActividadModel();
      require_once 'views/actividades/V_nuevaActividad.php';
    }
  }

  public function crear(){
    $actividad = new ActividadModel();
    
    if(isset($_POST)){
      $actividad->insertarActividad();
    }

    header('Location: index.php?c=actividades');
  }

  public function editar(){
    $actividad = new ActividadModel();
    $datos['actividad'] = $actividad->getActividad($_GET['id']);

    require_once 'views/actividades/V_editarActividad.php';
  }

  public function eliminar(){
    if(isset($_GET)){
      $id = $_GET['id'];
      $actividad = new ActividadModel();
      $actividad->eliminarActividad($id);
      
    }
  }
}

?>