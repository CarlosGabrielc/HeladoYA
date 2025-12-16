<?php
include "clases.php";
if(isset($_GET['volver'])){
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit;
}
$usuario = Persona::getUsuario();
if($usuario!=true){
    header("Location: index.php");
    exit;
}
// Map de tamaños a cantidad de gustos permitidos
$map = [
    '1/4' => 2,
    '1/2' => 3,
    '1'   => 4
];
if(!isset($_SESSION['pedidos'])){
    $_SESSION['pedidos'] = [];
}
if (isset($_POST['eliminar'])) {
    $i = intval($_POST['eliminar']);
    if (isset($_SESSION['pedidos'][$i])) {
        unset($_SESSION['pedidos'][$i]);
        $_SESSION['pedidos'] = array_values($_SESSION['pedidos']); // reindexar
    }
}

$message = '';
$errors = [];
$continuar = isset($_POST['finalizar']) ? false : true;

if (isset($_POST['peso'], $_POST['gustos'])) {
    $peso = $_POST['peso'] ?? '';
    $gustos = $_POST['gustos'] ?? [];
    $gustos = is_array($gustos) ? array_values($gustos) : [];

    if (!isset($map[$peso])) {
        $errors[] = 'Seleccione un peso válido.';
    } else {
        $allowed = $map[$peso];
        $count = count($gustos);
        if ($count !== $allowed) {
            $errors[] = "Debe elegir exactamente $allowed gusto(s) para el peso seleccionado. Elegidos: $count.";
        } else {
            // Resultado válido: procesar como necesites
            $pedido = ['peso' => $peso, 'gustos' => $gustos, 'precio' => ($peso === '1/4' ? 6000 : ($peso === '1/2' ? 8000 : 16000))];
            $_SESSION['pedidos'][] = $pedido;
            if(!$continuar){
              header("Location: resumen.php");
            }
            $message = 'Pedido agregado con éxito.';
        }
    }
}
if(!$continuar){
    if(empty($_SESSION['pedidos'])){
      $errors[] = "Debe seleccionar al menos 1 peso y gusto para finalizar!";
    }
    else{
      header("Location: resumen.php");
      exit;
    }
}
$carrito_count = isset($_SESSION['pedidos']) ? count($_SESSION['pedidos']) : 0;
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css">
<title>Pedido de helado</title>
<style>
    .pesos button {
    background: linear-gradient(180deg,#fff7f3 0%, #ffdfe5 50%, #ffc9d0 100%);
    border: 1px solid rgba(210,120,120,0.25);
    color: #6b2a2a;
    font-weight: 700;
    border-radius: 28px;
    padding: 10px 18px;
    box-shadow: 0 6px 12px rgba(255,182,193,0.18), inset 0 -3px 0 rgba(255,255,255,0.6);
    transition: transform .12s ease, box-shadow .12s ease, opacity .12s;
    cursor: pointer;
    margin-right: 8px;
    position: relative;
}

/* pequeño icono tipo bola de helado */
.pesos button::after {
    content: "🍨";
    margin-left: 8px;
    opacity: 0.9;
    filter: saturate(0.9);
}

/* Hover */
.pesos button:hover:not(:disabled) {
    transform: translateY(-3px);
    box-shadow: 0 10px 18px rgba(255,160,180,0.25);
}

/* Estado activo */
.pesos button.active {
    background: linear-gradient(180deg,#ffb7b2 0%, #ff7b7b 100%);
    color: #fff;
    border-color: rgba(200,60,60,0.45);
    box-shadow: 0 10px 22px rgba(255,110,120,0.28);
}
.pesos button.active::after { content: "🍧"; }

/* Submit con look de heladería */
#submitBtn {
    background-color: #2a2a9b;
    border: none;
    border-radius: 24px;
    padding: 10px 18px;
    font-weight: 800;
    color: white;
    box-shadow: 0 8px 18px rgba(200,140,60,0.18);
    transition: transform .12s ease, opacity .12s;
}

/* Disabled state claro */
#submitBtn:disabled {
    opacity: 0.6;
    transform: none;
    box-shadow: none;
    cursor: not-allowed;
}

