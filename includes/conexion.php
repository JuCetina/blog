<?php
//Conexión con la base de datos blog

$db = mysqli_connect('localhost', 'root', 'root', 'blog');
//Conexión al proyecto montado en Heroku:
//$db = mysqli_connect('us-cdbr-east-02.cleardb.com', 'b24f49366375c8', '2960ec11', 'heroku_aa40eae22e4a3b6');
mysqli_query($db, "SET NAMES 'utf8'");

//Iniciar sesión
session_start();
