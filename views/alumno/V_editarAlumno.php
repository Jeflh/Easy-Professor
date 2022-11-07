<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');

$info = $datosAlumno[0];
$domicilio = $datosAlumno[1][0];
?>

<main>
  <div class="container d-flex justify-content-between">
    <div class="col">
      <a href="index.php?c=alumno&a=ver&id=<?php echo $info['id_alumno'];?>" class="btn btn-info mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
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

  <?php 
  if (isset($_GET['e'])) {

    $status = $_GET['e'];
    $arrayValues = str_split($status);
    // Se convierte el string en un array para poder evaluar cada caso.
  
    for ($i = 0; $i < count($arrayValues); $i++) {
      switch ($arrayValues[$i]) { // Se evalua cada caso y muestra la alerata correspondiente
        case 0:
          echo '<div class="text-center alert alert-dismissible alert-success mt-1 mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Alumno actualizado </strong>, el alumno se ha actualizado correctamente.
          </div>';
          break;
        case 1:
          echo '<div class="text-center alert alert-dismissible alert-danger mt-1 mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Nombre no válido </strong>, por favor introduce un nombre válido.
          </div>';
          break;
        case 2:
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Apellido no válido </strong>, por favor introduce un apellido válido.
          </div>';
          break;
        case 3:
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Sexo no válido </strong>, por favor elige un sexo válido.
          </div>';
          break;
        case 4:
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>CURP no válida </strong>, por favor introduce una CURP válida.
          </div>';
          break;
        case 5:
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Edad no válida </strong>, la edad es requerida.
          </div>';
          break;
        case 6:
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Estatura no válida</strong>, la estatura es requerida.
          </div>';
          break;
        case 7:
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Nombre de tutor no válido</strong>, por favor introduce un nombre de tutor válido.
          </div>';
          break;
        case 8:
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Teléfono no válido </strong>, por favor introduce un teléfono válido.
          </div>';
          break;
        case 9:
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>CURP no válida </strong>, el alumno ya se encuentra registrado.
          </div>';
          break;
        case 'a':
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Estado no válido</strong>, por favor introduce un estado válido.
          </div>';
          break;
  
        case 'b':
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Municipio no válido </strong>, por favor introduce un municipio válido.
          </div>';
          break;
        case 'c':
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Calle no válida </strong>, por favor introduce una calle válida.
          </div>';
          break;
        case 'd':
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Número no válido </strong>, por favor introduce un número válido.
          </div>';
          break;
        case 'e':
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Colonia no válida </strong>, por favor introduce una colonia válida.
          </div>';
          break;
  
        case 'f':
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Código postal no válido</strong>, por favor introduce un código postal válido.
          </div>';
          break;
      }
    }
  }
  ?>

  <div class="container d-flex justify-content-center mb-3">
    <form data-bitwarden-watching="1" action="index.php?c=alumno&a=actualizar&id=<?php echo $info['id_alumno']?>" method="POST">
      <fieldset>
        <legend class="mt-4 text-center text-primary">
          <h1><strong>Editar informaicón de alumno</strong></h1>
        </legend>
        <fieldset class="form-group">
          <legend>Alumno</legend>
          <div class="form-group">
            <label for="nombre" class="form-label mt-1">Nombre(s)</label>
            <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ej. Emmanuel" autocomplete="off" value="<?php echo $info['nombre']?>">
          </div>
          <div class="form-group">
            <label for="apellido" class="form-label mt-1">Apellidos</label>
            <input name="apellido" type="text" class="form-control" id="apellido" placeholder="Ej. Fernández de Lara" autocomplete="off" value="<?php echo $info['apellido']?>">
          </div>
          <div class="form-group">
            <label for="sexo" class="form-label mt-1">Sexo</label>
            <select class="form-select" id="sexo" name="sexo">
              <option disabled>-Seleccionar-</option>
              <option <?php if($info['sexo'] == 'H') echo "selected='selected'"; ?> >Masculino</option>
              <option <?php if($info['sexo'] == 'M') echo "selected='selected'"; ?> >Femenino</option>
            </select>
          </div>
          <div class="form-group">
            <label for="curp" class="form-label mt-2">CURP</label>
            <input name="curp" type="text" class="form-control" id="curp" placeholder="Ej. FABM770222MMSJNR00" autocomplete="off" minlength="18" maxlength="18" value="<?php echo $info['curp']?>">
          </div>
          <div class="form-group">
            <label for="edad" class="form-label mt-2">Edad</label>
            <input name="edad" type="number" class="form-control" id="edad" placeholder="Ej. 9" min="5" max="12" value="<?php echo $info['edad']?>">
          </div>
          <div class="form-group">
            <label for="estatura" class="form-label mt-2">Estatura</label>
            <input name="estatura" type="number" class="form-control" id="estatura" placeholder="Ej. 1.25" min="1.00" max="1.70" step="0.01" value="<?php echo $info['estatura']?>">
          </div>
        </fieldset>

        <fieldset class="form-group">
          <legend class="mt-4">Domicilio</legend>
          <div class="form-group">
            <label for="calle" class="form-label mt-1">Calle</label>
            <input name="calle" type="text" class="form-control" id="calle" placeholder="Ej. Av. Lopez Mateos" autocomplete="off" value="<?php echo $domicilio['calle']?>">
          </div>
          <div class="form-group">
            <label for="numero" class="form-label mt-1">Número</label>
            <input name="numero" type="number" class="form-control" id="numero" placeholder="Ej. 1684" autocomplete="off" value="<?php echo $domicilio['numero']?>">
          </div>
          <div class="form-group">
            <label for="colonia" class="form-label mt-1">Colonia</label>
            <input name="colonia" type="text" class="form-control" id="colonia" placeholder="Ej. Plaza del Sol" autocomplete="off" value="<?php echo $domicilio['colonia']?>">
          </div>
          <div class="form-group">
            <label for="cp" class="form-label mt-1">Código postal</label>
            <input name="cp" type="number" class="form-control" id="cp" placeholder="Ej. 44780" value="<?php echo $domicilio['cp']?>">
          </div>
          <div class="form-group">
            <label for="municipio" class="form-label mt-1">Municipio</label>
            <input name="municipio" type="text" class="form-control" id="municipio" placeholder="Ej. Guadalajara" value="<?php echo $domicilio['municipio']?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="estado" class="form-label mt-1">Estado</label>
            <input name="estado" type="text" class="form-control" id="estado" placeholder="Ej. Jalisco" value="<?php echo $domicilio['estado']?>" autocomplete="off">
          </div>
        </fieldset>
        <fieldset class="form-group">
          <legend class="mt-4">Información complementaria</legend>
          <div class="form-group">
            <label for="nombre_tutor" class="form-label mt-1">Nombre del tutor</label>
            <input name="nombre_tutor" type="text" class="form-control" id="nombre_tutor" placeholder="Ej. Emmanuel Fernandez de Lara" autocomplete="off" value="<?php echo $info['nombre_tutor']?>">
          </div>
          <div class="form-group">
            <label for="telefono" class="form-label mt-2">Teléfono</label>
            <input name="telefono" type="number" class="form-control" id="telefono" placeholder="Ej. 321321321" maxlength="10" autocomplete="off" value="<?php echo $info['telefono']?>">
          </div>
          <div class="form-group">
            <label for="discapacidad" class="form-label mt-1">Discapacidad</label>
            <input name="discapacidad" type="text" class="form-control" id="discapacidad" placeholder="Ej. Discapacidad física" value="<?php echo $info['discapacidad']?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="observacion" class="form-label mt-4">Observacion</label>
            <textarea class="form-control" id="observacion" name="observacion" rows="3" data-dl-input-translation="true" placeholder="Ej. Requiere reforzar lectura"><?php echo $info['observacion']?></textarea>
            <deepl-inline-translate style="z-index: 1999999999;"></deepl-inline-translate>
          </div>
        </fieldset>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary mt-3">Actualizar información del alumno</button>
        </div>
      </fieldset>
    </form>
  </div>
</main>

<?php
require_once('includes/footer.php');
?>