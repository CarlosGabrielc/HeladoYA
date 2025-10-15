<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stilos.css">
  <title>Document</title>
</head>

<body>
  <div class="carrusel">
    <!-- pongan fotos siguiendo este formato -->
    <img src="../img/piamonte.jpg" alt="Foto 1">
    <img src="../img/piamonte1.jpg" alt="Foto 2">
    <img src="../img/piamonte2.jpg" alt="Foto 3">
    <img src="../img/piamonte3.jpg" alt="Foto 3">
    <img src="../img/piamonte4.jpg" alt="Foto 3">
    <img src="../img/piamonte5.jpg" alt="Foto 3">
  </div>


  <div class="botones-container">


    <a href="registro.php"><button class="boton-izquierda">registrarse</button></a>
    <a href="pedidos.php"><button class="boton-derecha" type="submit" name="iniciar">Iniciar Sesion</button></a>
  </div>

  <div class="container">

    <div class="formulario">
      <form method=POST>
        <label for="mail">Correo Electronico</label>
        <input type="email" id="mail" name="mail" placeholder="Correo">
        <label for="contra">Contraseña</label>
        <input type="password" id="contra" name="contra" placeholder="Contraseña">
        <p class="texto-azul">¿Olvidaste tu contraseña?</p>
      </form>
    </div>
  </div>
</body>

</html>
<?php
if (isset($_POST['iniciar'])) {
  echo "";
}
if (isset($_GET['registro'])) {
  header("location: registro.php");
}
?>