<?php

class CalificarController{

  public function __construct(){
    require_once 'models/M_alumno.php';
    require_once 'models/M_asignatura.php';
    require_once 'models/M_actividad.php';
    require_once 'models/M_calificacion.php';
    
    $auth = autenticado();
    if ($auth == false) {
      header('Location: index.php?c=login');
    }


    
  }

  public function index(){
    $alumnos = new AlumnoModel();
    $listaAlumnos['alumnos'] = $alumnos->getAlumnos();

    $calificacion = new CalificacionModel();
    $listaAlumnos['calificaciones'] = $calificacion->getCal($_GET['id']);

    $actividad = new ActividadModel();
    $datos['actividad'] = $actividad->getActividad($_GET['id']);


    require_once 'views/calificaciones/V_calificar.php';
  }

  public function guardar(){
    if(isset($_POST)){
      echo "<pre>";
      var_dump($_POST);
      echo "</pre>";
    }
  }

}

?>