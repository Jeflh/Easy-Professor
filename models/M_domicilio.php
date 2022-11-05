<?php

class DomicilioModel extends AlumnosModel{
  private $db;
  private $domicilio;

  private $id_alumno;
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
    $alumno = new AlumnosModel();
    $alumno = $alumno->validarExistencia($_POST['curp']);

    $this->id_alumno = $alumno['id_alumno'];
    $this->estado = mysqli_real_escape_string($this->db, $_POST['estado']);
    $this->municipio = mysqli_real_escape_string($this->db, $_POST['municipio']);
    $this->calle = mysqli_real_escape_string($this->db, $_POST['calle']);
    $this->numero = mysqli_real_escape_string($this->db, $_POST['numero']);
    $this->colonia = mysqli_real_escape_string($this->db, $_POST['colonia']);
    $this->cp = mysqli_real_escape_string($this->db, $_POST['cp']);
    
    $query = $this->db->query("INSERT INTO domicilio (id_alumno, estado, municipio, calle, numero, colonia, cp) VALUES ('$this->id_alumno', '$this->estado', '$this->municipio', '$this->calle', '$this->numero', '$this->colonia', '$this->cp')");

    header("Location: index.php?c=alumno&a=index&e=0");
  }

  public function actualizarDomicilio(){
    $alumno = new AlumnosModel();
    $alumno = $alumno->validarExistencia($_POST['curp']);

    $this->id_alumno = $alumno['id_alumno'];
    $this->estado = mysqli_real_escape_string($this->db, $_POST['estado']);
    $this->municipio = mysqli_real_escape_string($this->db, $_POST['municipio']);
    $this->calle = mysqli_real_escape_string($this->db, $_POST['calle']);
    $this->numero = mysqli_real_escape_string($this->db, $_POST['numero']);
    $this->colonia = mysqli_real_escape_string($this->db, $_POST['colonia']);
    $this->cp = mysqli_real_escape_string($this->db, $_POST['cp']);
    
    $query = $this->db->query("UPDATE domicilio SET estado = '$this->estado', municipio = '$this->municipio', calle = '$this->calle', numero = '$this->numero', colonia = '$this->colonia', cp = '$this->cp' WHERE id_alumno = '$this->id_alumno'");

    header("Location: index.php?c=alumno&a=editar&id=$this->id_alumno&e=0");
  }

  public function getDomicilio($id){

    $query = $this->db->query("SELECT * FROM domicilio WHERE id_alumno = '$id'");

    while($filas = $query->fetch_assoc()){
      $this->domicilio[] = $filas;
    }
    return $this->domicilio;
  }

  public function eliminarDomicilio(){
    $id = $_GET['id'];
    $query = $this->db->query("DELETE FROM domicilio WHERE id_alumno = '$id'");  
  }
}

?>