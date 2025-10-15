<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css">

  <title>Helado YA</title>
</head>

<body>
  <div class="container">
    <div>
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../img/piamonte.jpg" class="d-block w-100 carrusel" alt="Foto 1">
          </div>
          <div class="carousel-item">
            <img src="../img/piamonte1.jpg" class="d-block w-100 carrusel" alt="Foto 2">
          </div>
          <div class="carousel-item">
            <img src="../img/piamonte2.jpg" class="d-block w-100 carrusel" alt="Foto 3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <a href="registro.php"><button class="boton-izquierda">Registrarse</button></a>
    <div class="formulario">
      <form method="POST">
        <label for="mail">Correo Electrónico</label>
        <input type="email" id="mail" name="mail" placeholder="Correo">
        <label for="contra">Contraseña</label>
        <input type="password" id="contra" name="contra" placeholder="Contraseña">
        <p class="texto-azul">¿Olvidaste tu contraseña?</p>
        <a href="pedido.php "> <button class="boton-derecha" type="submit" name="iniciar">Iniciar Sesión</button> </a>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>