<?php

require_once 'helpers.php';

?>

<!-- Barra lateral -->
<aside id="sidebar">
    <div id="login" class="bloque">
        <h3>Inicia sesión</h3>
        <form action="login.php" method="POST">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <input class="btn" type="submit" value="Entrar">
        </form>
    </div>
    <div id="register" class="bloque">
        <h3>Regístrate</h3>
        <?php if(isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito"><?=$_SESSION['completado'];?></div>
        <?php elseif(isset($_SESSION['errores'])): ?>
            <?= mostrarErrores($_SESSION['errores'], 'registro'); ?>
        <?php endif; ?>
        <form action="registro.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required>
            <?php if(isset($_SESSION['errores'])): ?>
                <?= mostrarErrores($_SESSION['errores'], 'nombre'); ?>
            <?php endif; ?>
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" required>
            <?php if(isset($_SESSION['errores'])): ?>
                <?= mostrarErrores($_SESSION['errores'], 'apellido'); ?>
            <?php endif; ?>
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" required>
            <?php if(isset($_SESSION['errores'])): ?>
                <?= mostrarErrores($_SESSION['errores'], 'email'); ?>
            <?php endif; ?>
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
            <?php if(isset($_SESSION['errores'])): ?>
                <?= mostrarErrores($_SESSION['errores'], 'password'); ?>
            <?php endif; ?>
            <input class="btn" type="submit" value="Registrarse">
        </form>
        <?php borrarAlertas(); ?>
    </div>
</aside>