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
            <h1>Todas las entradas</h1>
            <?php $entradas = obtenerEntradas($db); ?>
            <?php if(!empty($entradas)): ?>
                <?php while($entrada = mysqli_fetch_assoc($entradas)): ?>
                    <a href="entrada.php?id=<?=$entrada['id']?>">
                        <article class="entrada">
                            <h2><?=$entrada['titulo'];?></h2>
                            <span class="entrada_categoria_fecha"><?=$entrada['categoria']. " | Fecha de publicación: ".$entrada['fecha'];?></span>
                            <p><?=substr($entrada['descripcion'], 0, 200)."...";?></p>
                        </article>
                    </a>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- Fin contenedor de contenido principal y sidebar -->

    <?php
        require_once 'includes/footer.php';
    ?>

</body>
</html>