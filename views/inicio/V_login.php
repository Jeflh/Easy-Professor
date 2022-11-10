<?php
require_once('includes/head.php');
require_once('includes/noLoggedNav.php');

if (isset($_GET['e'])) {

  $status = $_GET['e'];
  $arrayValues = str_split($status);
  // Se convierte el string en un array para poder evaluar cada caso.

  for ($i = 0; $i < count($arrayValues); $i++) {
    switch ($arrayValues[$i]) {
        // Se evalua cada caso y se muestra la alerta correspondiente
      case 0: 
        echo '<div class="text-center alert alert-dismissible alert-success mt-1 mb-1">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Registro exitoso</strong>,  ahora puedes iniciar sesión. 
        </div>';
        break;
      case 1:
        echo '<div class="text-center alert alert-dismissible alert-danger mt-1 mb-1">
    <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
    <strong>Correo eléctronico no válido</strong>, por favor introduce un correo válido.
    </div>';
        break;
      case 2:
        echo '<div class="text-center alert alert-dismissible alert-danger mt-1 mb-1">
    <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
    <strong>Contraseña vacía</strong>, por favor introduce una contraseña.
    </div>';
        break;
      case 3:
        echo '<div class="text-center alert alert-dismissible alert-danger mt-1 mb-1">
    <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
    <strong>Contraseña incorrecta</strong>, por favor verifica la contraseña.
    </div>';
        break;
    }
  }
}
?>

<main>

  <div class="container d-flex justify-content-center mb-3">
    <form data-bitwarden-watching="1" action="index.php?c=login&a=validar" method="POST">
      <fieldset>
        <legend class="mt-4 text-center text-primary">
          <h1><strong>Iniciar sesión</strong></h1>
        </legend>
        <div class="form-group">
          <label for="correo" class="form-label mt-4">Dirección de correo</label>
          <input name="correo" type="email" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="Escribe aquí correo electronico" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="password" class="form-label mt-3">Contraseña</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="Escribe aquí tu contraseña" autocomplete="off">
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary mt-4">Iniciar sesión</button>
        </div>

      </fieldset>
    </form>
  </div>

</main>

<?php
require_once('includes/footer.php');
?>
