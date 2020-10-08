<!-- Barra lateral -->
<aside id="sidebar">
    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario_logueado" class="bloque">
            <h3>
                Bienvenido(a), <?=$_SESSION['usuario']['nombre']." ".$_SESSION['usuario']['apellidos'];?>
            </h3>
            <a class="btn btn-option crear" href="crear_entrada.php">Crear entrada</a>
            <a class="btn btn-option" href="crear_categoria.php">Crear categoría</a>
            <a class="btn btn-option editar" href="editar_usuario.php">Mis datos</a>
            <a class="btn btn-option logout" href="logout.php">Cerrar sesión</a>
        </div>
    <?php else: ?>
        <div id="login" class="bloque">
            <h3>Inicia sesión</h3>
            <?php if(isset($_SESSION['error_login'])): ?>
                <div class="alerta alerta-error">
                    <?=$_SESSION['error_login'];?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" required>
                <label for="password">Contraseña</label>
                <input type="password" name="password" required>
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
    <?php endif; ?>
</aside>