/* Ajustes pequeños para coherencia visual */
.pesos button:disabled { opacity: 0.5; cursor: not-allowed; }
  .pesos button { margin:5px; padding:10px 15px; }
  .active { background:#4CAF50; color:#fff; }
  .gustos { margin-top:15px; }
  .msg { margin:10px 0; padding:10px; border-radius:4px; }
  .error { background:#fdd; border:1px solid #f99; }
  .ok { background:#dfd; border:1px solid #9f9; }
  .nota { color:#555; font-size:0.95em; margin-top:8px; }
  button:disabled{opacity:0.6}
</style>
</head>
<body>
  <div id="carrito-btn" onclick="toggleCarrito()">
    🛒 <?php echo $carrito_count; ?>
  </div>
  <div id="carrito-panel">
    <h3>Pedidos cargados</h3>

    <?php if ($carrito_count === 0): ?>
        <p>No hay pedidos cargados.</p>
    <?php else: ?>

        <?php foreach ($_SESSION['pedidos'] as $index => $p): ?>
            <div class="pedido-item">
                <strong><?php echo $p['peso']; ?>KG</strong><br>
                Gustos: <?php echo implode(', ', $p['gustos']); ?><br>
                Precio: $<?php echo $p['precio']; ?><br>

                <button class="eliminar-btn" name="eliminar" value="<?php echo $index; ?>" form="acciones">Eliminar</button>
                <form id="acciones" method="post"></form>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</div>

<div class="contenedorFormulario">

<h2>Pedido de Helado</h2>

<?php if ($errors): ?>
  <div class="msg error"><?= htmlspecialchars(implode(' ', $errors)) ?></div>
<?php elseif ($message): ?>
  <div class="msg ok"><?= $message ?></div>
<?php endif; ?>

<form method="post" id="pedidoForm" class="contenedor-form">
  <div>
    <h3>Selecciona el peso: </h3>
    <div class="pesos" id="pesos">
      <label for="peso1_4">$6000</label>
      <button id="peso1_4" type="button" data-peso="1/4">1/4 kg</button><br>
      <label for="peso1_2">$8000</label>
      <button id="peso1_2" type="button" data-peso="1/2">1/2 kg</button><br>
      <label for="peso1">$16000</label>
      <button id="peso1" type="button" data-peso="1">1 kg</button>
    </div>
  </div>

  <input type="hidden" name="peso" id="pesoInput" value="">
  
  <div class="formularioPedido">
    <h3>Elige tus gustos: </h3>

    <div class="gustos">
      <div id="gustosList">
        <?php
        $flavors = ['Vainilla','Chocotorta','Frutilla','Dulce de Leche','Limón','Granizado','Crema Americana','Nutella'];
        foreach ($flavors as $i => $f): ?>
          <div>
            <label>
              <input type="checkbox" name="gustos[]" value="<?= htmlspecialchars($f) ?>" class="gustoCheckbox"> <?= htmlspecialchars($f) ?>
            </label>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="nota" id="nota">Seleccione un peso primero.</div>
    </div>
  </div>

  <div style="margin-top:12px;">
    <button type="submit" id="submitBtn" disabled>Enviar pedido</button>
    <button type="submit" name="finalizar">Finalizar Pedido</button>
  </div>
</form>
<a href="?volver"><button>Volver a inicio</button></a>

</div> <!-- cierre del contenedorFormulario -->

<script>
// Mapeo consistente con el servidor
const map = { '1/4': 2, '1/2': 3, '1': 4 };

const pesoButtons = document.querySelectorAll('#pesos button');
const pesoInput = document.getElementById('pesoInput');
const checkboxes = Array.from(document.querySelectorAll('.gustoCheckbox'));
const nota = document.getElementById('nota');
const submitBtn = document.getElementById('submitBtn');

let allowed = 0;

function setActivePeso(btn) {
  pesoButtons.forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  const p = btn.getAttribute('data-peso');
  pesoInput.value = p;
  allowed = map[p] || 0;
  nota.textContent = `Puede elegir exactamente ${allowed} gusto(s).`;
  updateCheckboxes();
  updateSubmitState();
}

pesoButtons.forEach(btn => {
  btn.addEventListener('click', () => setActivePeso(btn));
});

function updateCheckboxes() {
  // Si ya hay más seleccionados que lo permitido, deseleccionar extras (últimos)
  const checked = checkboxes.filter(cb => cb.checked);
  if (allowed === 0) {
    checkboxes.forEach(cb => cb.disabled = false); // deshabilitará la validación pero nota pedirá elegir peso
    nota.textContent = 'Seleccione un peso primero.';
    // keep submit disabled
    return;
  }

  // Si se alcanzó el máximo, deshabilitar los no marcados
  if (checked.length >= allowed) {
    checkboxes.forEach(cb => {
      if (!cb.checked) cb.disabled = true;
    });
  } else {
    checkboxes.forEach(cb => cb.disabled = false);
  }

  // Si hay más seleccionados de lo permitido (por si cambió peso a menor), desmarcar excedentes (últimos marcados)
  if (checked.length > allowed) {
    const excess = checked.length - allowed;
    // desmarcar los últimos 'excess' botones (según orden)
    for (let i = checkboxes.length - 1; i >= 0 && excess > 0; i--) {
      const cb = checkboxes[i];
      if (cb.checked) {
        cb.checked = false;
        excess--;
      }
    }
  }
}

function updateSubmitState() {
  if (allowed === 0) {
    submitBtn.disabled = true;
    return;
  }
  const checkedCount = checkboxes.filter(cb => cb.checked).length;
  submitBtn.disabled = (checkedCount !== allowed);
}

// manejar cambios en gustos
checkboxes.forEach(cb => {
  cb.addEventListener('change', () => {
    updateCheckboxes();
    updateSubmitState();
  });
});

// Si hay valores en POST (por ejemplo al recargar con errores), restaurar selección
window.addEventListener('DOMContentLoaded', () => {
  // restaurar peso desde input si existe (útil cuando el servidor devuelve errores)
  if (pesoInput.value) {
    const btn = document.querySelector(`#pesos button[data-peso="${pesoInput.value}"]`);
    if (btn) setActivePeso(btn);
  }
  // restaurar checkboxes (ya lo hace el navegador al hacer POST, sólo actualizar estado)
  updateCheckboxes();
  updateSubmitState();
});
function toggleCarrito() {
    let panel = document.getElementById("carrito-panel");
    panel.style.display = (panel.style.display === "block") ? "none" : "block";
}
</script>
</body>

</html>
