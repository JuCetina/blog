<?php
    require_once 'includes/header.php';
    require_once 'includes/redireccion.php';
?>

    <!-- Inicio contenedor de contenido principal y sidebar -->
    <div id="contenedor">
    
    <?php
        require_once 'includes/sidebar.php';
    ?>

        <!-- Contenido principal -->
        <div id="principal">
            <h1>Editar usuario</h1>
            <?php if(isset($_SESSION['completado'])): ?>
                <div class="alerta alerta-exito"><?=$_SESSION['completado'];?></div>
            <?php elseif(isset($_SESSION['errores'])): ?>
                <?= mostrarErrores($_SESSION['errores'], 'actualizacion'); ?>
            <?php endif; ?>
            <form action="editar_usuario.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="<?=$_SESSION['usuario']['nombre']?>" required>
                <?php if(isset($_SESSION['errores'])): ?>
                    <?= mostrarErrores($_SESSION['errores'], 'nombre'); ?>
                <?php endif; ?>
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" value="<?=$_SESSION['usuario']['apellidos']?>" required>
                <?php if(isset($_SESSION['errores'])): ?>
                    <?= mostrarErrores($_SESSION['errores'], 'apellido'); ?>
                <?php endif; ?>
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" value="<?=$_SESSION['usuario']['email']?>" required>
                <?php if(isset($_SESSION['errores'])): ?>
                    <?= mostrarErrores($_SESSION['errores'], 'email'); ?>
                <?php endif; ?>
                <label for="password">Contraseña</label>
                <input type="password" name="password" required>
                <?php if(isset($_SESSION['errores'])): ?>
                    <?= mostrarErrores($_SESSION['errores'], 'password'); ?>
                <?php endif; ?>
                <input class="btn" type="submit" value="Actualizar datos">
            </form>
            <?php borrarAlertas(); ?>
        </div>
    </div>
    <!-- Fin contenedor de contenido principal y sidebar -->

    <?php
        require_once 'includes/footer.php';
    ?>

</body>
</html>