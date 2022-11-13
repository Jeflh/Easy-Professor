<?php

require_once "config/config.php";
require_once "core/routes.php";
require_once "core/funciones.php";
require_once "config/db.php";
require_once "controllers/Inicio.php";

if (isset($_GET['c'])) {

	$controlador = cargarControlador($_GET['c']);

	if (isset($_GET['a'])) {
		if (isset($_GET['id'])) {
			cargarAccion($controlador, $_GET['a'], $_GET['id']);
		} else {
			cargarAccion($controlador, $_GET['a']);
		}
	} else {
			cargarAccion($controlador, MAIN_ACTION);
	}
} else {

	$controlador = cargarControlador(MAIN_CONTROLLER);
	$accionTmp = MAIN_ACTION;
	$controlador->$accionTmp();
}

?>