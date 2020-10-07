<?php

if(isset($_POST)){
    //Incluye archivo de conexión a la base de datos
    require_once 'includes/conexion.php';

    //Si existe la variable POST nombre, entonces guarda el valor en la variable $nombre 
    if(isset($_POST['nombre'])){
        $nombre = mysqli_real_escape_string($db, trim($_POST['nombre']));
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    }

    //Array de errores
    $errores = array();

    //Valida los valores de las variables y guarda errores si aplica
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_categoria_validado = true;
    }
    else{
        $errores['categoria_nombre'] = "El nombre de la categoría no es válido";
    }

    //Si no hay errores, se insertan los datos en la base de datos
    if(count($errores) == 0){

        //Inserta categoría en bd
        $sql = "INSERT into categorias values (null, '$nombre')";
        $insercion = mysqli_query($db, $sql);

        //Ver errores de sql
        //var_dump(mysqli_error($db));
        //die();

        //Crea mensajes en $_SESSION
        if($insercion){
            $_SESSION['categoria_completado'] = "El registro se ha completado con éxito";
        }
        else{
            $errores['categoria_registro'] = "No fue posible registrar la categoría";
            $_SESSION['categoria_errores'] = $errores;
        }
    }
    else{
        $_SESSION['categoria_errores'] = $errores;
    }
}

header('Location:crear_categoria.php');