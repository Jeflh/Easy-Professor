<?php

class AlumnoController{

  public function __construct(){
    require_once 'models/M_alumno.php';
    require_once 'models/M_domicilio.php';
    require_once 'models/M_asistencia.php';
    
    $auth = autenticado();
    if ($auth == false) {
      header('Location: index.php?c=login');
    }
  }
  public function index(){
    require_once 'views/alumno/V_nuevoAlumno.php';
  }

  public function ver(){
    $alumno = new AlumnoModel();
    $domicilio = new DomicilioModel();
    $datosAlumno[0] = $alumno->getInfoAlumno();
    $datosAlumno[1] = $domicilio->getDomicilio($_GET['id']);
      
    require_once 'views/alumno/V_alumno.php';
  }

  public function registrar(){
    $alumno = new AlumnoModel();
    $domicilio = new DomicilioModel();
    
    if(isset($_POST)){
      $valido = $alumno->validarAlumno();
      if($valido == true){
        $domicilio->insertarDomicilio();
        header('Location: index.php?c=asistencia&f=' . date('Y-m-d') . '&e=1');
      }
    }
  }

  public function editar(){
    $alumno = new AlumnoModel();
    $domicilio = new DomicilioModel();
    $datosAlumno[0] = $alumno->getInfoAlumno();
    $datosAlumno[1] = $domicilio->getDomicilio($_GET['id']);
    
    require_once 'views/alumno/V_editarAlumno.php';

  }

  public function actualizar(){
    $alumno = new AlumnoModel();
    $domicilio = new DomicilioModel();
    if(isset($_POST)){
      $valido = $alumno->validarActualizado();
      if($valido == true){
        $domicilio->actualizarDomicilio();
        header('Location: index.php?c=alumno&a=ver&id=' . $_GET['id'] . '&e=0');
      }

    }
  }

  public function eliminar(){
    $alumno = new AlumnoModel();
    $domicilio = new DomicilioModel();
    $asistencia = new AsistenciaModel();

    $alumno->eliminarAlumno();
    $asistencia->eliminarAsistencias();
    $domicilio->eliminarDomicilio();
    header("Location: index.php?c=asistencia&f=" . date('Y/m/d') ."&e=2");
  }
}

?>