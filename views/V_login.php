<?php
require_once('includes/head.php');
require_once('includes/noLoggedNav.php');
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