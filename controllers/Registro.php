<?php

class RegistroController {

  public function __construct() {
    require_once 'models/M_usuario.php';
  }
  
  public function index() {
    require_once 'views/inicio/V_registro.php';
  }

  public function privacidad(){
    require_once 'views/inicio/V_privacidad.php';
  }

  public function terminos(){
    require_once 'views/inicio/V_terminos.php';
  }

  public function validar() {

    if(isset($_POST)){
      $usuario = new UsuariosModel();
      $auth = autenticado();
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $correo = $_POST['correo'];
      $password = $_POST['password'];

      $error = '';
      
      if(empty($nombre) || is_numeric($nombre)){
        $error = '1'; // "El nombre no es válido";
      }
      if(empty($apellido) || is_numeric($apellido)){
        $error .= '2'; // "El apellido no es válido";
      }
      if(empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL) ){
        $error .= '3'; // "El correo no es válido";
      }
      if($auth){
        if($usuario->validarCorreo && $correo != $_SESSION['usuario']['correo']){
          $error .= '4'; // "El correo ya está registrado";
        }
      } else{
        if($usuario->validarCorreo()){
          $error .= '4'; // "El correo ya existe";
        } 
      }
      
      if(empty($password)){
        $error .= '5'; // "La contraseña está vacía";
      }
    
      if($error == ''){
        if(isset($_GET['f'])){
          $usuario->actualizarUsuario();
          header('Location: index.php?c=panel&e=0');

        }else{
          $usuario->insertarUsuario();
          header("Location: index.php?c=login&e=0");
        }
            
      } else {
        if(isset($_GET['f'])){
          header("Location: index.php?c=ajustes&e=$error");
        }else{
          header("Location: index.php?c=registro&e=$error");
        }
        
      }
    }
  }
}

?>