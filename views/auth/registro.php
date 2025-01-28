<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebCamp</p>

    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>  
    <form class="form" method="POST" action="/registro">
        <div class="form__campo">
            <label for="nombre" class="form__label">Nombre:</label>
            <input 
                type="text" 
                class="form__input" 
                placeholder="Tu nombre"
                id="nombre"
                name="nombre"
            >
        </div>
        <div class="form__campo">
            <label for="apellido" class="form__label">Apellido:</label>
            <input 
                type="text" 
                class="form__input" 
                placeholder="Tu apellido"
                id="apellido"
                name="apellido"
            >
        </div>
        <div class="form__campo">
            <label for="email" class="form__label">Correo:</label>
            <input 
                type="email" 
                class="form__input" 
                placeholder="Tu dirección de correo"
                id="email"
                name="email"
            >
        </div>
        <div class="form__campo">
            <label for="password" class="form__label">Contraseña:</label>
            <input 
                type="password" 
                class="form__input" 
                placeholder="Tu contraseña"
                id="password"
                name="password"
            >
        </div>

        <div class="form__campo">
            <label for="password2" class="form__label">Confirmar contraseña:</label>
            <input 
                type="password" 
                class="form__input" 
                placeholder="Repite tu contraseña"
                id="password2"
                name="password2"
            >
        </div>

        <input type="submit" class="form__submit" value="Crear cuenta">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>