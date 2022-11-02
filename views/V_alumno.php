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
  <div class="container">

    <h1 class="text-primary text-center pb-2">Información de alumno</h1>

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

    <div class="d-flex justify-content-between">
      <a href="index.php?c=asistencia&f=<?php echo date('Y/m/d')?>" class="btn btn-info mt-3">Regresar</a>
      <a href="index.php?c=alumno&a=editar&id=<?php echo $info['id_alumno']?>" class="btn btn-warning mt-3">Editar información</a>
    </div>
  </div>
</main>

<?php
require_once('includes/footer.php');
?>