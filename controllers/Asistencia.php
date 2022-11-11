<?php

class AsistenciaController
{
  private $auth;
  private $listaInterna;

  public function __construct()
  {
    require_once 'models/M_alumno.php';
    require_once 'models/M_asistencia.php';
    $this->auth = autenticado();

    if ($this->auth) {  // Si el usuario está autenticado se genera la lista de alumnos 
      $alumnos = new AlumnoModel();
      $this->listaInterna['alumnos'] = $alumnos->getAlumnos();
      // La lista se almacena para la misma clase, aunque esta será compartida con la vista en la función index(), se hace para no hacer dos consultas a la base de datos.

      if (isset($_GET['fecha'])) {  // Si se ha enviado una fecha por GET se almacena en una variable interna
        $this->fechaInterna = $_GET['fecha'];
      } else {  // Si no se ha enviado una fecha por GET se almacena la fecha actual
        $this->fechaInterna = date('Y-m-d');
      }
    }
  }

  public function index()
  {

    if ($this->auth) {
      $lista['alumnos'] = $this->listaInterna['alumnos'];

      if (isset($_GET['f'])) {
        $fecha = $_GET['f'];
        $this->fechaInterna = $fecha;
        $listaAsistencia = new AsistenciaModel();
        $lista['asistencias'] = $listaAsistencia->getDia($fecha);
      }

      require_once 'views/asistencias/V_asistencias.php'; // Si el usuario está autenticado

    } else {
      header('Location: index.php?c=login'); // Si no está autenticado se va al login
    }
  }

  public function guardar() {
    if(isset($_POST)){
      $asistencia = new AsistenciaModel();

      $datosExistentes = $asistencia->existeDia($_POST['fecha']);

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

  public function fecha(){
    if(isset($_POST)){
      $fecha = $_POST['cambioFecha'];
      $fecha = str_replace('-', '/', $fecha);
      header('Location: index.php?c=asistencia&f='.$fecha);
    }
  }
}