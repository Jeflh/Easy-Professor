<?php

class UsuariosModel{
  private $db;
  private $usuario;


  public function __construct(){
    $this->db = Conectar::conexion();
    $this->usuario;
  }

  public function getUsuario($usuario){
    $query = $this->db->query("SELECT '$usuario' FROM usuarios");
    $this->usuario = $query->fetch_assoc();
    
    return $this->usuario;
  }

  public function insertarUsuario($nombre, $apellido, $correo, $password, $grado){
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