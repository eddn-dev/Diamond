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
    
            <!-- Si existe una alerta de éxito, se muestra un formulario para iniciar sesión con email precargado -->
            <?php if (isset($alertas['exito'])): ?>
                <form method="POST" action="/login">
                    <input type="hidden" name="action" value="init_session">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <input type="submit" class="form__submit" value="Iniciar sesión">
                </form>
            <?php endif; ?>
        </div>
    </div>
</main>
