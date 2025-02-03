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

            <!-- Formulario de registro -->
            <form class="form" method="POST" action="/registro">
                <div class="form__campo">
                    <label for="nombre" class="form__label">Nombre:</label>
                    <input 
                        type="text" 
                        class="form__input" 
                        placeholder="Tu nombre"
                        id="nombre"
                        name="nombre"
                        value="<?php echo htmlspecialchars($usuario->nombre); ?>"
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
                        value="<?php echo htmlspecialchars($usuario->email); ?>"
                    >
                </div>

                <div class="form__campo">
                    <label for="celular" class="form__label">Número celular:</label>
                    <input 
                        type="tel" 
                        class="form__input" 
                        placeholder="Tu número celular"
                        id="celular"
                        name="celular"
                        value="<?php echo isset($usuario->celular) ? htmlspecialchars($usuario->celular) : ''; ?>"
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

                <input type="submit" class="form__submit" value="Crear cuenta">
            </form>
        </div>
    </div>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>
