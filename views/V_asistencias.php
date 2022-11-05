<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');

?>

<main>

  <div class="container d-flex justify-content-between">
    <div>
      <a href="index.php?c=alumno&a=index"><button type="button" class="btn btn-info mt-2">Añadir alumno</button></a>
    </div>
    <div class="col">
      <p class="text-primary text-end me-3 mb-0 lead">
        <?php echo $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'] ?>
      </p>

      <p class="text-info text-end me-3 mb-0 lead">
        <?php date_default_timezone_set('America/Mexico_City');
        echo date("d/m/Y", strtotime($fecha)); ?>
      </p>
    </div>
  </div>
  
  <?php 
    if (isset($_GET['e'])) {

      $status = $_GET['e'];
      
      if($status == '0'){
        echo '<div class="text-center alert alert-dismissible alert-success mt-1 mb-1">
        <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
        <strong>Asistencia guardada</strong>, la asistencia se ha actualizado correctamente.
        </div>';
      }
    }
  ?>
<h1 class="text-primary text-center"><strong>Lista de asistencia</strong></h1>
  <div class="container d-flex justify-content-center">
    <div class="col-5">
      <table class="table table-striped table-bordered table-hover table-primary">
        <thead>
          <tr class="text-center">
            <th class="col-1" scope="col">Nº</th>
            <th class="col-2" scope="col">Apellido</th>
            <th class="col-2" scope="col">Nombre</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;   // Se obtienen los datos de cada alumno, se imprime un link con su id.
          foreach ($lista['alumnos'] as $alumno) { ?>
            <tr class="table-light">
              <th class="text-center" scope="row">
                <?php echo '<a href="index.php?c=alumno&a=ver&id='.$alumno['id_alumno'].'">'.$i.'</a>'?>
              </th>
              <td><?php echo $alumno['apellido']; ?></td>
              <td><?php echo $alumno['nombre']; ?></td>
            </tr>
          <?php $i++;
          } ?>

        </tbody>
      </table>

      <div class="container d-flex justify-content-start">
    <form data-bitwarden-watching="1" action="index.php?c=asistencia&a=fecha" method="POST">
      <?php date_default_timezone_set('America/Mexico_City');?>
      <input class="mb-2" type="date" name="cambioFecha" id="cambioFecha" value="<?php echo str_replace('/', '-', $fecha); ?>">
      <button type="submit" class="btn btn-info mb-2">Cambiar fecha</button>
    </form>
  </div>
    </div>

    <div class="col-2">
      <form data-bitwarden-watching="1" action="index.php?c=asistencia&a=guardar" method="POST">
        <table class="table table-striped table-bordered table-hover table-primary">
          <thead>
            <tr class="text-center">
              <th class="col-2" scope="col"> Asistencia</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($lista['alumnos'] as $alumno) { ?>
              <tr class="table-light">
                <td class="text-center">
                  <div class="form-switch">
                    <input class="form-check-input w-100" type="checkbox" name="<?php echo $alumno['id_alumno']; ?>" id="<?php echo $alumno['id_alumno'] ?>" 
                        <?php 
                        /*Se recorre la lista de asistencia y se compara con el ID del alumno, cuando los ID coinciden se verifica el estdo de la asistencia, si este es 1 se marca como checked el input, lo que de forma visual nos da la barra encendida. */
                        foreach($lista['asistencias'] as $asistencia){
                            if($asistencia['id_alumno'] == $alumno['id_alumno']){
                              if($asistencia['asistencia'] == 1){
                               echo 'checked';
                              }
                            }
                        } ?> 
                    > <!-- Cierre de la etiqueta input -->
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        
        <div class="d-grid col">
          <input type="hidden" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
          <button type="submit" class="btn btn-success mb-2">Guardar asistencia</button>
        </div>
      </form>
    </div>
  </div>

  
  
</main>

<?php
require_once('includes/footer.php');
?>