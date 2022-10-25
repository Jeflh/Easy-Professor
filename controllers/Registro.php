<?php

class RegistroController {

  public function __construct() {
    require_once 'models/M_usuario.php';
  }
  
  public function index() {
    require_once 'views/V_registro.php';
  }

  public function validar() {

    if(isset($_POST)){
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $correo = $_POST['correo'];
      $password = $_POST['password'];
      $grado = $_POST['grado'];

      $error = '0';
      
      if(empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/", $nombre)){
        $error = '1'; // "El nombre no es válido";
      }
      if(empty($apellido) || is_numeric($apellido) || preg_match("/[0-9]/", $apellido)){
        $error .= '2'; // "El apellido no es válido";
      }
      if(empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
        $error .= '3'; // "El correo no es válido";
      }
      if(empty($password)){
        $error .= '4'; // "La contraseña está vacía";
      }

      if($error == '0'){
        $usuario = new UsuariosModel();
        $usuario->insertarUsuario($nombre, $apellido, $correo, $password, $grado);
        header("Location: index.php?c=registro&e=0");
      } else {
        header("Location: index.php?c=registro&e=$error");
      }
    }
  }
}

?>