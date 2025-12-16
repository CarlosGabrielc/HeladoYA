<?php

function conectar(){

    $serv="localhost";
    $usr="root";
    $pss="";
    $bd="heladosya";

    return new Mysqli($serv,$usr,$pss,$bd);
}

?>