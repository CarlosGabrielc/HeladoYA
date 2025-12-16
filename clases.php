<?php

require "conexion.php";
//Uso variables de sesion para mantener el usuario
session_start();

class Persona{
    //Declaro todas las variables que valla a usar
    private $nombre,$apellido,$mail,$direccion;
    //Constructor con los datos principales, el mail solo era necesario para iniciar sesion
    public function __construct($nom,$ape,$direc){
        $this->nombre=$nom;
        $this->apellido=$ape;
        $this->direccion=$direc;
    }
    //Un setter de direccion por si al hacer un pedido se quiere cambiar la direccion de entrega
    public function setDireccion($dire){
        $this->direccion=$dire;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    //Recuerden que STATIC se refiere a que se puede usar sin necesidad de tener un objeto creado
    //Como en este caso, la funcion se va a ejecutar para luego crear un objeto sin necesidad de tener uno anterior
    public static function iniciarSesion($mail,$contra){
        $con = conectar();
        $sql = "select * from usuarios where email = '".$mail."'";
        $resultado = mysqli_query($con,$sql);
        //Se puede cambiar esto a === 1, porque al ser unico el usuario un solo registro deberia estar afectado
        if(mysqli_affected_rows($con)>0){
            //uso fetch assoc para convertir los datos en un array asociativo
            $result = mysqli_fetch_assoc($resultado);
            //Comparo la contra
            // == quiere decir igual y === es estrictamente igual
            if ($contra===$result['contra']) {
                //Recien aca se crea el objeto y se guarda en una variable de sesion
                $_SESSION['usuario']= new Persona($result['nombre'],$result['apellido'],$result['direccion']);
                //aca lo guardo en una variable antes de devolverlo para evitar un error
                return true;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }
    //Esta funcion sirve para recuperar al usuario en las otras paginas
    //En vez de estar iniciando sesion en cada pagina se me ocurrio hacer esto
    //Es mucho mas practico
    public static function getUsuario(){
        //primero se fija si es que hay datos cargados en la variable de sesion
        if(isset($_SESSION['usuario'])){
            //y despues hace lo mismo que mas arriba
            $usuario = $_SESSION['usuario'];
            return $usuario;
        }
        else {
            return null;
        }
    }
    //solo se debe llamar y automaticamente cierra la sesion y te lleva al index
    //Devuelta es estatica por que no es necesario el objeto
    public static function cerrarSesion(){
        session_unset();
        session_destroy();
        exit;
    }

    public static function altaUsuario($n,$a,$d,$m,$c){
        try {
        $con = conectar();
        $sql = "INSERT INTO usuarios VALUES (default,'$n','$a','$c','$m','$d');";
        mysqli_query($con,$sql);
        if(mysqli_affected_rows($con)>0){
            return "registro exitoso <a href='index.php'><button>Volver a inicio</button></a>";
        }
        else{
            return "Error en la base de datos";
        }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

?>