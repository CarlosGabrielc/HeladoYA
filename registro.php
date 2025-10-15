<?php
//Crear una base de datos escuela24 con una tabla alumno (matricula(ai),nombre,apellido,dni,fechaN).
//EN un archivos clases.php crear una clase alumno, sus atributos deben ser privados.
//El constructor debe recibir nombre y apellido.
//Debe tener un metodo de altas() que me permita cargar el alumno en la BD y me diga si lo cargo o no.
//En un archivo index.php crear un formulario que me permita cargar los datos de un alumno.
//Utilizar los metodos correspondientes

//Claramente use IA para estilo
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea</title>
    <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background-image: url(img/fondo-helados.jpg);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

    .form-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 450px;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #444;
    }

    .form-group input {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-group input:focus {
      border-color: #5b86e5;
      box-shadow: 0 0 6px rgba(91,134,229,0.5);
      outline: none;
    }

    .form-container button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: linear-gradient(135deg, #36d1dc, #5b86e5);
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .form-container button:hover {
      background: linear-gradient(135deg, #2db8c1, #4668c4);
    }
    /* Fondo oscuro detrás del modal */
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  display: none; /* oculto por defecto */
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

/* Ventana emergente */
.mensaje-confirmacion {
  position: relative;
  max-width: 400px;
  width: 90%;
  background: linear-gradient(135deg, #36d1dc, #5b86e5);
  color: #fff;
  padding: 20px 30px;
  border-radius: 10px;
  font-weight: 600;
  text-align: center;
  box-shadow: 0 4px 20px rgba(0,0,0,0.3);
  animation: fadeIn 0.5s ease;
}

/* Botón de cierre (X) */
.mensaje-confirmacion .cerrar {
  position: absolute;
  top: 8px;
  right: 12px;
  font-size: 20px;
  font-weight: bold;
  color: #fff;
  cursor: pointer;
}


    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    </style>
</head>
<body>
  <div class="form-container">
    <h2>Crea una cuenta de helado YA</h2>
    <form method="POST">
      <div class="form-group">
        <label for="nombre">Nombre y Apellido:</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="apellido">Contraseña:</label>
        <input type="text" id="apellido" name="apellido" required>
      </div>

      <div class="form-group">
        <label for="dni">Repetir Contraseña:</label>
        <input type="number" id="dni" name="dni" max="99999999" min="1" required>
      </div>

      <div class="form-group">
        <label for="fechaN">Correo electronico:</label>
        <input type="mail" id="fechaN" name="fechaN" required>
      </div>

      <button type="submit" name="Cargar">Crear usuario</button>
    </form>
    <a href="index.php"><button>Volver a inicio</button></a>
  </div>
  <script>
document.addEventListener("DOMContentLoaded", () => {
  const overlay = document.getElementById("overlay");
  const cerrar = document.getElementById("cerrar");

  // Mostrar el modal solo si existe contenido dentro
  if (overlay && overlay.querySelector(".mensaje-confirmacion").innerText.trim() !== "") {
    overlay.style.display = "flex";
  }

  // Cerrar con la X
  cerrar.addEventListener("click", () => {
    overlay.style.display = "none";
  });

  // Cerrar al hacer clic fuera de la ventana
  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) {
      overlay.style.display = "none";
    }
  });
});
</script>

</body>
</html>
<?php
if(isset($_POST['Cargar'])){
    ?>
    <div class="overlay" id="overlay">
      <div class="mensaje-confirmacion">
        <span class="cerrar" id="cerrar">&times;</span>
    <?php
    require_once "clases.php";
    $alumno = new Alumno($_POST['matricula'],$_POST['nombre'],$_POST['apellido'],$_POST['dni'],$_POST['fechaN']);
    
    $alumno -> alta();
    
}
?>
</div>
</div>

