<?php

class UsuariosModel{
  private $db;
  private $usuario;

  private $nombre;
  private $apellido;
  private $correo;
  private $password;
  private $grado;


  public function __construct(){
    $this->db = Conectar::conexion();
  }

  public function getUsuario(){ 
    return $this->usuario;
  }

  public function insertarUsuario(){
    $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
    $this->apellido = mysqli_real_escape_string($this->db, $_POST['apellido']);
    $this->correo = mysqli_real_escape_string($this->db, $_POST['correo']);
    $this->password = mysqli_real_escape_string($this->db, $_POST['password']);
    $this->grado = mysqli_real_escape_string($this->db, $_POST['grado']);

    $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);

    $query = $this->db->query("INSERT INTO usuarios (nombre, apellido, correo, password, grado) VALUES ('$this->nombre', '$this->apellido', '$this->correo', '$passwordHash', '$this->grado')");
  }

  public function actualizarUsuario(){
    $usuario = $_SESSION['usuario']['id_usuario'];
    $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
    $this->apellido = mysqli_real_escape_string($this->db, $_POST['apellido']);
    $this->correo = mysqli_real_escape_string($this->db, $_POST['correo']);
    $this->password = mysqli_real_escape_string($this->db, $_POST['password']);
    $this->grado = mysqli_real_escape_string($this->db, $_POST['grado']);

    $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);

    $query = $this->db->query("UPDATE usuarios SET nombre = '$this->nombre', apellido = '$this->apellido', correo = '$this->correo', password = '$passwordHash', grado = '$this->grado' WHERE id_usuario = '$usuario'");
    
  }

  public function consultarUsuario(){
    $this->correo = mysqli_real_escape_string($this->db, $_POST['correo']);

    $query = $this->db->query("SELECT * FROM usuarios WHERE correo = '$this->correo'"); 
    
    $this->usuario = $query->fetch_assoc();
  }

  public function validarCorreo(){
    $this->correo = mysqli_real_escape_string($this->db, $_POST['correo']);

    $query = $this->db->query("SELECT * FROM usuarios WHERE correo = '$this->correo'"); 
    
    $this->usuario = $query->fetch_assoc();
    
    if($this->usuario){
      return true;
    } else {
      return false;
    }
  }
}

?>