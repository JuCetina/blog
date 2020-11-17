<?php

//Redirecciona al usuario enviando al index.php (a la pantalla de inicio) si el usuario no está logueado
if(!isset($_SESSION['usuario'])){
    header('Location:index.php');
}