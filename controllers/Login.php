<?php


class LoginController{
  public function __construct() {
    require_once 'models/M_usuario.php';
  }
  
  public function index() {
    require_once 'views/V_login.php';
  }

  public function validar(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $correo = $_POST['correo'];
      $password = $_POST['password'];

      $error = '0';

      if(empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
        $error = '1'; // "El correo no es válido";
      }
      if(empty($password)){
        $error .= '2'; // "La contraseña está vacía";
      }

      if($error == '0'){

        $consulta = new UsuariosModel();
        $consulta->consultarUsuario($correo, $password); 
        // Consulta el usuario en la base de datos
        
        $usuario = $consulta->getUsuario();
        
        if(isset($usuario['password'])){
          $auth = password_verify($password, $usuario['password']); // Verifica la contraseña
        }

        if($auth){

          // Iniciar sesion
          session_start();
          $_SESSION['usuario'] = $usuario; // Guardar datos del usuario en la sesión
          $_SESSION['login'] = true;

          echo "true";
          header('Location: index.php?c=panel');

        } else {
          $error = '3'; // "El correo o la contraseña son incorrectos";
          header("Location: index.php?c=login&e=$error");
        }

      } else {
        header("Location: index.php?c=login&e=$error");
      }  
    }
  }

  public function cerrar(){  // Función para cerrar sesión
    session_start();

    $_SESSION = [];

    echo "Sesion cerrada";

    header('Location: index.php');
  }
}
