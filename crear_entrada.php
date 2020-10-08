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
            <h1>Crear entrada</h1>
            <p>Cree una entrada para que los usuarios puedan
             disfrutar del contenido.</p>
            <?php if(isset($_SESSION['entrada_completado'])): ?>
                <div class="alerta alerta-exito"><?=$_SESSION['entrada_completado'];?></div>
            <?php elseif(isset($_SESSION['entrada_errores'])): ?>
                <?= mostrarErrores($_SESSION['entrada_errores'], 'entrada_registro'); ?>
            <?php endif; ?>
            <form action="guardar_entrada.php" method="POST">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" required>
                <?php if(isset($_SESSION['entrada_errores'])): ?>
                    <?= mostrarErrores($_SESSION['entrada_errores'], 'entrada_titulo'); ?>
                <?php endif; ?>

                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" cols="30" rows="10" required></textarea>
                <?php if(isset($_SESSION['entrada_errores'])): ?>
                    <?= mostrarErrores($_SESSION['entrada_errores'], 'entrada_descripcion'); ?>
                <?php endif; ?>

                <label for="categoria">Categoría</label>
                <select name="categoria">
                    <?php $categorias = obtenerCategorias($db); ?>
                    <?php if(!empty($categorias)): ?>
                        <?php while($categoria = mysqli_fetch_assoc($categorias)): ?>
                            <option value="<?=$categoria['id']?>"><?=$categoria['nombre'];?></option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
                <?php if(isset($_SESSION['entrada_errores'])): ?>
                    <?= mostrarErrores($_SESSION['entrada_errores'], 'entrada_categoria'); ?>
                <?php endif; ?>

                <input type="submit" class="btn" value="Crear entrada"> 
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

