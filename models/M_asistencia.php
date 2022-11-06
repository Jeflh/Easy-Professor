<?php 

class AsistenciaModel{
  private $db;
  private $listaAsistencia; 

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->listaAsistencia = array();
  }

  public function getDia($fecha){
    $query = $this->db->query("SELECT * FROM asistencias WHERE fecha_asistencia = '$fecha' ");

    while($row = $query->fetch_assoc()) {
      $this->listaAsistencia[] = $row;
    }

    return $this->listaAsistencia;
  }

  public function setDia($asistenciaAlumno){
    $fecha_asistencia = $asistenciaAlumno['fecha_asistencia'];
    $id_alumno = $asistenciaAlumno['id_alumno'];
    $asistencia = $asistenciaAlumno['asistencia'];
    
    $query = $this->db->query("INSERT INTO asistencias (fecha_asistencia, id_alumno, asistencia)  VALUES('$fecha_asistencia', '$id_alumno', '$asistencia')");
  }

  public function updateDia($asistenciaAlumno){
    $fecha_asistencia = $asistenciaAlumno['fecha_asistencia'];
    $id_alumno = $asistenciaAlumno['id_alumno'];
    $asistencia = $asistenciaAlumno['asistencia'];


    $query = $this->db->query("UPDATE asistencias SET asistencia = '$asistencia' WHERE fecha_asistencia = '$fecha_asistencia' AND id_alumno = '$id_alumno'");
  }

  public function existeDia($fecha){
    $query = $this->db->query("SELECT * FROM asistencias WHERE fecha_asistencia = '$fecha' ");

    if($query->num_rows > 0){
      return true;
    } else {
      return false;
    }
  }

  public function eliminarAsistencias(){
    $id= $_GET['id'];
    $query = $this->db->query("DELETE FROM asistencias WHERE id_alumno = '$id'");
  }
}

?>