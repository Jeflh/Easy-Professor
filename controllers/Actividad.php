<?php

class ActividadController{

  public function __construct(){
    require_once 'models/M_alumno.php';
    require_once 'models/M_asignatura.php';
    require_once 'models/M_actividad.php';
    require_once 'models/M_calificacion.php';
    
    $auth = autenticado();
    if ($auth == false) {
      header('Location: index.php?c=login');
    }

    $alumnos = new AlumnoModel();
    $this->listaInterna['alumnos'] = $alumnos->getAlumnos();
    
  }

  public function index(){
    $asignatura = new AsignaturaModel();
    $materia['materia'] = $asignatura->getAsignatura();
    $this->asignatura = $materia['materia']['id_asignatura'];

    $actividades = new ActividadModel();
    $datos['actividades'] = $actividades->getActividades();
    
    require_once 'views/actividades/V_actividades.php';
  }

  public function nueva(){
    if(isset($_POST)){
      require_once 'views/actividades/V_nuevaActividad.php';
    }
  }

  public function crear(){
    $actividad = new ActividadModel();
    
    if(isset($_POST)){
      if($actividad->insertarActividad()){
        header('Location: index.php?c=actividad&id=' . $_POST['asignatura'] . '&e=0' );
      }  
    }
  }

  public function editar(){
    $actividad = new ActividadModel();
    $datos['actividad'] = $actividad->getActividad($_GET['f']);

    require_once 'views/actividades/V_editarActividad.php';
  }

  public function actualizar(){
    $actividad = new ActividadModel();

    if($actividad->updateActividad()){
      header('Location: index.php?c=actividad&id=' . $_POST['asignatura'] . '&e=1' );
      
    }
  }

  public function eliminar(){
    if(isset($_GET)){

      $actividad = new ActividadModel();
      $actividad->eliminarActividad($_GET['f']);

      header('Location: index.php?c=actividad&id='. $_GET['id'] . '&e=2' );
    }
  }
}

?>