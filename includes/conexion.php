<?php
//Conexión con la base de datos blog

//Conexión local
$db = mysqli_connect('localhost', 'root', 'root', 'blog');
mysqli_query($db, "SET NAMES 'utf8'");

//Iniciar sesión
session_start();
