<main class="auth">
  <div class="auth__container">
    <!-- Imagen lateral -->
    <div class="auth__deco auth__deco--right">
    </div>
    <div class="auth__deco auth__deco--left">
    </div>

    <!-- Contenido de inicio de sesión -->
    <div class="auth__content">
      <p class="auth__texto">Inicia Sesión</p>

      <form class="form" method="POST" action="login">
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

        <input type="submit" class="form__submit" value="Iniciar Sesión">
      </form>

      <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Obtén una</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
      </div>
    </div>
  </div>
</main>
