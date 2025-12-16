<?php include "clases.php"; 
if(isset($_POST['iniciar'])){
    if(Persona::iniciarSesion($_POST['mail'],$_POST['contra'])){
        header("Location: pedidos.php");
        exit;
    }else{
        $error = "Email o contraseña incorrectos";
    }
}?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background: #f9f9f9;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  background-image: url(css/fondo-helados.jpg);
}

/* ----- HEADER CON CARRUSEL ----- */
.header-carousel {
  width: 100%;
  overflow: hidden;
  
}

.carousel-track {
  display: flex;
  width: calc(80%); /* Doble para permitir el bucle */
  animation: scroll 15s linear infinite;
}

.carousel-slide {
  display: flex;
}

.carousel-track img {
  height: 150px;
  width: auto;
  object-fit: cover;
  filter: brightness(0.9);
  border-radius: 3px;
}

/* Animación infinita, sin cortes ni fondo negro */
@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}
  </style>
  <title>Document</title>
</head>

<body>
  <header class="header-carousel">
    <div class="carousel-track">
      <div class="carousel-slide">
        <img src="img/piamonte.jpg" alt="Imagen 1">
        <img src="img/piamonte1.jpg" alt="Imagen 2">
        <img src="img/piamonte2.jpg" alt="Imagen 3">
        <img src="img/piamonte3.jpg" alt="Imagen 4">
        <img src="img/piamonte4.jpg" alt="Imagen 5">
      </div>
      <!-- Duplicado para efecto infinito -->
      <div class="carousel-slide">
        <img src="img/piamonte.jpg" alt="Imagen 1">
        <img src="img/piamonte1.jpg" alt="Imagen 2">
        <img src="img/piamonte2.jpg" alt="Imagen 3">
        <img src="img/piamonte3.jpg" alt="Imagen 4">
        <img src="img/piamonte4.jpg" alt="Imagen 5">
      </div>
    </div>
  </header>
  
  <div class="botones-container">
    <a href="registro.php"><button class="boton-izquierda">Registrarse</button></a>
  </div>

  <div class="container" style="margin-top: -6%;">
    <img src="img/HeladoYa.png" alt="logo" class="logo">
    <?php if(!empty($error)){
        ?>
          <div class="mensaje"><span class="cerrar">&times;</span><?=$error?></div>
          <div class="contenido-error">

          </div>
    <?php
    }?>
    <div class="formulario">
      <form method=POST>
        <label for="mail">Correo Electrónico</label>
        <input type="email" id="mail" name="mail" placeholder="Correo">
        <label for="contra">Contraseña</label>
        <input type="password" id="contra" name="contra" placeholder="Contraseña">
        <p class="texto-azul">¿Olvidaste tu contraseña?</p>
        <button class="boton-derecha" type="submit" name="iniciar">Iniciar Sesión</button>
      </form>
    </div>
  </div>

  <script>
    document.querySelector('.mensaje').classList.add('activo');
        document.querySelector('.cerrar').addEventListener('click',()=>{
            document.querySelector('.mensaje').classList.remove('activo');
        });
    const carrusel = document.querySelector('.imagenes-carrusel');
    const imagenes = document.querySelectorAll('.imagenes-carrusel img');
  
    let index = 0;
  
    function moverCarrusel() {
      index++;
      if (index >= imagenes.length) {
        index = 0;
      }
      carrusel.style.transform = `translateX(${-index * 100}%)`;
    }
  
    // Cambia la imagen cada 3 segundos
    setInterval(moverCarrusel, 3000);
  </script>

</body> 

</html>
