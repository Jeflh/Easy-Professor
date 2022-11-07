<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');
/*
  Se rescata la información que el controlador envía a la vista
  y se separa el arreglo en dos variables para hacer más comoda
  la manipulación de los datos.
*/
$info = $datosAlumno[0];
$domicilio = $datosAlumno[1][0];

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
    <h1 class="text-primary text-center pb-2"><strong>Información de alumno</strong></h1>

    <div class="container d-flex justify-content-evenly border border-3 border-primary">
      <div class="pt-3">
        <p><strong>Nombre: </strong><?php echo $info['nombre'] . ' ' . $info['apellido'] ?></p>

        <p><strong>Sexo: </strong> <?php echo $sexo = ($info['sexo'] == 'H') ? 'Masculino' : 'Femenino' ?></p>

        <p><strong>CURP: </strong><?php echo $info['curp'] ?></p>

        <p><strong>Edad: </strong><?php echo $info['edad'] . ' años' ?></p>

        <p><strong>Estatura: </strong><?php echo $info['estatura'].'mts' ?></p>

        <p><strong>Nombre del tutor: </strong><?php echo $info['nombre_tutor'] ?></p>

        <p><strong>Teléfono: </strong><?php echo $info['telefono'] ?></p>

        <p><strong>Discapacidad: </strong><?php echo $info['discapacidad'] ?></p>

        <p><strong>Observación: </strong><?php echo $info['observacion'] ?></p>
      </div>

      <div class="pt-3">
        <p><strong>Calle: </strong><?php echo $domicilio['calle'] ?></p>

        <p><strong>Número: </strong><?php echo $domicilio['numero'] ?></p>

        <p><strong>Colonia: </strong><?php echo $domicilio['colonia'] ?></p>

        <p><strong>Código postal: </strong><?php echo $domicilio['cp'] ?></p>

        <p><strong>Municipio: </strong><?php echo $domicilio['municipio'] ?></p>

        <p><strong>Estado: </strong><?php echo $domicilio['estado'] ?></p>
      </div>

    </div>

    <div class="d-flex justify-content-between mb-3">
      <a href="index.php?c=alumno&a=eliminar&id=<?php echo $info['id_alumno']?>" class="btn btn-danger mt-3">Eliminar alumno</a> 
      <a href="index.php?c=alumno&a=editar&id=<?php echo $info['id_alumno']?>" class="btn btn-warning mt-3">Editar alumno</a>
    </div>
  </div>
</main>

<?php
require_once('includes/footer.php');
?>