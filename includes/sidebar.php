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
        <form action="registro.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <input class="btn" type="submit" value="Registrarse">
        </form>
    </div>
</aside>