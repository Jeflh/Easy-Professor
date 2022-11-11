<?php 

class ActividadModel{
  private $db;
  private $listaActividades; 

  private $actividad;
  private $usuario;
  private $nombre;
  private $descripcion;
  private $fecha;
  private $asignatura;

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->listaActividades = array();
  }

  public function getActividades(){
    if(isset($_GET)){
      $asignatura = $_GET['id'];
      $query = $this->db->query("SELECT * FROM actividades WHERE id_asignatura = '$asignatura' ORDER BY fecha_actividad DESC");

      while($row = $query->fetch_assoc()) {
        $this->listaActividades[] = $row;
      }

      return $this->listaActividades;
    }
  }

  public function getActividad($f){
    $query = $this->db->query("SELECT * FROM actividades WHERE id_actividad = '$f'");
    $row = $query->fetch_assoc();

    return $row;
  }

  public function updateActividad(){
    if(isset($_POST)){
      $this->actividad = mysqli_real_escape_string($this->db, $_POST['actividad']);
      $this->asignatura = mysqli_real_escape_string($this->db, $_POST['asignatura']);
      $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
      $this->tipo = mysqli_real_escape_string($this->db, $_POST['tipo']);
      $this->descripcion = mysqli_real_escape_string($this->db, $_POST['descripcion']);
      $this->fecha = mysqli_real_escape_string($this->db, $_POST['fecha']);

      $error = "";

      if(empty($this->nombre)){
        $error .= "1";
      }
      if(empty($this->tipo)){
        $error .= "2";
      }
      if(empty($this->fecha)){
        $error .= "3";
      }
      if(empty($this->descripcion)){
        $error .= "4";
      }

      if($error == ""){
        
        if(substr($this->tipo, 0, 1) == "1"){
          $this->tipo = "1";
        }else if (substr($this->tipo, 0, 1) == "2") {
          $this->tipo = "2";
        }else if (substr($this->tipo, 0, 1) == "3") {
          $this->tipo = "3";
        }

        $query = $this->db->query("UPDATE actividades SET nombre_act = '$this->nombre', tipo = '$this->tipo', descripcion = '$this->descripcion', fecha_actividad = '$this->fecha' WHERE id_actividad = '$this->actividad'");

        return true;

      } else {
        header('Location: index.php?c=actividad&a=editar&id='. $this->asignatura . '&f=' . $this->actividad . '&e='.$error);
      }
    }
  }

  public function insertarActividad(){
    if(isset($_POST)){
      var_dump($_POST);
      $this->usuario = $_SESSION['usuario']['id_usuario'];
      $this->asignatura = mysqli_real_escape_string($this->db, $_POST['asignatura']);
      $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
      if(isset($_POST['tipo'])){
        
      }else{
        $this->tipo = "";
      }
      $this->descripcion = mysqli_real_escape_string($this->db, $_POST['descripcion']);
      $this->fecha = mysqli_real_escape_string($this->db, $_POST['fecha']);

      $error = "";

      if(empty($this->nombre)){
        $error .= "1";
      }
      if(empty($this->tipo)){
        $error .= "2";
      }
      if(empty($this->fecha)){
        $error .= "3";
      }
      if(empty($this->descripcion)){
        $error .= "4";
      }
      
      if($error == ""){
        
        if(substr($this->tipo, 0, 1) == "1"){
          $this->tipo = "1";
        }else if (substr($this->tipo, 0, 1) == "2") {
          $this->tipo = "2";
        }else if (substr($this->tipo, 0, 1) == "3") {
          $this->tipo = "3";
        }

        $query = $this->db->query("INSERT INTO actividades (id_usuario, id_asignatura, nombre_act, tipo, descripcion, fecha_actividad) VALUES ('$this->usuario', '$this->asignatura', '$this->nombre', '$this->tipo', '$this->descripcion', '$this->fecha')");

        return true;

      } else {
        header('Location: index.php?c=actividad&a=nueva&id='.$this->asignatura.'&e='.$error);
      }
    }
  }

  public function eliminarActividad($f){
    $query = $this->db->query("DELETE FROM actividades WHERE id_actividad = '$f'");
  }
}

?>