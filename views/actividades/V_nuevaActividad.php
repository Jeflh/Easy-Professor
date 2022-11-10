<?php 
  require_once('includes/head.php');
  require_once('includes/loggedNav.php');

  $fecha =  date('Y-m-d');
?>

<main>

<div class="container d-flex justify-content-center mb-3">
    <form data-bitwarden-watching="1" action="index.php?c=actividad&a=crear" method="POST">
      <fieldset>
        <legend class="mt-4 text-center text-primary">
          <h1><strong>Creando nueva actividad</strong></h1>
        </legend>
        <fieldset class="form-group">
          <legend>Detalles</legend>
          <div class="form-group">
            <label for="nombre" class="form-label mt-2">Nombre de la actividad</label>
            <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ej. Actividad No. 0" autocomplete="off">
          </div>
          
          <div class="form-group">
            <label for="sexo" class="form-label mt-3">Tipo de actividad</label>
            <select class="form-select" id="sexo" name="sexo" value=" ">
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
            <label for="observacion" class="form-label mt-3">Observacion</label>
            <textarea class="form-control" id="observacion" name="observacion" rows="3" data-dl-input-translation="true" placeholder="Ej. Requiere reforzar lectura"></textarea>
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