<?php
require_once('includes/head.php');
require_once('includes/loggedNav.php');
if (isset($_GET['e'])) {

  $status = $_GET['e'];
  $arrayValues = str_split($status);
  // Se convierte el string en un array para poder evaluar cada caso.

  for ($i = 0; $i < count($arrayValues); $i++) {
    switch ($arrayValues[$i]) { // Se evalua cada caso y muestra la alerata correspondiente
      case 1:
        echo '<div class="text-center alert alert-dismissible alert-danger mt-1 mb-1">
    <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
    <strong>Nombre no válido </strong> por favor introduce un nombre válido.
    </div>';
        break;
      case 2:
        echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
    <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
    <strong>Apellido no válido </strong> por favor introduce un apellido válido.
    </div>';
        break;
      case 3:
        echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
    <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
    <strong>Correo no válido </strong> por favor ingresa un correo electrónico válido.
    </div>';
        break;
      case 4:
        echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
      <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
      <strong>Correo no válido </strong> el correo ya se encuentra registrado.
      </div>';
        break;
      case 5:
        echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
    <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
    <strong>Contraseña no válida </strong> no puedes dejar la contraseña vacía.
    </div>';
        break;
    }
  }
}
?>

<main>
  <h1 class="text-primary text-center"><strong>Ajustes</strong></h1>

  <div class="container d-flex justify-content-center mb-3">
    <form data-bitwarden-watching="1" action="index.php?c=registro&a=validar&f=1" method="POST">
      <fieldset>
        <div class="form-group">
          <label for="apellido" class="form-label mt-2">Nombre</label>
          <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="nameHelp" placeholder="Ej. Emmanuel" autocomplete="off" value="<?php echo $_SESSION['usuario']['nombre'];?>">
        </div>
        <div class="form-group">
          <label for="apellido" class="form-label mt-2">Apellido</label>
          <input name="apellido" type="text" class="form-control" id="apellido" aria-describedby="nameHelp" placeholder="Ej. Fernández" autocomplete="off" value="<?php echo $_SESSION['usuario']['apellido'];?>">
        </div>
        <div class="form-group">
          <label for="correo" class="form-label mt-2">Dirección de correo</label>
          <input name="correo" type="email" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="correo@ejemplo.com" autocomplete="off" value="<?php echo $_SESSION['usuario']['correo'];?>">
        </div>
        <div class="form-group">
          <label for="password" class="form-label mt-2">Contraseña</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="Escribe aquí tu contraseña" autocomplete="off">
        </div>

        <div class="form-group">
          <label for="grado" class="form-label mt-4">Grado de tu grupo</label>
          <select class="form-select" id="grado" name="grado">
            <option <?php if($_SESSION['usuario']['grado'] == '1er grado') echo 'selected';?>>1er grado</option>
            <option <?php if($_SESSION['usuario']['grado'] == '2do grado') echo 'selected';?>>2do grado</option>
            <option <?php if($_SESSION['usuario']['grado'] == '3er grado') echo 'selected';?>>3er grado</option>
            <option <?php if($_SESSION['usuario']['grado'] == '4to grado') echo 'selected';?>>4to grado</option>
            <option <?php if($_SESSION['usuario']['grado'] == '5to grado') echo 'selected';?>>5to grado</option>
            <option <?php if($_SESSION['usuario']['grado'] == '6to grado<') echo 'selected';?>>6to grado</option>
          </select>
        </div>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary mt-3">Actualizar información</button>
        </div>
      </fieldset>
    </form>
  </div>
    
</main>

<?php
require_once('includes/footer.php');
?>