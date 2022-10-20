<?php

require('models/M_usuarios.php');

$usuarios = new Usuarios();
$datos = $usuarios->getUsuarios();

require('views/V_verUsuarios.php');

?>