<?php
require('includes/head.php');
require('includes/noLoggedNav.php');

if (isset($_GET['e'])) {

  $status = $_GET['e'];
  $arrayValues = str_split($status);
  // Se convierte el string en un array para poder evaluar cada caso.

  for ($i = 0; $i < count($arrayValues); $i++) {
    switch ($arrayValues[$i]) { 
      // 0 = exitoso, 1 = nombre, 2 = apellido, 3 = correo, 4 = contraseña
      case 0:
        echo '<div class="text-center alert alert-dismissible alert-success mt-1">
    <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
    <strong>Registro exitoso </strong> ya puedes iniciar sesión.
    </div>';
        break;
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
    <strong>Contraseña no válida </strong> no puedes dejar la contraseña vacía.
    </div>';
        break;
    }
  }
}
?>

<div class="container d-flex justify-content-center">
  <form data-bitwarden-watching="1" action="index.php?c=registro&a=validar" method="POST">
    <fieldset>
      <legend class="mt-2 text-center">Registro</legend>
      <div class="form-group">
        <label for="apellido" class="form-label mt-2">Nombre</label>
        <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="nameHelp" placeholder="Ej. Emmanuel" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="apellido" class="form-label mt-2">Apellido</label>
        <input name="apellido" type="text" class="form-control" id="apellido" aria-describedby="nameHelp" placeholder="Ej. Fernández" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="correo" class="form-label mt-2">Dirección de correo</label>
        <input name="correo" type="email" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="correo@ejemplo.com" autocomplete="off">
        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más</small>
      </div>
      <div class="form-group">
        <label for="password" class="form-label mt-2">Contraseña</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Escribe aquí tu contraseña" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="grado" class="form-label mt-4">Grado de tu grupo</label>
        <select class="form-select" id="grado" name="grado">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
        </select>
      </div>

      <div class="form-check form-switch mt-4">
        <input class="form-check-input" type="checkbox" id="novedades" checked="">
        <label class="form-check-label">Recibir las ultimas novedades.</label>
      </div>

      <fieldset class="form-group">
        <legend class="mt-3">Terminos y condiciones de uso</legend>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="privacidad" required>
          <label class="form-check-label" for="flexCheckDefault">
            Estoy de acuerdo con la <a href="">politica de privacidad</a>.
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="terminos" required>
          <label class="form-check-label" for="flexCheckDefault">
            Acepto los <a href="">terminos y condiciones de uso</a>.
          </label>
        </div>
      </fieldset>
      <button type="submit" class="btn btn-primary mt-2">Registrarse</button>
    </fieldset>
  </form>
</div>

<?php
require_once('includes/footer.php');
?>