<?php
    require_once 'conexion.php';
    require_once 'helpers.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Blog de Videojuegos</title>
</head>
<body>
    <!-- Cabecera -->
    <header id="cabecera">
        <!-- Logo -->
        <div id="logo">
            <a href="index.php">
                Blog de Videojuegos
            </a>
        </div>

        <!-- Menú -->
        <nav id="menu">
            <ul>
                <a href="index.php">
                    <li>Inicio</li>
                </a>
                <?php $categorias = obtenerCategorias($db); ?>
                <?php while($categoria = mysqli_fetch_assoc($categorias)): ?>
                    <a href="categoria.php?id=<?=$categoria['id']?>">
                        <li><?=$categoria['nombre']?></li>
                    </a>
                <?php endwhile; ?>
                <a href="sobremi.php">
                    <li>Sobre mí</li>
                </a>
                <a href="contacto.php">
                    <li>Contacto</li>
                </a>
            </ul>
        </nav>
    </header>