<?php

//Redirección para que envíe al indexphp si el usuario no está logueado
if(!isset($_SESSION['usuario'])){
    header('Location:index.php');
}