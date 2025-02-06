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

            <p class="auth__title"><?php echo $titulo; ?></p>
            
            <!-- Bloque de Alertas -->
            <?php if (isset($alertas) && !empty($alertas)): ?>
                <?php foreach ($alertas as $tipo => $mensajes): ?>
                    <?php foreach ($mensajes as $mensaje): ?>
                        <div class="alerta alerta--<?= $tipo; ?>">
                            <?= $mensaje; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Formulario para restablecer la contraseña -->
            <?php if($token_valido): ?>
                <form class="form" method="POST">
                    <div class="form__campo">
                        <label for="password" class="form__label">Nueva contraseña:</label>
                        <input 
                            type="password" 
                            class="form__input" 
                            placeholder="Ingresa tu nueva contraseña"
                            id="password"
                            name="password"
                        >
                    </div>

                    <div class="form__campo">
                        <label for="password2" class="form__label">Confirmar nueva contraseña:</label>
                        <input 
                            type="password" 
                            class="form__input" 
                            placeholder="Confirma tu nueva contraseña"
                            id="password2"
                            name="password2"
                        >
                    </div>

                    <input type="submit" class="form__submit" value="Confirmar cambios">
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Enlaces de acción -->
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Obtén una</a>
    </div>
</main>
