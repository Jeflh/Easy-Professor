<?php 
  // if(!isset($_SESSION)){
  //   session_start();
  // }

  // $auth = $_SESSION['login'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Easy Professor</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

  <header class="header">
    <div class="contenedor contenido-header">
      <div class="barra">
        <a href="index.php">
          <img src="/build/img/logo.svg" alt="Logotopo Easy Professor">
        </a>

        <div class="mobile-menu">
          <img src="/build/img/barras.svg" alt="Icono menú responsive">
        </div>
        <div class="derecha">
          <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Icono dark mode">
          <nav class="navegacion">
            <a href="nosotros.php">Nosotros</a>
            <a href="anuncios.php">Anuncios</a>
            <a href="blog.php">Blog</a>
            <a href="contacto.php">Contacto</a>
          </nav>
        </div>
      </div> <!-- barra -->
    </div>
  </header>