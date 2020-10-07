<?php
    require_once 'includes/header.php';
?>

    <!-- Inicio contenedor de contenido principal y sidebar -->
    <div id="contenedor">
    
    <?php
        require_once 'includes/sidebar.php';
    ?>

        <!-- Contenido principal -->
        <div id="principal">
            <h1>Últimas entradas</h1>
            <?php $entradas = obtenerUltimasEntradas($db); ?>
            <?php if(!empty($entradas)): ?>
                <?php while($entrada = mysqli_fetch_assoc($entradas)): ?>
                    <a href="">
                        <article class="entrada">
                            <h2><?=$entrada['titulo'];?></h2>
                            <p><?=substr($entrada['descripcion'], 0, 200)."...";?></p>
                        </article>
                    </a>
                <?php endwhile; ?>
            <?php endif; ?>
            
            
            <div id="ver-todas">
                <a class="btn" href="#">Ver todas las entradas</a>
            </div>
        </div>


    </div>
    <!-- Fin contenedor de contenido principal y sidebar -->

    <?php
        require_once 'includes/footer.php';
    ?>

</body>
</html>