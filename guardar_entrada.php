<?php

if(isset($_POST)){
    //Incluye archivo de conexión a la base de datos
    require_once 'includes/conexion.php';

    //Si existen las variables POST, entonces guarda los valores en las respectivas variables
    if(isset($_POST['titulo'])){
        $titulo = mysqli_real_escape_string($db, trim($_POST['titulo']));
        $titulo = filter_var($titulo, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    }

    if(isset($_POST['descripcion'])){
        $descripcion = mysqli_real_escape_string($db, trim($_POST['descripcion']));
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    }

    if(isset($_POST['categoria'])){
        $categoria = $_POST['categoria'];
    }

    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario']['id'];
    }

    //Array de errores
    $errores = array();

    //Valida los valores de las variables y guarda errores si aplica
    if(!empty($titulo) && !is_numeric($titulo)){
        $titulo_validado = true;
    }
    else{
        $errores['entrada_titulo'] = "El titulo de la entrada no es válido";
    }

    if(!empty($descripcion) && !is_numeric($descripcion)){
        $descripcion_validada = true;
    }
    else{
        $errores['entrada_descripcion'] = "La descripción de la entrada no es válida";
    }

    if(!empty($categoria)){
        $categoria_validada = true;
    }
    else{
        $errores['entrada_categoria'] = "La categoría no es válida";
    }

    if(!empty($usuario)){
        $usuario_validado = true;
    }
    else{
        $errores['entrada_usuario'] = "El usuario no es válido";
    }

    //Si no hay errores, se insertan los datos en la base de datos
    if(count($errores) == 0){
        //Si es una edición
        if(isset($_GET['editar'])){
            $entrada_id = $_GET['editar'];

            //Edita entrada en bd
            $sql =  "UPDATE entradas SET ".
                    "categoria_id = '$categoria', ".
                    "titulo = '$titulo', ".
                    "descripcion = '$descripcion', ".
                    "fecha = CURDATE() ".
                    "WHERE id = '$entrada_id' AND usuario_id = '$usuario'";
        }
        //Si es una inserción
        else{
            //Inserta entrada en bd
            $sql = "INSERT into entradas values (null, '$usuario', '$categoria', '$titulo', '$descripcion', CURDATE())";
        }
        $insercion = mysqli_query($db, $sql);

        //Ver errores de sql
        //var_dump(mysqli_error($db));
        //die();

        //Crea mensajes en $_SESSION
        if($insercion){
            $_SESSION['entrada_completado'] = "El registro se ha completado con éxito";
        }
        else{
            $errores['entrada_registro'] = "No fue posible registrar la entrada";
            $_SESSION['entrada_errores'] = $errores;
        }
    }
    else{
        $_SESSION['entrada_errores'] = $errores;
    }
}

//Si es una edición redirige al formulario para editar entradas
if(isset($_GET['editar'])){
    header("Location:editar_entrada.php?id=$entrada_id");
}
//Si es una inserción redirige al formulario para crear entradas
else{
    header("Location:crear_entrada.php");
}    
    