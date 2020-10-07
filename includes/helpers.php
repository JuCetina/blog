<?php

function mostrarErrores($array_errores, $nombre_indice){
    $alerta = '';
    if(isset($array_errores[$nombre_indice]) && !empty($nombre_indice)){
        $alerta = "<div class='alerta alerta-error'>".$array_errores[$nombre_indice]."</div>";
    }
    return $alerta;
}

function borrarAlertas(){
    if(isset($_SESSION['errores'])){
        $_SESSION['errores'] = null;
        unset($_SESSION['errores']);
    }

    if(isset($_SESSION['completado'])){
        $_SESSION['completado'] = null;
        unset($_SESSION['completado']);
    }
}

function obtenerCategorias($db){
    $sql = "SELECT * from categorias order by id ASC";
    $categorias = mysqli_query($db, $sql);
    $result = array();
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = $categorias;
    }
    return $result;
}

function obtenerUltimasEntradas($db){
    $sql = "SELECT e.*, c.* from entradas e ".
            "INNER JOIN categorias c ".
            "ON e.categoria_id = c.id ".
            "ORDER BY e.id DESC LIMIT 4";
    $entradas = mysqli_query($db, $sql);
    $result = array();
    if($entradas && mysqli_num_rows($entradas) >= 1){
        $result = $entradas;
    }
    return $result;
}