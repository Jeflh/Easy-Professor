<?php


class DomicilioModel extends AlumnosModel{
  private $db;

  private $domicilio;

  private $estado;
  private $municipio;
  private $calle;
  private $numero;
  private $colonia;
  private $cp;

  public function __construct(){
    $this->db = Conectar::conexion();
  }

  public function insertarDomicilio(){

    $this->estado = mysqli_real_escape_string($this->db, $_POST['estado']);
    $this->municipio = mysqli_real_escape_string($this->db, $_POST['municipio']);
    $this->calle = mysqli_real_escape_string($this->db, $_POST['calle']);
    $this->numero = mysqli_real_escape_string($this->db, $_POST['numero']);
    $this->colonia = mysqli_real_escape_string($this->db, $_POST['colonia']);
    $this->cp = mysqli_real_escape_string($this->db, $_POST['cp']);

    $query = $this->db->query("INSERT INTO domicilio (estado, municipio, calle, numero, colonia, cp) VALUES ('$this->estado', '$this->municipio', '$this->calle', '$this->numero', '$this->colonia', '$this->cp')");
  }


  public function getDomicilio($id){

    $query = $this->db->query("SELECT * FROM domicilio WHERE id_alumno = '$id'");

    while($filas = $query->fetch_assoc()){
      $this->domicilio[] = $filas;
    }
    return $this->domicilio;
  }
}

?>