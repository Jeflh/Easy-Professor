<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de usuarios</title>
</head>
<body>
    <table>

      <thead>
        <tr>
          <td>Nombre</td>
          <td>Apellido</td>
        </tr>
      </thead>
        <tbody>
          <?php foreach($usuarios as $usuario): ?>
            <tr>
              <td><?php echo $usuario['nombre']; ?></td>
              <td><?php echo $usuario['apellido']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>