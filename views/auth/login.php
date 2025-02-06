<main class="auth">
    <div class="auth__container">
        <!-- Botón/Cerrar -->
        <div class="auth__close">
            <img class="auth__close-icon" src="/build/img/icons/close.svg" alt="Icono de cerrar"/>
            <p class="auth__close-text">Cerrar</p>
        </div>
    
        <!-- Contenido principal -->
        <div class="auth__content">
            <div class="auth__image"></div>
    
            <p class="auth__title">Iniciar Sesión</p>
    
            <!-- Bloque de alertas -->
            <?php if (isset($alertas) && !empty($alertas)): ?>
                <?php foreach ($alertas as $tipo => $mensajes): ?>
                    <?php foreach ($mensajes as $mensaje): ?>
                        <div class="alerta alerta--<?= $tipo; ?>">
                            <?= $mensaje; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
    
            <form class="form" method="POST" action="/login">
                <div class="form__campo">
                    <label for="email" class="form__label">Correo electrónico o número celular:</label>
                    <input 
                        type="email" 
                        class="form__input" 
                        placeholder="Tu dirección de correo"
                        id="email"
                        name="email"
                        value="<?php echo isset($emailPreload) ? htmlspecialchars($emailPreload) : ''; ?>"
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
                <input type="submit" class="form__submit" value="Iniciar Sesión">
            </form>
        </div>
    </div>
    
    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Regístrate</a>
        <a href="/olvide" class="acciones__enlace">Recuperar contraseña</a>
    </div>
</main>
