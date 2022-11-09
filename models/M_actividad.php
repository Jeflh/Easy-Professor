<?php 

class ActividadModel{
  private $db;
  private $listaActividades; 

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

  public function getActividad(){
    if(isset($_GET)){
      $id = $_GET['id'];
      $query = $this->db->query("SELECT * FROM actividades WHERE id_actividad = '$id'");

      $row = $query->fetch_assoc();

      return $row;
    }
  }

  public function updateActividad(){
    if(isset($_POST)){
      $id = $_POST['id'];
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $fecha = $_POST['fecha'];

      $query = $this->db->query("UPDATE actividades SET nombre_act = '$nombre', descripcion = '$descripcion', fecha_actividad = '$fecha' WHERE id_actividad = '$id'");
    }
  }

  public function insertarActividad(){
    if(isset($_POST)){
      $asignatura = $_POST['asignatura'];
      $nombre = $_POST['nombre'];
      $tipo = $_POST['tipo'];
      $descripcion = $_POST['descripcion'];
      $fecha = $_POST['fecha'];


      $query = $this->db->query("INSERT INTO actividades (id_asignatura, nombre_act, tipo, descripcion, fecha_actividad) VALUES ('$asignatura', '$nombre', '$tipo', '$descripcion', '$fecha')");
    }
  }

  public function eliminarActividad(){
    if(isset($_GET)){
      $id = $_GET['id'];
      $query = $this->db->query("DELETE FROM actividades WHERE id_actividad = '$id'");
    }
  }
}

?>