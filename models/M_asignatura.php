<?php 

class AsignaturaModel{
  private $db;
  private $listaAsignaturas; 

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->listaAsignaturas = array();
  }

  public function getAsignaturas(){
    $grado = $_SESSION['usuario']['grado'];
    $query = $this->db->query("SELECT * FROM asignaturas WHERE grado = '$grado'");

    while($row = $query->fetch_assoc()) {
      $this->listaAsignaturas[] = $row;
    }

    return $this->listaAsignaturas;
  }

  public function getAsignatura(){
    if(isset($_GET)){
      $id = $_GET['id'];
      $query = $this->db->query("SELECT * FROM asignaturas WHERE id_asignatura = '$id'");
      $row = $query->fetch_assoc();
      return $row;
    }
  }

  public function getEspecifico($id){
    $query = $this->db->query("SELECT * FROM asignaturas WHERE id_asignatura = '$id'");
    $row = $query->fetch_assoc();
    return $row;
  }
}

?>