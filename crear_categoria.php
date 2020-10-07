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
            <h1>Crear categoría</h1>
            <p>Cree una categoría para que los usuarios puedan
             usarlas al momento de crear entradas.</p>
            <?php if(isset($_SESSION['categoria_completado'])): ?>
                <div class="alerta alerta-exito"><?=$_SESSION['categoria_completado'];?></div>
            <?php elseif(isset($_SESSION['categoria_errores'])): ?>
                <?= mostrarErrores($_SESSION['categoria_errores'], 'categoria_registro'); ?>
            <?php endif; ?>
            <form action="guardar_categoria.php" method="POST">
                <label for="nombre">Nombre de la Categoría</label>
                <input type="text" name="nombre" required>
                <?php if(isset($_SESSION['categoria_errores'])): ?>
                    <?= mostrarErrores($_SESSION['categoria_errores'], 'categoria_nombre'); ?>
                <?php endif; ?>
                <input type="submit" class="btn" value="Crear categoría"> 
            </form>
            <?php borrarAlertasCategoria(); ?>
        </div>
    </div>
    <!-- Fin contenedor de contenido principal y sidebar -->

    <?php
        require_once 'includes/footer.php';
    ?>

</body>
</html>

