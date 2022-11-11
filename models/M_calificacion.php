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

}

?>