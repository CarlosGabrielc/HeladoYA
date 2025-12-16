<?php
require "clases.php";
$usuario = Persona::getUsuario();
if($usuario!=true){
    header("Location: index.php");
    exit;
}
if(isset($_GET['volver'])){
  header("Location: pedidos.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resumen del Pedido - HELADO YA</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    /*estilo de la ventana emergente */
    .modal{
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
    }
    .modal-contenido{
      background: white;
      padding: 20px;
      border-radius: 8px;
      width: 350px;
    }
    .acciones{
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }
    .acciones button{
      padding: 8px 16px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }
    .acciones button:first-child{
      background: #ddd;
    }
    .acciones button:last-child{
      background: #4CAF50;
      color: white;
    }
  </style>
</head>

<body>

  <section class="resumen-container">
  <h1>Resumen de tu Pedido </h1>
   
    <form id="formCliente" class="form-resumen">
      <div id="detallePedido" class="detalle-pedido">
        <h2>Detalle del Pedido:</h2>
        <p>
          <?php
          $total = 0;
            foreach($_SESSION['pedidos'] as $index => $pedido) {
                echo "<strong>Pedido " . ($index + 1) . ":</strong><br>";
                echo "Peso: " . htmlspecialchars($pedido['peso']) . " kg<br>";
                echo "Gustos: " . htmlspecialchars(implode(', ', $pedido['gustos'])) . "<br>";
                $total += $pedido['precio'];
            }
            echo "<br><strong>Precio total:</strong> $" . number_format($total, 0, ',', '.');
            echo "<strong>Cliente:</strong> " . htmlspecialchars($usuario->getNombre()) ."<br>";
            echo "<strong>Dirección de entrega:</strong> <span id='direccionTexto'>" . htmlspecialchars($usuario->getDireccion()) . "</span><button type='button' onclick='abrirModal()'>Modificar</button><br>";
          ?>
        </p>
      </div>

      <button type="submit" id="pagarBtn" name="pagar" class="boton-pagar">Pagar Pedido</button>
    </form>
    <div id="modal" class="modal">
      <div class="modal-contenido">
        <h3>Cambiar direccion</h3>
        <label for="nuevaDireccion">Nueva direccion: </label>
        <input type="text" id="nuevaDireccion">
        <div class="acciones">
          <button onclick="cerrarModal()">Cancelar</button>
          <button onclick="guardarDireccion()">Guardar</button>
        </div>
      </div>
    </div>
    <a href="?volver"><button>Volver a pedidos</button></a>
  </section>

  <script>
    function abrirModal(){
      document.getElementById("modal").style.display= "flex";

      document.getElementById("nuevaDireccion").value= document.getElementById("direccionTexto").innerText;
    }
    function cerrarModal(){
      document.getElementById("modal").style.display = "none";
    }
    function guardarDireccion(){
      const nueva = document.getElementById("nuevaDireccion").value;
      document.getElementById("direccionTexto").innerText = nueva;

      cerrarModal();
    }
  </script>
</body>
</html>
<?php
if(isset($_GET['pagar'])){
  session_destroy();
  session_unset();
  echo "<script>alert('Pago realizado con exito. Gracias por su compra!'); window.location.href = 'index.php';</script>";
  exit;
}

?>