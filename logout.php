<?php

//Inicia sesión
session_start();

//Si hay un inicio de sesión de un usuario
if(isset($_SESSION['usuario'])){
    //Destruyo la sesión
    session_destroy();
}

//Redirige a la página principal
header("Location: index.php");