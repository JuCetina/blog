<?php

if(isset($_POST)){

    require_once 'includes/conexion.php';

    //Guarda en variables los valores que llegan del formulario
    if(isset($_POST['nombre'])){
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    }
    else{
        $nombre = false;
    }

    if(isset($_POST['apellidos'])){
        $apellidos = mysqli_real_escape_string($db, $_POST['apellidos']);
    }
    else{
        $apellidos = false;
    }

    if(isset($_POST['email'])){
        $email = mysqli_real_escape_string($db, $_POST['email']);
    }
    else{
        $email = false;
    }

    if(isset($_POST['password'])){
        $password = mysqli_real_escape_string($db, $_POST['password']);
    }
    else{
        $password = false;
    }
    
    //Array de errores
    $errores = array();

    //Valida los valores de las variables y guarda errores si aplica
    if($nombre != false && !empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
    }
    else{
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
    }

    if($apellidos != false && !empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validados = true;
    }
    else{
        $apellidos_validados = false;
        $errores['apellidos'] = "Los apellidos no son válidos";
    }

    if($email != false && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }
    else{
        $email_validado = false;
        $errores['email'] = "El email no es válido";
    }

    if($password != false && !empty($password)){
        $password_validado = true;
    }
    else{
        $password_validado = false;
        $errores['password'] = "La contraseña está vacía";
    }
    
    //Si no hay errores, se insertan los datos en la base de datos
    if(count($errores) == 0){

        //Cifra contraseña x 4 veces con PASSWORD_BCRYPT
        $password_cifrada = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

        //Inserta usuario en bd
        $sql = "INSERT into usuarios values (null, '$nombre', '$apellidos', '$email', '$password_cifrada', CURDATE())";
        $insercion = mysqli_query($db, $sql);

        //Ver errores de sql
        //var_dump(mysqli_error($db));
        //die();

        //Crea mensajes en $_SESSION
        if($insercion){
            $_SESSION['completado'] = "El registro se ha completado con éxito";
        }
        else{
            $errores['registro'] = "No fue posible registrar el usuario";
            $_SESSION['errores'] = $errores;
        }

    }
    else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location:index.php');
