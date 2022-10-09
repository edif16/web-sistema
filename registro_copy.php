<?php 

  require 'conexion/db.php'; //conexion a BD

  $message = ''; //Para mostrar mensaje de error en pantalla

  if(!empty($_POST['correo']) && !empty($_POST['password'])){ //enviando datos al servidos y validar que estos campos no esten vacios
    
    $sql = "INSERT INTO usuario (correo, password) VALUES (:correo, :password)"; //Ingresar datos dentro de la tabla
    $stmt = $conn->prepare($sql); //para ejecutar consulta de sql
    $stmt->bindParam(':correo', $_POST['correo']); //vinculacion de parametros
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //datos almacenados en una variable, adicional de cifrar la contraseña
    $stmt->bindParam(':password', $password);

    if($stmt->execute()){ //para validar que se este ejecutando correctamente

      $message = 'Usuario Registrado Exitosamente';

    } else {
      $message = 'Error, ha ocurrido un error, intente de nuevo';
    }

  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrarse</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
  </head>
  <body>

  <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif;?>


    <div class="login-box">
      <img src="img/Logo.jpg" class="avatar" alt="Avatar Image"> <!--imagen pendiente -->
      <h1>Registro</h1>
      <form action="registro_copy.php" method="POST">
        <label for="correo">Correo</label>
        <input name="correo" type="text" placeholder="Ingrese su Correo">
        <label for="password">Password</label>
        <input name="password" type="password" placeholder="Ingrese una Contraseña">
        <input name="confirm_password" type="password" placeholder="Repita su Contraseña">
        <input type="submit" value="Registrarse">
        <a href="registro_copy.php">¿Ya se ha registrado?</a>
      </form>
    </div>
  </body>
</html>