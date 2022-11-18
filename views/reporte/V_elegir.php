<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');
?>

<main>

  <div class="container d-flex justify-content-between">
    <div class="col">
      <a href="index.php?c=reporte" class="btn btn-info mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
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

  <h1 class="text-primary text-center"><strong>Reporte</strong></h1>
  <div class="container">
    <div class="d-flex justify-content-center">
      <div class="col card text-white bg-primary mt-5 mb-3 me-3" style="max-width: 20rem; text-align: center;">
        <div class="card-header ">
          <h4 class="">Individual</h4>
        </div>
        <div class="card-body ">
          <a href="index.php?c=reporte&a=individual<?php echo '&1=' . $reporte->trabajos . '&2=' . $reporte->tareas . '&3='. $reporte->examenes . '&4=' . $reporte->inicio . '&5=' . $reporte->fin ;?>" class="link-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
            </svg>
          </a>
        </div>
      </div>

      <div class="col card text-white bg-primary mt-5 mb-3 me-3" style="max-width: 20rem; text-align: center;">
        <div class="card-header ">
          <h4 class="">Grupal</h4>
        </div>
        <div class="card-body">
          <a href="index.php?c=reporte&a=grupal<?php echo '&1=' . $reporte->trabajos . '&2=' . $reporte->tareas . '&3='. $reporte->examenes . '&4=' . $reporte->inicio . '&5=' . $reporte->fin ;?>" class="link-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
              <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>

</main>

<?php
require_once('includes/footer.php');
?>