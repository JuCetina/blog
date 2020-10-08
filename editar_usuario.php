<?php

if(isset($_POST)){

    //Incluye el archivo que tiene la conexión a la bd y hace el inicio de sesión
    require_once 'includes/conexion.php';
    
    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['password'])){

        //Guarda en variables los valores que llegan del formulario

        //Quita espacios al comienzo y al final de los datos
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['email']);

        //Escapa los datos para que no existan errores al guardarlos en la base de datos
        $nombre = mysqli_real_escape_string($db, $nombre);
        $apellido = mysqli_real_escape_string($db, $apellido);
        $email = mysqli_real_escape_string($db, $email);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        //Sanea datos: retira etiquetas html y no codifica las comillas simples y dobles
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $apellido = filter_var($apellido, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    }
    
    //Array de errores
    $errores = array();

    //Valida los valores de las variables y guarda errores si aplica
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
    }
    else{
        $errores['nombre'] = "El nombre no es válido";
    }

    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
        $apellido_validado = true;
    }
    else{
        $errores['apellido'] = "El apellido no es válido";
    }

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }
    else{
        $errores['email'] = "El email no es válido";
    }

    if(!empty($password)){
        $password_validado = true;
    }
    else{
        $errores['password'] = "La contraseña está vacía";
    }
    
    //Si no hay errores, se insertan los datos en la base de datos
    if(count($errores) == 0){

        $usuario = $_SESSION['usuario'];

        //Consulta si el email ingresado ya existe en la base de datos
        $sql_email = "SELECT id, email from usuarios where email = '$email'";
        $resultado = mysqli_query($db, $sql_email);
        $comprueba = mysqli_fetch_assoc($resultado);

        //Si el email existe pero es del usuario actualmente logueado o
        //Si el email no existe en la base de datos, permite actualizar datos del usuario
        if($comprueba['id'] == $usuario['id'] || empty($comprueba)){

            //Cifra contraseña x 4 veces con PASSWORD_BCRYPT
            $password_cifrada = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
    
            //Actualiza usuario en bd
            $sql = "UPDATE usuarios "
                    ."SET nombre = '$nombre', "
                    ."apellidos = '$apellido', "
                    ."email = '$email', "
                    ."password = '$password_cifrada' "
                    ."where id = ".$usuario['id'];
    
            $insercion = mysqli_query($db, $sql);
    
            //Ver errores de sql
            //var_dump(mysqli_error($db));
            //die();
    
            //Crea mensajes en $_SESSION
            if($insercion){
                $_SESSION['completado'] = "La actualización se ha completado con éxito";
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellido;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['usuario']['password'] = $password_cifrada;
            }
            else{
                $errores['actualizacion'] = "No fue posible actualizar el usuario";
                $_SESSION['errores'] = $errores;
            }
        }
        else{
            $errores['actualizacion'] = "El email ingresado ya pertenece a otro usuario";
            $_SESSION['errores'] = $errores;
        }
    }
    else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location:datos_usuario.php');
