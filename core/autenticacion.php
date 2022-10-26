<?php
function autenticado() : bool {
  session_start();

  if(isset($_SESSION['login'])){
    $auth = $_SESSION['login'];

    if($auth){
      return true;
    }
  }
  return false;
}

?>