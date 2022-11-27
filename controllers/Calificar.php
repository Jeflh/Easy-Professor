<?php

class CalificarController{
  private $listaInterna;

  public function __construct(){
    require_once 'models/M_alumno.php';
    require_once 'models/M_asignatura.php';
    require_once 'models/M_actividad.php';
    require_once 'models/M_calificacion.php';
    
    $auth = autenticado();
    if ($auth == false) {
      header('Location: index.php?c=login');
    }

    $lista = new AlumnoModel();
    $this->listaInterna['alumnos'] = $lista->getAlumnos();

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

      $calificar = new CalificacionModel();
      $datosExistentes = $calificar->existeCal($_POST['actividad']);

      if(!$datosExistentes){
        for($i = 0; $i < count($this->listaInterna['alumnos']); $i++){
          $calificacionesIniciales [] = array(
            'fecha_cal' => $_POST['fecha'],
            'id_alumno' => $this->listaInterna['alumnos'][$i]['id_alumno'],
            'actividad' => $_POST['actividad'],
            'materia' => $_POST['materia'],
            'calificacion' => -1
          );
          $calificar->setCal($calificacionesIniciales[$i]);
        }
        exit;
        $this->guardar();
      }
      else {
        $j = 0;
        foreach ($_POST as $key => $value) {
          if ($key != 'fecha' && $key != 'actividad' && $key != 'materia'){
            $confirmado [$j] = array(
              'fecha_cal' => $_POST['fecha'],
              'id_alumno' => $key,
              'actividad' => $_POST['actividad'],
              'materia' => $_POST['materia'],
              'calificacion' => $value
            );
            if($datosExistentes){
              $calificar->updateCal($confirmado[$j]);
            }
            $j++;
          }
        }
        header('Location: index.php?c=calificar&id='. $_POST['actividad'] . '&e=0');
      }
    }
  }    
}


  /*
  public function guardar() {
    if(isset($_POST)){

      if(!$datosExistentes){
        for($i = 0; $i < count($this->listaInterna['alumnos']); $i++){
          $asistenciasIniciales [] = array(
            'fecha_asistencia' => $_POST['fecha'],
            'id_alumno' => $this->listaInterna['alumnos'][$i]['id_alumno'],
            'asistencia' => 0
          );
          $asistencia->setDia($asistenciasIniciales[$i]);
          $this->guardar();
        }
      }else {
        for($i = 0; $i < count($this->listaInterna['alumnos']); $i++){
          $asistenciasIniciales [] = array(
            'fecha_asistencia' => $_POST['fecha'],
            'id_alumno' => $this->listaInterna['alumnos'][$i]['id_alumno'],
            'asistencia' => 0
          );
          $asistencia->updateDia($asistenciasIniciales[$i]);
        }
        $j = 0;
        foreach ($_POST as $key => $value) {
          if ($key != 'fecha'){
            $confirmado [] = array(
              'fecha_asistencia' => $_POST['fecha'],
              'id_alumno' => $key,
              'asistencia' => 1
            );
            if($datosExistentes){
              $asistencia->updateDia($confirmado[$j]);
            }
          }
          $j++;
        }
      }
      header('Location: index.php?c=asistencia&f='.$_POST['fecha'].'&e=0');
    }
  }
  */