<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');

?>

<main>

  <div class="container d-flex justify-content-between">
    <div class="col">
      <a href="index.php?c=reporte&a=elegir" class="btn btn-info mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
        </svg></a>
    </div>
    <div class="col">
      <p class="text-primary text-end me-3 mb-0 lead">
        <?php echo $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'] ?>
      </p>

      <p class="text-info text-end me-3 mb-0 lead">
        <?php date_default_timezone_set('America/Mexico_City');
        echo date("Y/m/d")?>
      </p>
    </div>
  </div>

  <h1 class="text-primary text-center"><strong>Lista de alumnos</strong></h1>
  <div class="container d-flex justify-content-center">
    <div class="col-6">
      <table class="table table-striped table-bordered table-hover table-primary">
        <thead>
          <tr class="text-center">
            <th class="col-1" scope="col">Nº</th>
            <th class="col-2" scope="col">Apellido</th>
            <th class="col-1" scope="col">Nombre</th>
            <th class="col-1" scope="col">Seleccionar</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;   // Se obtienen los datos de cada alumno, se imprime un link con su id.
          foreach ($lista['alumnos'] as $alumno) { ?>
            <tr class="table-light">
              <th class="text-center text-primary" scope="row"> <?php echo $i ?></th>
              <td><?php echo $alumno['apellido']; ?></td>
              <td><?php echo $alumno['nombre']; ?></td>
              <td class="text-center"><a class="text-info" href=""><strong>Generar</strong></a></td>
            </tr>
          <?php $i++;
          } ?>
        </tbody>
      </table>
    </div>
  </div>

</main>

<?php
require_once('includes/footer.php');
?>