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

            <!-- Bloque para mostrar alertas -->
            <?php if (isset($alertas) && !empty($alertas)): ?>
                <?php foreach ($alertas as $tipo => $mensajes): ?>
                    <?php foreach ($mensajes as $mensaje): ?>
                        <div class="alerta alerta--<?= $tipo; ?>">
                            <?= $mensaje; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <form class="form" method="POST" action="/olvide">
                <div class="form__campo">
                    <label for="email" class="form__label">Correo electrónico o número celular:</label>
                    <input 
                        type="text" 
                        class="form__input" 
                        placeholder="Tu correo o número celular"
                        id="email"
                        name="email"
                        value="<?php echo isset($usuario->email) ? htmlspecialchars($usuario->email) : ''; ?>"
                    >
                </div>

                <input type="submit" class="form__submit" value="Enviar instrucciones">
            </form>
        </div>
    </div>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Obtén una</a>
    </div>
</main>
