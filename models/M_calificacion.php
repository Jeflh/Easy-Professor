<?php 

class CalificacionModel{
  private $db;
  private $listaCalificaciones; 

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->listaCalificaciones = array();
  }

  public function getCal($id_actividad){
    $query = $this->db->query("SELECT * FROM calificacion WHERE id_actividad = '$id_actividad'");

    while($row = $query->fetch_assoc()) {
      $this->listaCalificaciones[] = $row;
    }

    return $this->listaCalificaciones;
  }

  public function setCal($calificacion){
    $fecha = mysqli_real_escape_string($this->db, $calificacion['fecha_cal']);
    $id_alumno = mysqli_real_escape_string($this->db, $calificacion['id_alumno']);
    $actividad = mysqli_real_escape_string($this->db, $calificacion['actividad']);
    $calificacion = mysqli_real_escape_string($this->db, $calificacion['calificacion']);

    $query = $this->db->query("INSERT INTO calificacion (fecha_cal, id_alumno, id_actividad, calificacion) VALUES ('$fecha', '$id_alumno', '$actividad', '$calificacion')");
  }

  public function updateCal($calificacion){
    $fecha = mysqli_real_escape_string($this->db, $calificacion['fecha_cal']);
    $id_alumno = mysqli_real_escape_string($this->db, $calificacion['id_alumno']);
    $actividad = mysqli_real_escape_string($this->db, $calificacion['actividad']);
    $calificacion = mysqli_real_escape_string($this->db, $calificacion['calificacion']);

    $query = $this->db->query("UPDATE calificacion SET calificacion = '$calificacion' WHERE id_alumno = '$id_alumno' AND id_actividad = '$actividad'");
  }

  public function existeCal($actividad){
    $query = $this->db->query("SELECT * FROM calificacion WHERE id_actividad = '$actividad'");

    if($query->num_rows > 0){
      return true;
    }else{
      return false;
    }
  }

  public function eliminarCal(){
    $id_alumno = $_GET['id'];
    $query = $this->db->query("DELETE FROM calificacion WHERE id_alumno = '$id_alumno'");
  }

  public function eliminarTodas($id_actividad){
    $query = $this->db->query("DELETE FROM calificacion WHERE id_actividad = '$id_actividad'");
  }
}

?>