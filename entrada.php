<?php
    require_once 'includes/header.php';
    $entrada_actual = obtenerEntrada($db, $_GET['id']);
    if(!isset($entrada_actual['id'])){
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
            <h1><?=$entrada_actual['titulo']?></h1>
            <article class="entrada">
                <a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
                    <h2><?=$entrada_actual['categoria']?></h2>
                </a>
                <span class="entrada_categoria_fecha"><?="Fecha de publicación: ".$entrada_actual['fecha'];?></span>
                <p><?=$entrada_actual['descripcion'];?></p>
            </article>
        </div>
    </div>
    <!-- Fin contenedor de contenido principal y sidebar -->

    <?php
        require_once 'includes/footer.php';
    ?>

</body>
</html>