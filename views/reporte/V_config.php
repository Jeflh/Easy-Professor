<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');

?>

<main>

  <div class="container d-flex justify-content-between">
    <div class="col">
      <a href="index.php?c=panel" class="btn btn-info mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
        </svg></a>
    </div>
    <div class="col">
      <p class="text-primary text-end me-3 mb-0 lead">
        <?php echo $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'] ?>
      </p>

      <p class="text-info text-end me-3 mb-0 lead">
        <?php date_default_timezone_set('America/Mexico_City');
        echo date("d/m/Y") ?>
      </p>
    </div>
  </div>

  <?php
  if (isset($_GET['e'])) {

    $status = $_GET['e'];
    $arrayValues = str_split($status);
    // Se convierte el string en un array para poder evaluar cada caso.
    for ($i = 0; $i < count($arrayValues); $i++) {
      switch ($arrayValues[$i]) { // Se evalua cada caso y muestra la alerata correspondiente
        case "1":
          echo '<div class="text-center alert alert-dismissible alert-danger mt-1 mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Faltan datos</strong>, por favor rellena todos los campos.
          </div>';
          break;
        case "2":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Entrada no válida </strong>, por favor introduce sólo numeros.
          </div>';
          break;
        case "3":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Error en el total</strong>, la suma de todos los campos debe ser igual a 100.
          </div>';
          break;
        case "4":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Fecha no válida</strong>, por favor introduce una fecha válida.
          </div>';
          break;
      }
    }
  }
  ?>
  <h1 class="text-primary text-center"><strong>Configuración de reporte</strong></h1>
  <h5 class="text-primary text-center">Establece la ponderación para cada tipo de actividad.</h5>

  <div class="container  d-flex justify-content-center mb-3">
    <form data-bitwarden-watching="1" action="index.php?c=reporte&a=config" method="POST">
      <div class="form-group">
        <label for="trabajos" class="form-label mt-1">% Trabajos</label>
        <input name="trabajos" type="number" class="form-control" id="trabajos" placeholder="Ej. 50" min="0" max="100" value="50">
      </div>
      <div class="form-group">
        <label for="tareas" class="form-label mt-1">% Tareas</label>
        <input name="tareas" type="number" class="form-control" id="tareas" placeholder="Ej. 30" min="0" max="100" value="30">
      </div>
      <div class="form-group">
        <label for="examenes" class="form-label mt-1">% Examenes</label>
        <input name="examenes" type="number" class="form-control" id="examenes" placeholder="Ej. 20" min="0" max="100" value="20">
      </div>
      <div class="row justify-content-center mt-2">
        <div class="col-sm-6">
          <label for="startDate">Fecha de inicio</label>
          <input id="inicio" name="inicio" class="form-control" type="date">
        </div>
        <div class="col-sm-6">
          <label for="endDate">Fecha de fin</label>
          <input id="fin" name="fin" class="form-control" type="date" value="<?php echo str_replace('/', '-', date('Y/m/d')); ?>">
        </div>
      </div>
      <div class="d-flex justify-content-center mt-3">
        <button type="submit" class="btn btn-primary">Continuar</button>
      </div>
  </div>
</main>

<?php
require_once('includes/footer.php');
?>