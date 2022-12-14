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
    $fecha = $calificacion['fecha_cal'];
    $id_alumno = $calificacion['id_alumno'];
    $actividad = $calificacion['actividad'];
    $materia = $calificacion['materia'];
    $calificacion = $calificacion['calificacion'];
    

    $query = $this->db->query("INSERT INTO calificacion (fecha_cal, id_alumno, id_actividad, calificacion, id_asignatura) VALUES ('$fecha', '$id_alumno', '$actividad', '$calificacion', '$materia')");
  }

  public function updateCal($calificacion){
    $id_alumno = $calificacion['id_alumno'];
    $actividad = $calificacion['actividad'];
    $materia = $calificacion['materia'];
    $calificacion = $calificacion['calificacion'];

    $query = $this->db->query("UPDATE calificacion SET calificacion = '$calificacion', id_asignatura = '$materia' WHERE id_alumno = '$id_alumno' AND id_actividad = '$actividad'");
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

  public function getCalificaciones($id, $inicio, $fin){
    $query = $this->db->query("SELECT * FROM calificacion WHERE id_alumno = '$id' AND fecha_cal BETWEEN '$inicio' AND '$fin'");

    while($row = $query->fetch_assoc()) {
      $this->listaCalificaciones[] = $row;
    }

    return $this->listaCalificaciones;
  }
}

?>