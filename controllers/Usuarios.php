<?php

require('models/M_usuarios.php');

$usuarios = new Usuarios();
$datos = $usuarios->getUsuario();

require('views/V_verUsuarios.php');

?>