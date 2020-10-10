<?php
    require_once 'includes/header.php';

    if(!isset($_POST['busqueda'])){
        header('Location: index.php');
    }
    
?>

    <!-- Inicio contenedor de contenido principal y sidebar -->
    <div id="contenedor">
    
    <?php
        require_once 'includes/sidebar.php';
    ?>

        <!-- Contenido principal -->
        <div id="principal">
            
            <h1>Búsqueda: <?=$_POST['busqueda']?></h1>
            
            <?php $entradas = obtenerEntradas($db, null, null, $_POST['busqueda']); ?>
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
            <?php else: ?>
                <p>No se encontraron resultados para la búsqueda.</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Fin contenedor de contenido principal y sidebar -->

    <?php
        require_once 'includes/footer.php';
    ?>

</body>
</html>