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

    if(isset($_SESSION['error_login'])){
        $_SESSION['error_login'] = null;
        unset($_SESSION['error_login']);
    }

    if(isset($_SESSION['categoria_errores'])){
        $_SESSION['categoria_errores'] = null;
        unset($_SESSION['categoria_errores']);
    }

    if(isset($_SESSION['categoria_completado'])){
        $_SESSION['categoria_completado'] = null;
        unset($_SESSION['categoria_completado']);
    }

    if(isset($_SESSION['entrada_errores'])){
        $_SESSION['entrada_errores'] = null;
        unset($_SESSION['entrada_errores']);
    }

    if(isset($_SESSION['entrada_completado'])){
        $_SESSION['entrada_completado'] = null;
        unset($_SESSION['entrada_completado']);
    }

    if(isset($_SESSION['eliminacion_entrada_completado'])){
        $_SESSION['eliminacion_entrada_completado'] = null;
        unset($_SESSION['eliminacion_entrada_completado']);
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

function obtenerCategoria($db, $id){
    $sql = "SELECT * from categorias where id = $id";
    $categoria = mysqli_query($db, $sql);
    $result = array();
    if($categoria && mysqli_num_rows($categoria) == 1){
        $result = mysqli_fetch_assoc($categoria);
    }
    return $result;
}

function obtenerEntradas($db, $limit = null, $categoria_id = null){
    $sql = "SELECT e.*, c.nombre AS categoria from entradas e ".
            "INNER JOIN categorias c ".
            "ON e.categoria_id = c.id ";
    
    if(!empty($categoria_id)){
        $sql .= "WHERE e.categoria_id = $categoria_id ";
    }

    $sql .= "ORDER BY e.id DESC ";

    if($limit){
        $sql .= "LIMIT 4";
    }

    $entradas = mysqli_query($db, $sql);
    $result = array();
    if($entradas && mysqli_num_rows($entradas) >= 1){
        $result = $entradas;
    }
    return $result;
}

function obtenerEntrada($db, $id){
    $sql =  "SELECT e.*, c.nombre AS categoria, ". 
            "CONCAT(u.nombre, ' ', u.apellidos) AS nombre_usuario ".
            "from entradas e ".
            "INNER JOIN categorias c ".
            "ON e.categoria_id = c.id ".
            "INNER JOIN usuarios u ".
            "ON e.usuario_id = u.id ".
            "WHERE e.id = $id";
    $entrada = mysqli_query($db, $sql);
    $result = array();
    if($entrada && mysqli_num_rows($entrada) == 1){
        $result = mysqli_fetch_assoc($entrada);
    }
    return $result;
}