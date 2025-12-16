<?php
require "clases.php";
if(isset($_POST['Cargar'])){
    if($_POST['contra']===$_POST['repetircontra']){
        if(preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/",$_POST['nombre'])){
            if(preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/",$_POST['apellido'])){
                $error = Persona::altaUsuario($_POST['nombre'],$_POST['apellido'],$_POST['direccion'],$_POST['mail'],$_POST['contra']);
            }else{ $error = "apellido incorrecto";}
        }else{  $error = "Nombre incorrecto";}
    }else{ $error = "Error: La contraseña debe ser igual";}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="botones-container" style="justify-content:left; left:20px;">
            <a href="index.php"><button>Cancelar</button></a>
        </div>
        <?php if(!empty($error)){
            ?><div class="mensaje"><span class="cerrar">&times;</span><?=$error?></div><?php
        }?>
    <div class="formulario">
    <form method=POST>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" id="nombre" required>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" value="<?php echo isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : ''; ?>" id="apellido" required>
        <label for="mail">Correo Electronico:</label>
        <input type="email" name="mail" value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : ''; ?>" id="mail" required>
        <label for="dire">Direccion:</label>
        <input type="text" name="direccion" value="<?php echo isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : ''; ?>" id="dire" required>
        <label for="contra">Contraseña:</label>
        <input type="password" name="contra" id="contra" required>
        <label for="repetir">Repetir Contraseña:</label>
        <input type="password" name="repetircontra" id="repetir" required>
        <button type="submit" name="Cargar">Registrarse</button>
    </form>
    </div>
    </div>
    <script>
        document.querySelector('.mensaje').classList.add('activo');
        document.querySelector('.cerrar').addEventListener('click',()=>{
            document.querySelector('.mensaje').classList.remove('activo');
        });
    </script>
</body>
</html>
<?php

?>