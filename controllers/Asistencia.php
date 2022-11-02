<?php

class AsistenciaController{
  private $auth;
  private $listaInterna;

  public function __construct(){
    require_once 'models/M_alumno.php';
    require_once 'models/M_domicilio.php';
    $this->auth = autenticado();

    if($this->auth){  // Si el usuario está autenticado se genera la lista de alumnos 
      $alumnos = new AlumnosModel();
      $this->listaInterna['alumnos'] = $alumnos->getAlumnos(); 
      // La lista se almacena para la misma clase, aunque esta será compartida con la vista en la función index(), se hace para no hacer dos consultas a la base de datos.
    }
  }

  public function index(){
    
    if($this->auth){  
      $lista['alumnos'] = $this->listaInterna['alumnos'];
      
      if(isset($_GET['f'])){
        $fecha = $_GET['f'];
      }

      require_once 'views/V_asistencias.php'; // Si el usuario está autenticado

    } else {
      header('Location: index.php?c=login'); // Si no está autenticado se va al login
    }
  }

  public function guardar(){

    if (isset($_POST)) { 
      $i = 0;
      foreach ($_POST as $key) { 
        if($key == $this->listaInterna['alumnos'][$i]['id_alumno']){ // Se compara el id del alumno con el id del checkbox
          $asistencia [] = $key; // Si son iguales se almacena el valor del checkbox en el array $asistencia
        }
        $i++;
      }

      var_dump($asistencia);
     
    }

  }

}

?>