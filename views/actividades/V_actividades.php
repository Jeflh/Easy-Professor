<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');
if (isset($_GET['e'])) {

  $status = $_GET['e'];
  $arrayValues = str_split($status);
  // Se convierte el string en un array para poder evaluar cada caso.
  for ($i = 0; $i < count($arrayValues); $i++) {
    switch ($arrayValues[$i]) { // Se evalua cada caso y muestra la alerata correspondiente
      case "0":
        echo '<div class="text-center alert alert-dismissible alert-success mt-1 mb-1">
        <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
        <strong>Actividad añadida </strong>, la actividad se ha registrado correctamente.
        </div>';
        break;
      case "1":
        echo '<div class="text-center alert alert-dismissible alert-success mt-1 mb-1">
        <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
        <strong>Actividad actualizada</strong>, la actividad se ha actualizado correctamente.
        </div>';
        break;
      case "2":
        echo '<div class="text-center alert alert-dismissible alert-success mb-1">
        <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
        <strong>Actividad eliminada</strong>, la actividad se ha eliminado correctamente.
        </div>';
        break;
    }
  }
}
?>

<main>

  <div class="container d-flex justify-content-between">
    <div class="col">
      <a href="index.php?c=asignaturas" class="btn btn-info mt-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
        </svg>
      </a>
    </div>
    <div>
      <a href="index.php?c=actividad&a=nueva&id=<?php echo $materia['materia']['id_asignatura'] ?>"><button type="button" class="btn btn-primary mt-2">Nueva actividad</button></a>
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

  <h1 class="text-primary text-center"><strong>Actividades de <?php echo $materia['materia']['nombre_asignatura']; ?></strong></h1>
  <div class="container d-flex flex-wrap justify-content-center">
    <?php 
      if($datos['actividades'] == null){
        echo '<h2 class="text-center text-primary">No hay actividades registradas</h2>';
      }else{
        foreach ($datos['actividades'] as $actividad) : ?>
          <div class=" card bg-light mt-2 mb-2 me-1 w-50">
            <div class="card-body">
              <a href="index.php?c=actividades&a=ver&id=<?php echo $actividad['id_actividad']; ?>">
                <h5 class="card-title mb-1"><?php echo $actividad['nombre_act'] ?></h5>
              </a>
              <span class=" card-subtitle badge bg-primary mb-2"> <?php  
                  if($actividad['tipo'] == 1){
                    echo 'Trabajo';
                  } else if ($actividad['tipo'] == 2){
                    echo 'Tarea';
                  } else if ($actividad['tipo'] == 3){
                    echo 'Examen';
                  }
              ?></span>
              <span class="badge bg-dark card-subtitle mb-2">
                <?php echo $actividad['fecha_actividad']; ?>
              </span>
              
              <p class="card-text mb-0"><?php echo $actividad['descripcion'] ?></p>
              <div class="d-flex justify-content-between ">
                <a href="index.php?c=actividad&a=editar&id=<?php echo $materia['materia']['id_asignatura'] . '&f=' . $actividad['id_actividad']?>" class="btn btn-warning mt-2">Editar</a>
                <a href="index.php?c=actividad&a=eliminar&id=<?php echo $materia['materia']['id_asignatura'] . '&f=' . $actividad['id_actividad']?>" class="btn btn-danger mt-2">Eliminar</a>
              </div>
            </div>
          </div>
        <?php endforeach; }?>
  </div>

</main>

<?php
require_once('includes/footer.php');
?>