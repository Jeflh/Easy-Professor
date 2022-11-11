<?php


class AlumnoModel{
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
    $this->alumnos = array();
  }

  public function validarAlumno() {

    $this->id_usuario = $_SESSION['usuario']['id_usuario'];
    $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
    $this->apellido = mysqli_real_escape_string($this->db, $_POST['apellido']);

    if(isset($_POST['sexo'])){  // Si no se selecciona ningun sexo nada se envia por POST
      $this->sexo = mysqli_real_escape_string($this->db, $_POST['sexo']);
    } else {
      $this->sexo = '';
    }

    $this->curp = mysqli_real_escape_string($this->db, $_POST['curp']);
    $this->edad = mysqli_real_escape_string($this->db, $_POST['edad']);
    $this->estatura = mysqli_real_escape_string($this->db, $_POST['estatura']);

    $this->nombre_tutor = mysqli_real_escape_string($this->db, $_POST['nombre_tutor']);
    $this->telefono = mysqli_real_escape_string($this->db, $_POST['telefono']);
    $this->discapacidad = mysqli_real_escape_string($this->db, $_POST['discapacidad']);
    $this->observacion = mysqli_real_escape_string($this->db, $_POST['observacion']);

    $estado = mysqli_real_escape_string($this->db, $_POST['estado']);
    $municipio = mysqli_real_escape_string($this->db, $_POST['municipio']);
    $calle = mysqli_real_escape_string($this->db, $_POST['calle']);
    $numero = mysqli_real_escape_string($this->db, $_POST['numero']);
    $colonia = mysqli_real_escape_string($this->db, $_POST['colonia']);
    $cp = mysqli_real_escape_string($this->db, $_POST['cp']);

    $error = '';

    if(empty($this->nombre) || is_numeric($this->nombre)) {
      $error .= '1';  // El nombre es requerido
    }
    if(empty($this->apellido) || is_numeric($this->apellido)) {
      $error .= '2';  // El apellido es requerido
    }
    if(empty($this->sexo)) {
      $error .= '3';  // El sexo es requerido
    }
    if(empty($this->curp) || strlen($this->curp) != 18) {
      $error .= '4';  // La CURP es requerida
    }
    if(empty($this->edad)) {
      $error .= '5';  // La edad es requerida
    }
    if(empty($this->estatura)) {
      $error .= '6';  // La estatura es requerida
    }
    if(empty($this->nombre_tutor) || is_numeric($this->nombre_tutor)) {
      $error .= '7';  // El nombre del tutor es requerido
    }
    if(empty($this->telefono) || strlen($this->telefono) != 10) {
      $error .= '8';  // El teléfono es requerido
    }
    if($this->validarExistencia($this->curp)) {
      $error .= '9';  // El alumno ya existe
    }
    
    if(empty($estado) || is_numeric($estado)) {
      $error .= 'a';  // El estado es requerido
    }
    if(empty($municipio) || is_numeric($municipio)) {
      $error .= 'b';  // El municipio es requerido
    }
    if(empty($calle) || is_numeric($colonia)){
      $error .= 'c';  // La calle es requerida
    }
    if(empty($numero)) {
      $error .= 'd';  // El numero es requerido
    }
    if(empty($colonia) || is_numeric($colonia)){
      $error .= 'e';  // La colonia es requerida
    }
    if(empty($cp)) {
      $error .= 'f';  // El codigo postal es requerido
    }

    if ($error == '') {
      $this->insertarAlumno();
      return true;
    } else {
      header("Location: index.php?c=alumno&e=$error");
      return false;
    }
  }

  public function insertarAlumno() {
    
    if(!$this->validarExistencia($this->curp)){
      if($this->sexo == 'Masculino') {
        $this->sexo = 'H';
      } else {
        $this->sexo = 'M';
      }
      $query = $this->db->query("INSERT INTO alumnos (id_usuario, nombre, apellido, sexo, curp, edad, estatura, nombre_tutor, telefono, discapacidad, observacion) VALUES ('$this->id_usuario', '$this->nombre', '$this->apellido', '$this->sexo', '$this->curp', '$this->edad', '$this->estatura', '$this->nombre_tutor', '$this->telefono', '$this->discapacidad', '$this->observacion')"); 

    }
  }

  public function validarExistencia($curp) {
    $query = $this->db->query("SELECT * FROM alumnos WHERE curp = '$curp'");
  
    if($query->num_rows) {
      $filas = $query->fetch_assoc();
      return $filas;

    } else {
      return false;
    }
  }

  public function getAlumnos() {
    $this->id_usuario = $_SESSION['usuario']['id_usuario'];
    $query = $this->db->query("SELECT * FROM alumnos WHERE id_usuario = '$this->id_usuario' ORDER BY apellido ASC");

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

  public function validarActualizado() {
    $this->id_alumno = $_GET['id'];

    $this->id_usuario = $_SESSION['usuario']['id_usuario'];
    $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
    $this->apellido = mysqli_real_escape_string($this->db, $_POST['apellido']);

    if(isset($_POST['sexo'])){  // Si no se selecciona ningun sexo nada se envia por POST
      $this->sexo = mysqli_real_escape_string($this->db, $_POST['sexo']);
    } else {
      $this->sexo = '';
    }

    $this->curp = mysqli_real_escape_string($this->db, $_POST['curp']);
    $this->edad = mysqli_real_escape_string($this->db, $_POST['edad']);
    $this->estatura = mysqli_real_escape_string($this->db, $_POST['estatura']);

    $this->nombre_tutor = mysqli_real_escape_string($this->db, $_POST['nombre_tutor']);
    $this->telefono = mysqli_real_escape_string($this->db, $_POST['telefono']);
    $this->discapacidad = mysqli_real_escape_string($this->db, $_POST['discapacidad']);
    $this->observacion = mysqli_real_escape_string($this->db, $_POST['observacion']);

    $estado = mysqli_real_escape_string($this->db, $_POST['estado']);
    $municipio = mysqli_real_escape_string($this->db, $_POST['municipio']);
    $calle = mysqli_real_escape_string($this->db, $_POST['calle']);
    $numero = mysqli_real_escape_string($this->db, $_POST['numero']);
    $colonia = mysqli_real_escape_string($this->db, $_POST['colonia']);
    $cp = mysqli_real_escape_string($this->db, $_POST['cp']);

    $error = '';

    if(empty($this->nombre) || is_numeric($this->nombre)) {
      $error .= '1';  // El nombre es requerido
    }
    if(empty($this->apellido) || is_numeric($this->apellido)) {
      $error .= '2';  // El apellido es requerido
    }
    if(empty($this->sexo)) {
      $error .= '3';  // El sexo es requerido
    }
    if(empty($this->curp) || strlen($this->curp) != 18) {
      $error .= '4';  // La CURP es requerida
    }
    if(empty($this->edad)) {
      $error .= '5';  // La edad es requerida
    }
    if(empty($this->estatura)) {
      $error .= '6';  // La estatura es requerida
    }
    if(empty($this->nombre_tutor) || is_numeric($this->nombre_tutor)) {
      $error .= '7';  // El nombre del tutor es requerido
    }
    if(empty($this->telefono) || strlen($this->telefono) != 10) {
      $error .= '8';  // El teléfono es requerido
    }
    
    if(empty($estado) || is_numeric($estado)) {
      $error .= 'a';  // El estado es requerido
    }
    if(empty($municipio) || is_numeric($municipio)) {
      $error .= 'b';  // El municipio es requerido
    }
    if(empty($calle) || is_numeric($colonia)){
      $error .= 'c';  // La calle es requerida
    }
    if(empty($numero)) {
      $error .= 'd';  // El numero es requerido
    }
    if(empty($colonia) || is_numeric($colonia)){
      $error .= 'e';  // La colonia es requerida
    }
    if(empty($cp)) {
      $error .= 'f';  // El codigo postal es requerido
    }

    if ($error == '') {
      $this->actualizarAlumno();
      return true;
    } else {
      header("Location: index.php?c=alumno&a=editar&id=$this->id_alumno&e=$error");
      return false;
    }
  }

  public function actualizarAlumno() {
    $this->id_alumno = $_GET['id'];

    if($this->sexo == 'Masculino') {
      $this->sexo = 'H';
    } else {
      $this->sexo = 'M';
    }
    $query = $this->db->query("UPDATE alumnos SET nombre = '$this->nombre', apellido = '$this->apellido', sexo = '$this->sexo', curp = '$this->curp', edad = '$this->edad', estatura = '$this->estatura', nombre_tutor = '$this->nombre_tutor', telefono = '$this->telefono', discapacidad = '$this->discapacidad', observacion = '$this->observacion' WHERE id_alumno = '$this->id_alumno'");
  }

  public function eliminarAlumno() {
    $this->id_alumno = $_GET['id'];
    $query = $this->db->query("SET FOREIGN_KEY_CHECKS=0");
    $query = $this->db->query("DELETE FROM alumnos WHERE id_alumno = '$this->id_alumno'");
  }
}

?>