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
      $query = $this->db->query("SELECT * FROM actividades WHERE id_asignatura = '$asignatura'");

      while($row = $query->fetch_assoc()) {
        $this->listaActividades[] = $row;
      }

      return $this->listaActividades;
    }
  }
}

?>