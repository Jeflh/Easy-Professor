<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');
date_default_timezone_set('America/Mexico_City');

$fecha =  date('Y-m-d');

if (isset($_GET['e'])) {

  $status = $_GET['e'];
  $arrayValues = str_split($status);
  // Se convierte el string en un array para poder evaluar cada caso.
  for ($i = 0; $i < count($arrayValues); $i++) {
    switch ($arrayValues[$i]) { // Se evalua cada caso y muestra la alerata correspondiente
      case "1":
        echo '<div class="text-center alert alert-dismissible alert-danger mt-1 mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Nombre vacío</strong>, por favor introduce un nombre para la actividad.
          </div>';
        break;
      case "2":
        echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Tipo de actividad vacío</strong>, por favor elige una opción.
          </div>';
        break;
      case "3":
        echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Fecha vacía</strong>, por favor elige una fecha.
          </div>';
        break;
      case "4":
        echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Descripción vacía</strong>, por favor escribe una descripción.
          </div>';
        break;
    }
  }
}
?>

<main>
  <div class="container d-flex justify-content-between">
    <div class="col">
      <a href="index.php?c=actividad&id=<?php echo $_GET['id']; ?>" class="btn btn-info mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
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

  <div class="container d-flex justify-content-center mb-3">
    <form data-bitwarden-watching="1" action="index.php?c=actividad&a=crear" method="POST">
      <fieldset>
        <legend class="mt-4 text-center text-primary">
          <h1><strong>Creando nueva actividad</strong></h1>
        </legend>
        <fieldset class="form-group">
          <legend>Detalles</legend>
          <input name="asignatura" type="hidden" class="form-control" id="asignatura" value="<?php echo $_GET['id']; ?>">
          <div class="form-group">
            <label for="nombre" class="form-label mt-2">Nombre de la actividad</label>
            <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ej. Actividad No. 0" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="tipo" class="form-label mt-3">Tipo de actividad</label>
            <select class="form-select" id="tipo" name="tipo" value=" ">
              <option disabled selected="selected">-Seleccionar-</option>
              <option>1. Trabajo</option>
              <option>2. Tarea</option>
              <option>3. Examen</option>
            </select>
          </div>

          <div class="form-group">
            <label for="fecha" class="form-label mt-3">Fecha de la actividad</label>
            <input name="fecha" type="date" class="form-control" id="fecha" value="<?php echo str_replace('/', '-', $fecha); ?>">

            <div class="form-group">
              <label for="descripcion" class="form-label mt-3">Descripcion</label>
              <textarea class="form-control" id="descripcion" name="descripcion" rows="3" data-dl-input-translation="true" placeholder="Ej. Requiere reforzar lectura"></textarea>
              <deepl-inline-translate style="z-index: 1999999999;"></deepl-inline-translate>
            </div>

        </fieldset>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary mt-3">Crear actividad</button>
        </div>
      </fieldset>
    </form>
  </div>

</main>

<?php
require_once('includes/footer.php');
?>