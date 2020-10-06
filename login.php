<?php

if(isset($_POST)){

    //Incluye archivo con la conexión a la bd y la sesión iniciada
    require_once 'includes/conexion.php';

    //Borra variable de sesión con mensaje de error si existe
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    //Recoge los valores y los guarda en variables
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Consulta que obtiene el usuario con el email ingresado
    $sql = "SELECT * from usuarios where email = '$email'";
    $login = mysqli_query($db, $sql);
    
    if($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);
        //var_dump($usuario);

        //Comprueba si la contraseña ingresada es igual a la cifrada guardada en bd
        $verify = password_verify($password, $usuario['password']);

        if($verify){
            //Crea una variable de sesión con los datos del usuario
            $_SESSION['usuario'] = $usuario;
        }
        else{
            $_SESSION['error_login'] = "Login incorrecto";
        }
    }
    else{
        $_SESSION['error_login'] = "Login incorrecto";
    }
}

header("Location:index.php");