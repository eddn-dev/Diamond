<main class="auth">
  <div class="auth__container">
    <!-- Botón de cerrar -->
    <div class="auth__close">
      <img class="auth__close-icon" src="/build/img/icons/close.svg" alt="Icono de cerrar"/>
      <p class="auth__close-text">Cerrar</p>
    </div>

    <!-- Contenido del inicio de sesión -->
    <div class="auth__content">
      <div class="auth__image"></div>
      <p class="auth__title">Inicia sesión</p>

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

      <!-- Formulario de login -->
      <form class="form" method="POST" action="/login">
        <div class="form__campo">
          <label for="email" class="form__label">Correo electrónico o número celular:</label>
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
        <input type="submit" class="form__submit" value="Iniciar Sesión">
      </form>
    </div>
  </div>

  <!-- Enlaces de acción -->
  <div class="acciones">
    <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Regístrate</a>
    <a href="/olvide" class="acciones__enlace">Recuperar contraseña</a>
  </div>
</main>
