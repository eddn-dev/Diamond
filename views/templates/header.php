<?php 
  $currentRoute = $_SERVER['REQUEST_URI'];
  if ($currentRoute !== '/') {
    $currentRoute = rtrim($currentRoute, '/');
  }
?>
<header class="header">
  <div class="header__container">
    <!-- Sección Izquierda: Logo + Navegación (Desktop) -->
    <div class="header__left">
      <a href="/" class="header__logo"></a>
      <nav class="header__nav">
        <ul class="header__list">
          <li class="header__item">
            <a class="header__link <?php echo ($currentRoute === '' || $currentRoute === '/') ? 'active' : ''; ?>" href="/">Inicio</a>
          </li>
          <li class="header__item">
            <a class="header__link <?php echo ($currentRoute === '/sucursales') ? 'active' : ''; ?>" href="/sucursales">Sucursales</a>
          </li>
          <li class="header__item">
            <a class="header__link <?php echo ($currentRoute === '/servicios') ? 'active' : ''; ?>" href="/servicios">Servicios</a>
          </li>
          <li class="header__item">
            <a class="header__link <?php echo ($currentRoute === '/contacto') ? 'active' : ''; ?>" href="/contacto">Contacto</a>
          </li>
        </ul>
      </nav>
    </div>
    
    <!-- Sección Derecha: CTA y Usuario -->
    <div class="header__right">
      <a href="/reservar" class="cta btn header__cta">Agendar Cita</a>
      
      <div class="header__user">
        <button class="header__user-btn" aria-label="Mi cuenta">
          <i class="fas fa-user"></i>
        </button>
        <div class="header__user-dropdown">
          <ul class="header__user-list">
            <?php if (isset($_SESSION['id'])): ?>
              <li><a href="/mi-cuenta">Mi Cuenta</a></li>
              <li><a href="/logout" class="logout-link">Cerrar Sesión</a></li>
            <?php else: ?>
              <li><a href="/login">Iniciar Sesión</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
      
      <button class="header__toggle" aria-label="Abrir menú">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>
</header>

<!-- Menú Overlay (Mobile) -->
<nav class="overlay-nav">
  <div class="overlay-nav__header">
    <button class="overlay-nav__close" aria-label="Cerrar menú">
      <i class="fas fa-times"></i>
    </button>
  </div>
  <ul class="overlay-nav__list">
    <li class="overlay-nav__item">
      <a class="overlay-nav__link <?php echo ($currentRoute === '' || $currentRoute === '/') ? 'active' : ''; ?>" href="/">Inicio</a>
    </li>
    <li class="overlay-nav__item">
      <a class="overlay-nav__link <?php echo ($currentRoute === '/sucursales') ? 'active' : ''; ?>" href="/sucursales">Sucursales</a>
    </li>
    <li class="overlay-nav__item">
      <a class="overlay-nav__link <?php echo ($currentRoute === '/servicios') ? 'active' : ''; ?>" href="/servicios">Servicios</a>
    </li>
    <li class="overlay-nav__item">
      <a class="overlay-nav__link <?php echo ($currentRoute === '/contacto') ? 'active' : ''; ?>" href="/contacto">Contacto</a>
    </li>
  </ul>
  <div class="overlay-nav__cta">
    <a href="/reservar" class="cta btn">Agendar Cita</a>
  </div>
  <div class="overlay-nav__account">
    <?php if (isset($_SESSION['id'])): ?>
      <a class="overlay-nav__account-link" href="/mi-cuenta">Mi Cuenta</a>
      <a class="overlay-nav__account-link logout-link" href="/logout">Cerrar Sesión</a>
    <?php else: ?>
      <a class="overlay-nav__account-link" href="/login">Iniciar Sesión</a>
    <?php endif; ?>
  </div>
</nav>
