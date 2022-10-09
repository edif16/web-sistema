<?php 

session_start();

require 'conexion/db.php';

if(!empty($_POST['correo']) && !empty($_POST['password'])){
  $records = $conn->prepare(('SELECT id, correo, password FROM usuario WHERE correo = correo'));
  $records->bindParam(':correo', $_POST['correo']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
    
    $_SESSION['user_id'] = $results['id'];
    header("Location: /Inicio_copy.php");

  } else {
    $message = 'Datos de usuario incorrectos';
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>

  

  <?php if(!empty($message)) : ?>
    <p><?= $message ?></p>
  <?php endif; ?>

    <div class="login-box">
      <img src="img/Logo.jpg" class="avatar" alt="Avatar Image"> <!--imagen pendiente -->
      <h1>Ingreso a Sistema</h1>
      <form action="index_copy.php" method="POST">
        <label for="correo">Correo</label>
        <input name="correo" type="text" placeholder="Ingrese el Correo">
        <label for="password">Contraseña</label>
        <input name="password" type="password" placeholder="Ibgrese Contraseña">
        <input type="submit" value="Iniciar Sesion">
        <a href="contraseña.html">¿Ha olvidado su contraseña?</a><br>
        <a href="registro.html">¿Aun no se ha registradot?</a>
      </form>
    </div>
  </body>
</html>