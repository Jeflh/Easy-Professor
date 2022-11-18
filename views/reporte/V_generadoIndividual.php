<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');

?>

<main>

  <div class="container d-flex justify-content-between">
    <div class="col">
      <a href="index.php?c=reporte&a=individual<?php echo '&1=' . $_GET['1'] . '&2=' . $_GET['2'] . '&3=' . $_GET['3'] . '&4=' . $_GET['4'] . '&5=' . $_GET['5']; ?>" class="btn btn-info mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
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

  <h1 class="text-primary text-center"><strong>Reporte individual</strong></h1>
  <h3 class="text-primary text-center"> <?php echo $alumno['info']['nombre'] . ' ' . $alumno['info']['apellido']; ?></h3>

  <div class="container col-6 mt-4">
    <div>
      <table class="table table-hover table-striped table-bordered ">
        <thead>
          <tr class="table-primary">
            <th scope="col">Materia</th>
            <th scope="col"><?php echo $p_trabajos * 100 . '%';?> Trabajos</th>
            <th scope="col"><?php echo $p_tareas * 100 . '%';?> Tareas</th>
            <th scope="col"><?php echo $p_examenes * 100 . '%';?> Examenes</th>
            <th scope="col">Promedio</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($final as $datos): ?>
            <tr class="table-light">
              <th scope="row"><?php echo $datos['nombre']?></th>
              <td><?php echo $datos['promedioTrabajos']?></td>
              <td><?php echo $datos['promedioTareas']?></td>
              <td><?php echo $datos['promedioExamenes']?></td>
              <td><?php echo $datos['calificacion']?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
      <div class="card text-white bg-primary mb-3" style="max-width: 10rem;">
        <div class="card-header text-center">Calificación</div>
        <div class="card-body">
          <h4 class="card-title text-center"><?php echo $promFinal; ?></h4>
        </div>
      </div>
    </div>

    <div class="mt-2">
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentajeAsistencia . '%'; ?>;"></div>
      </div>
      <h5 class="text-end mt-2">Porcentaje de asistencia <?php echo $porcentajeAsistencia . '%'; ?></h5>
      
      <h5 class="text-center mt-5">Del <strong><?php echo date("d/m/Y", strtotime($f_inicio));?></strong> al <strong><?php echo date("d/m/Y", strtotime($f_fin)); ?></strong></h5>
    </div>

  </div>

</main>

<?php
require_once('includes/footer.php');
?>