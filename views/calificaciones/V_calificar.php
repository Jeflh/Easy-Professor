<?php 
  require_once('includes/head.php');
  require_once('includes/loggedNav.php');

  $lista['alumno'] = $listaAlumnos['alumnos'];
  $lista['calificacion'] = $listaAlumnos['calificaciones'];
  
?>

<main>
  <div class="container d-flex justify-content-between">
    <div class="col">
      <a href="index.php?c=actividad&id=<?php echo $datos['actividad']['id_asignatura']; ?>"  class="btn btn-info mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
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
  <h1 class="text-primary text-center"><strong>Calificaciones</strong></h1>
  <h3 class="text-primary text-center"> <?php echo $datos['actividad']['nombre_act']; ?> </h3>
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
          foreach ($lista['alumno'] as $alumno) { ?>
            <tr class="table-light">
              <th class="text-center" scope="row">
                <?php echo '<a href="index.php?c=alumno&a=ver&id=' . $alumno['id_alumno'] . '">' . $i . '</a>' ?>
              </th>
              <td><?php echo $alumno['apellido']; ?></td>
              <td><?php echo $alumno['nombre']; ?></td>
            </tr>
          <?php $i++;
          } ?>
        </tbody>
      </table>
    </div>

    <div class="col-2">
      <form data-bitwarden-watching="1" action="index.php?c=calificar&a=guardar" method="POST">
        <table class="table table-striped table-bordered table-hover table-primary">
          <thead>
            <tr class="text-center">
              <th class="col-2" scope="col"> Calificación</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($lista['alumno'] as $alumno): ?>
              <tr class="table-light">
                <td class="text-center" style="padding: 1px 0;">
                  <div class="form-group p-0">
                  <select class="form-select text-center " name="<?php echo $alumno['id_alumno']; ?>" id="<?php echo $alumno['id_alumno'] ?>">
                  <?php if($lista['calificacion']): //Si hay calificaciones las recupera e imprime ?>
                    <?php foreach ($lista['calificacion'] as $calificacion): ?>
                      <?php if($calificacion['id_alumno'] == $alumno['id_alumno']): ?>
                        <option selected disabled>-Seleccionar-</option>
                        <option <?php if($calificacion['calificacion'] == 10) echo "selected"?> >10</option>
                        <option <?php if($calificacion['calificacion'] == 9) echo "selected"?> >9</option>
                        <option <?php if($calificacion['calificacion'] == 8) echo "selected"?> >8</option>
                        <option <?php if($calificacion['calificacion'] == 7) echo "selected"?> >7</option>
                        <option <?php if($calificacion['calificacion'] == 6) echo "selected"?> >6</option>
                        <option <?php if($calificacion['calificacion'] == 5) echo "selected"?> >5</option>
                        <option <?php if($calificacion['calificacion'] == 4) echo "selected"?> >4</option>
                        <option <?php if($calificacion['calificacion'] == 3) echo "selected"?> >3</option>
                        <option <?php if($calificacion['calificacion'] == 2) echo "selected"?> >2</option>
                        <option <?php if($calificacion['calificacion'] == 1) echo "selected"?> >1</option>
                        <?php endif; ?>     
                    <?php endforeach; ?>
                  <?php else: //Si no hay calificaciones muestra el menú de opciones ?>
                    <option selected disabled>-Seleccionar-</option>
                    <option>10</option>
                    <option>9</option>
                    <option>8</option>
                    <option>7</option>
                    <option>6</option>
                    <option>5</option>
                    <option>4</option>
                    <option>3</option>
                    <option>2</option>
                    <option>1</option>
                  <?php endif; ?>
                  </select>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="d-grid col">
          <input type="hidden" id="actividad" name="actividad" value="<?php echo $datos['actividad']['id_actividad'];?>">
          <input type="hidden" id="fecha" name="fecha" value="<?php echo date('Y/m/d'); ?>">
          <button type="submit" class="btn btn-success mb-2">Guardar calificaciones</button>
        </div>
      </form>
    </div>
  </div>
</main>

<?php 
  require_once('includes/footer.php');
?>