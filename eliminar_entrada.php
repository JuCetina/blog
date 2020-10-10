<?php

require_once 'includes/conexion.php';

if(isset($_SESSION['usuario']) && isset($_GET['id'])){
    $usuario = $_SESSION['usuario']['id'];
    $entrada = $_GET['id'];
    $sql = "DELETE from entradas WHERE usuario_id = $usuario AND id = $entrada";
    $eliminacion = mysqli_query($db, $sql);
    if($eliminacion){
        $_SESSION['eliminacion_entrada_completado'] = "La entrada se ha eliminado con éxito";
    }
    else{
        $_SESSION['errores']['eliminacion_entrada'] = "No se pudo eliminar la entrada";
    }
}

header('Location:index.php');