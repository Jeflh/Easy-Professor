<?php
require('config/db.php');

class Usuarios{
  private $db;
  private $usuarios;


  public function __construct(){
    $this->db = Conectar::conexion();
    $this->usuarios = array();
  }

  public function getUsuarios(){
    $query = $this->db->query("SELECT * FROM usuarios");

    while($filas = $query->fetch_assoc()){
      $this->usuarios[] = $filas;
    }

    return $this->usuarios;
  }
}

?>