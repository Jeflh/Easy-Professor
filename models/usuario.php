<?php

class UsuariosModel{
  private $db;
  private $usuarios;


  public function __construct(){
    $this->db = Conectar::conexion();
    $this->usuarios = array();
  }

  public function getUsuario(){
    $query = $this->db->query("SELECT * FROM usuarios");

    while($filas = $query->fetch_assoc()){
      $this->usuarios[] = $filas;
    }
    
    return $this->usuarios;
  }

  public function setUsuario($nombre, $apellido, $correo, $password, $grado){

    $nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($this->db, $_POST['apellido']);
    $correo = mysqli_real_escape_string($this->db, $_POST['correo']);
    $password = mysqli_real_escape_string($this->db, $_POST['password']);
    $grado = mysqli_real_escape_string($this->db, $_POST['grado']);

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $query = $this->db->query("INSERT INTO usuarios (nombre, apellido, correo, password, grado) VALUES ('$nombre', '$apellido', '$correo', '$passwordHash', '$grado')");
  }
}

?>