<?php

class AlumnoController{

  public function __construct(){
    require_once 'models/M_alumno.php';
    require_once 'models/M_domicilio.php';
    
    $auth = autenticado();
    if ($auth == false) {
      header('Location: index.php?c=login');
    }
  }
  public function index(){
    require_once 'views/V_nuevoAlumno.php';
  }

  public function ver(){
    $alumno = new AlumnosModel();
    $domicilio = new DomicilioModel();
    $datosAlumno[0] = $alumno->getInfoAlumno();
    $datosAlumno[1] = $domicilio->getDomicilio($_GET['id']);
      
    require_once 'views/V_alumno.php';
  }

  public function registrar(){
    $alumno = new AlumnosModel();
    $domicilio = new DomicilioModel();
    
    if(isset($_POST)){
      $valido = $alumno->validarAlumno();
      if($valido == true){
        $domicilio->insertarDomicilio();
      }
    }
  }

  public function editar(){
    $alumno = new AlumnosModel();
    $domicilio = new DomicilioModel();
    $datosAlumno[0] = $alumno->getInfoAlumno();
    $datosAlumno[1] = $domicilio->getDomicilio($_GET['id']);
    
    require_once 'views/V_editarAlumno.php';

  }

  public function actualizar(){
    $alumno = new AlumnosModel();
    $domicilio = new DomicilioModel();
    if(isset($_POST)){
      $valido = $alumno->validarActualizado();
      if($valido == true){
        $domicilio->actualizarDomicilio();
      }

    }
  }

  public function eliminar(){
    $alumno = new AlumnosModel();
    $domicilio = new DomicilioModel();
    $alumno->eliminarAlumno();
    $domicilio->eliminarDomicilio();
    $date =  date('Y/m/d');
    header("Location: index.php?c=asistencia&f=$date&e=1");
  }
}

?>