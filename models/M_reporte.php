<?php

class ReporteModel{
  private $db;

  public $trabajos;
  public $tareas;
  public $examenes;
  public $inicio;
  public $fin;


  public function __construct(){
    $this->db = Conectar::conexion();
  }

}

?>