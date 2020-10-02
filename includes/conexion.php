<?php
//Conexión con la base de datos blog

$db = mysqli_connect('localhost', 'root', 'root', 'blog');
mysqli_query($db, "SET NAMES 'utf8'");
