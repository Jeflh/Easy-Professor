<?php


class AlumnosModel{
  private $db;
  private $infoAlumno;
  private $alumnos;

  private $id_usuario;

  private $nombre;
  private $apellido;
  private $sexo;
  private $curp;
  private $edad;
  private $estatura;

  private $nombre_tutor;
  private $telefono;
  private $discapacidad;
  private $observacion;

  public function __construct(){
    $this->db = Conectar::conexion();
  }

  public function validar() {
    $error = '';

    if(empty($nombre) || is_numeric($nombre)) {
      $error .= '1';  // El nombre es requerido
    }
    if(empty($this->apellido) || is_numeric($this->apellido)) {
      $error .= '2';  // El apellido es requerido
    }
    if(empty($this->curp)){
      $error .= '3';  // La CURP es requerida
    }
    if(empty($this->edad)) {
      $error .= '4';  // La edad es requerida
    }
    if(empty($this->estatura)) {
      $error .= '5';  // La estatura es requerida
    }
    if(empty($this->nombre_tutor) || is_numeric($this->nombre_tutor)) {
      $error .= '6';  // El nombre del tutor es requerido
    }
    if(empty($this->telefono)) {
      $error .= '7';  // El teléfono es requerido
    }

    if ($error == '') {
      $this->insertar();
    } else {
      echo "Error: $error";
      //header("Location: index.php?c=alumno&a=validar&e=$error");
    }
  }

  public function insertar() {
    $this->id_usuario = $_SESSION['usuario']['id_usuario'];
    $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
    $this->apellido = mysqli_real_escape_string($this->db, $_POST['apellido']);
    $this->sexo = mysqli_real_escape_string($this->db, $_POST['sexo']);
    $this->curp = mysqli_real_escape_string($this->db, $_POST['curp']);
    $this->edad = mysqli_real_escape_string($this->db, $_POST['edad']);
    $this->estatura = mysqli_real_escape_string($this->db, $_POST['estatura']);

    $this->nombre_tutor = mysqli_real_escape_string($this->db, $_POST['nombre_tutor']);
    $this->telefono = mysqli_real_escape_string($this->db, $_POST['telefono']);
    $this->discapacidad = mysqli_real_escape_string($this->db, $_POST['discapacidad']);
    $this->observacion = mysqli_real_escape_string($this->db, $_POST['observacion']);

    $query = $this->db->query("INSERT INTO alumnos (id_usuario, nombre, apellido, sexo, curp, edad, estatura, nombre_tutor, telefono, discapacidad, observacion) VALUES ('$this->id_usuario', '$this->nombre', '$this->apellido', '$this->sexo', '$this->curp', '$this->edad', '$this->estatura', '$this->nombre_tutor', '$this->telefono', '$this->discapacidad', '$this->observacion')");
    
    echo "Alumno registrado correctamente";
    //header("Location: index.php?c=alumno&e=0");
  }

  public function validarExistencia() {
    $this->curp = mysqli_real_escape_string($this->db, $_POST['curp']);
    $query = $this->db->query("SELECT * FROM alumnos WHERE curp = '$this->curp'");
    $row = $query->fetch_assoc();
    if ($row['curp'] == $this->curp) {
      return true;
    } else {
      return false;
    }
  }

  public function getAlumnos() {
    $this->id_usuario = $_SESSION['usuario']['id_usuario'];
    $query = $this->db->query("SELECT * FROM alumnos WHERE id_usuario = '$this->id_usuario' ORDER BY apellido ASC");

    $this->alumnos = array();

    while($row = $query->fetch_assoc()) {
      $this->alumnos[] = $row;
    }

    return $this->alumnos;
  }

  
  public function getInfoAlumno() {
    $this->id_alumno = $_GET['id'];

    $query = $this->db->query("SELECT * FROM alumnos WHERE id_alumno = '$this->id_alumno'");

    $this->infoAlumno = $query->fetch_assoc();

    return $this->infoAlumno;
  }
}

?>