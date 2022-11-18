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
    
    if( $this->inicio > $this->fin){
      $error .= '5'; //La fecha de inicio es mayor a la fecha de fin
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

      $promFinal = 0;
      foreach($final as $calificacion){
        $cal = floatval($calificacion['calificacion']);
        $promFinal += $cal;
      }

      $promFinal = round($promFinal/count($final), 2);

      
      require_once 'views/reporte/V_generadoIndividual.php';
    }  
  }

  public function generarDatos($id){
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

      $alumno['info'] = $modeloAlumno->getAlumno($id);
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

      $promFinal = 0;
      foreach($final as $calificacion){
        $cal = floatval($calificacion['calificacion']);
        $promFinal += $cal;
      }

      $promFinal = round($promFinal/count($final), 2);

      $datos = array(
        'porcentajeAsistencia' => $porcentajeAsistencia,
        'promFinal' => $promFinal,
        'final' => $final        
      );

      return $datos;
  }

  public function grupal(){
    $trabajos = $_GET['1'];
    $tareas = $_GET['2'];
    $examenes = $_GET['3'];
    $f_inicio = $_GET['4'];
    $f_fin = $_GET['5'];

    $p_trabajos = $trabajos/100;
    $p_tareas = $tareas/100;
    $p_examenes = $examenes/100;

    $alumnos = new AlumnoModel();
    $lista = $alumnos->getAlumnos();

    foreach($lista as $alumno){
      $datos [] = $this->generarDatos($alumno['id_alumno']);
    }

    $asignatura = new AsignaturaModel();
    $materias = $asignatura->getAsignaturas();
    $nombreMaterias = array_column($materias, 'nombre_asignatura');

    $i = 0;
    while($i < count($nombreMaterias)){
      $calTrabajos [$i] = 0;
      $calTareas [$i] = 0;
      $calExamenes [$i] = 0;
      $calTotal [$i] = 0;
      $i++;
    }
    
    // Asistencia
    $asistenciaTotal = 0;
    foreach($datos as $alumno){
      $asistencia = $alumno['porcentajeAsistencia'];
      $asistenciaTotal += $asistencia;
    }
    $asistenciaTotal = round($asistenciaTotal/count($datos), 2);

    for($i = 0; $i < count($lista); $i++){ //12 veces
      for($j = 0; $j < count($nombreMaterias); $j++){ //8 veces
        if($datos[$i]['final'][$j]['nombre'] == $nombreMaterias[$j]){
          $calTrabajos[$j] += $datos[$i]['final'][$j]['promedioTrabajos'];
          $calTareas[$j] += $datos[$i]['final'][$j]['promedioTareas'];
          $calExamenes[$j] += $datos[$i]['final'][$j]['promedioExamenes'];
          $calTotal[$j] += $datos[$i]['final'][$j]['calificacion'];
      
          $calificaciones [$nombreMaterias[$j]] = array(
            'promedioTrabajos' =>  $calTrabajos[$j],
            'promedioTareas' =>  $calTareas[$j],
            'promedioExamenes' =>  $calExamenes[$j],
            'calificacion' => $calTotal[$j]
          ); 
        }  
      }
    }
    
    foreach($nombreMaterias as $materia){
      $promTrabajos = round($calificaciones[$materia]['promedioTrabajos']/count($lista), 2);
      $promTareas = round($calificaciones[$materia]['promedioTareas']/count($lista), 2);
      $promExamenes = round($calificaciones[$materia]['promedioExamenes']/count($lista), 2);
      $promTotal = round($calificaciones[$materia]['calificacion']/count($lista), 2);

      $final [] = array(
        'nombre' => $materia,
        'promedioTrabajos' => $promTrabajos,
        'promedioTareas' => $promTareas,
        'promedioExamenes' => $promExamenes,
        'calificacion' => $promTotal
      );
    }

    $promFinal = 0;
    foreach($final as $calificacion){
      $cal = floatval($calificacion['calificacion']);
      $promFinal += $cal;
    }

    $promFinal = round($promFinal/count($final), 2);

    require_once 'views/reporte/V_generadoGrupal.php';
  }
}

?>