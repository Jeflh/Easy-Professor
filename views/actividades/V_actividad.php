<?php 
  require_once('includes/head.php');
  require_once('includes/loggedNav.php');
?>

<main>
  <div class="container d-flex justify-content-between">
    <div class="col">
      <a href="index.php?c=asistencia&f=<?php echo date('Y/m/d')?>" class="btn btn-info mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
        </svg></a>
    </div>
    <div class="col">
      <p class="text-primary text-end me-3 mb-0 lead">
        <?php echo $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'] ?>
      </p>

      <p class="text-info text-end me-3 mb-0 lead">
        <?php date_default_timezone_set('America/Mexico_City');
        echo date('d/m/Y'); ?>
      </p>
    </div>
  </div>

  <div class="container">
    <h1 class="text-primary text-center pb-2"><strong>Calificar </strong><?php echo $actividad['nombre_act']; ?></h1>

    <div class="container d-flex justify-content-evenly border border-3 border-primary">
      

    </div>

 
  </div>
</main>

<?php 
  require_once('includes/footer.php');
?>