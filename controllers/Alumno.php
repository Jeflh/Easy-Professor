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

  public function ver(){

    $alumno = new AlumnosModel();
    $domicilio = new DomicilioModel();
    $datosAlumno[0] = $alumno->getInfoAlumno();
    $datosAlumno[1] = $domicilio->getDomicilio($_GET['id']);
      
    require_once 'views/V_alumno.php';
  }


}

?>