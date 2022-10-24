<?php
require('includes/head.php');
require('includes/noLoggedNav.php');

?>

<div class="container d-flex justify-content-center">
  <form data-bitwarden-watching="1">
    <fieldset>
      <legend class="mt-2 text-center">Registro</legend>
      <div class="form-group">
        <label for="exampleInputName" class="form-label mt-2">Nombre</label>
        <input type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Ej. Juan Fernández" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1" class="form-label mt-2">Dirección de correo</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="correo@ejemplo.com" autocomplete="off">
        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="form-label mt-2">Contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Escribe aquí tu contraseña">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="form-label"></label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Vuelve a escribir tu contraseña">
      </div>

      <div class="form-group">
        <label for="exampleSelect1" class="form-label mt-4">Grado de tu grupo</label>
        <select class="form-select" id="exampleSelect1">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
        </select>
      </div>

      <div class="form-check form-switch mt-4">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">
        <label class="form-check-label" for="flexSwitchCheckDefault">Recibir las ultimas novedades.</label>
      </div>

      <fieldset class="form-group">
        <legend class="mt-3">Terminos y condiciones de uso</legend>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            Estoy de acuerdo con la <a href="">politica de privacidad</a>.
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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