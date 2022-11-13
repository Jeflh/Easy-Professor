<?php

class ReporteController{
  private $auth;

  private $trabajos;
  private $tareas;
  private $examenes;
  private $inicio;
  private $fin;
  
  public function __construct() {
    $this->auth = autenticado();

    if (!$this->auth) {
      header('Location: index.php?c=login');
    }
    //require_once 'models/M_reporte.php';
    require_once 'models/M_alumno.php';
    require_once 'models/M_asistencia.php';
    require_once 'models/M_calificacion.php';
  }
  
  public function index() {
    require_once 'views/reporte/V_config.php';
  }

  public function elegir() {
    require_once 'views/reporte/V_reporte.php';
  }

  public function config(){
  
    $this->trabajos = $_POST['trabajos'];
    $this->tareas = $_POST['tareas'];
    $this->examenes = $_POST['examenes'];
    $this->inicio = $_POST['inicio'];
    $this->fin = $_POST['fin'];

    $error = '';

    if($this->trabajos == '' || $this->tareas == '' || $this->examenes == ''){
      $error = '1'; // Campos vacios
    } 
    
    if(!is_numeric($this->trabajos) && !is_numeric($this->tareas) && !is_numeric($this->examenes)){
      $error .= '2'; //No son números
    }

    if(intval($this->trabajos) + intval($this->tareas) + intval($this->examenes) != 100){
      $error .= '3'; //La suma de los porcentajes no es 100
    } 

    if(!validDate($this->inicio) || !validDate($this->fin)){
      $error .= '4'; //Formato de fecha incorrecto
    }

    if($error == ''){
      $this->elegir();
    } else {
      header('Location: index.php?c=reporte&e='.$error);
    }
  }

  public function individual() {
    $alumnos = new AlumnoModel();
    $lista['alumnos'] = $alumnos->getAlumnos();
    
    require_once 'views/reporte/V_individual.php'; // Si el usuario está autenticado
  }
}

?>