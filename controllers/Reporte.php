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
    require_once 'models/M_reporte.php';
    require_once 'models/M_alumno.php';
    require_once 'models/M_asistencia.php';
    require_once 'models/M_calificacion.php';
    require_once 'models/M_asignatura.php';
    require_once 'models/M_actividad.php';
  }
  
  public function index() {
    require_once 'views/reporte/V_config.php';
  }

  public function elegir() {
    $reporte = new ReporteModel();
    $reporte->trabajos = $_POST['trabajos'];
    $reporte->tareas = $_POST['tareas'];
    $reporte->examenes = $_POST['examenes'];
    $reporte->inicio = $_POST['inicio'];
    $reporte->fin = $_POST['fin'];

    require_once 'views/reporte/V_elegir.php';
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

  public function generarIndividual(){
    
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      $trabajos = $_GET['1'];
      $tareas = $_GET['2'];
      $examenes = $_GET['3'];
      $f_inicio = $_GET['4'];
      $f_fin = $_GET['5'];

      $modeloAlumno = new AlumnoModel();
      $asistencia = new AsistenciaModel();
      $calificacion = new CalificacionModel();
      $asignatura = new AsignaturaModel();
      $actividad = new ActividadModel();

      $p_trabajos = $trabajos/100;
      $p_tareas = $tareas/100;
      $p_examenes = $examenes/100;

      $diasHabiles = daysWeek($f_inicio, $f_fin);

      $alumno['info'] = $modeloAlumno->getInfoAlumno($id);
      $alumno['asistencia'] = $asistencia->getAsistencias($id, $f_inicio, $f_fin);
      $alumno['asignaturas'] = $asignatura->getAsignaturas();
      $alumno['calificacion'] = $calificacion->getCalificaciones($id, $f_inicio, $f_fin);

      $totalAsistencia = 0;

      foreach($alumno['asistencia'] as $asistencia){
        $actual = $asistencia['asistencia'];

        if ($actual == '1') {
          $totalAsistencia++;
        }
      }

      $porcentajeAsistencia = round(($totalAsistencia * 100) / $diasHabiles, 2);
      
      foreach($alumno['calificacion'] as $calificacion){
        foreach($alumno['asignaturas'] as $asignatura){
          if($calificacion['id_asignatura'] == $asignatura['id_asignatura']){
            $tipo = $actividad->getActividad($calificacion['id_actividad']);
            $datosCal [] = array(
              'id_asignatura' => $asignatura['id_asignatura'],
              'nombre' => $asignatura['nombre_asignatura'],
              'tipo' => $tipo['tipo'],
              'calificacion' => $calificacion['calificacion']
              
            );
          }
        }
      }
      
      $nombreMaterias = array_column($alumno['asignaturas'], 'nombre_asignatura');

      $trabajos = 0;
      $tareas = 0;
      $examenes = 0;

      $calTrabajos = 0;
      $calTareas = 0;
      $calExamenes = 0;

      for($i = 0; $i < count($nombreMaterias); $i++){
        $actual = $nombreMaterias[$i];

        for($j = 0; $j < count($datosCal); $j++){
          if($datosCal[$j]['nombre'] == $actual){
            if($datosCal[$j]['tipo'] == '1'){
              $calTrabajos += $datosCal[$j]['calificacion'];
              $trabajos++;
            }
            if($datosCal[$j]['tipo'] == '2'){
              $calTareas += $datosCal[$j]['calificacion'];
              $tareas++;
            }
            if($datosCal[$j]['tipo'] == '3'){
              $calExamenes += $datosCal[$j]['calificacion'];
              $examenes++;
            }
          }
        }

        $final [] = array (
          'nombre' => $actual,
          'promedioTrabajos' => round($calTrabajos/$trabajos, 2),
          'promedioTareas' =>  round($calTareas/$tareas, 2),
          'promedioExamenes' =>  round($calExamenes/$examenes, 2),
          'calificacion' => round((($calTrabajos/$trabajos) * $p_trabajos) + (($calTareas/$tareas) * $p_tareas) + (($calExamenes/$examenes) * $p_examenes), 2)
        );
      }

      // echo '<pre>';
      // var_dump($final);
      // echo '</pre>';

      require_once 'views/reporte/V_generadoIndividual.php';
    }  
  }
}

?>