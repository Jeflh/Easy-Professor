<?php

require('models/conexion.php');

$con = new Conexion();

$usuarios = $con->getUsuarios();

require('views/V_verUsuarios.php');

?>