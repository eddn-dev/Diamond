(() => {
  const header = document.querySelector('.header');
  if (!header) return;

  // Manejo de scroll para .header--scrolled
  function handleScroll() {
    if (window.scrollY > 0) {
      header.classList.add('header--scrolled');
    } else {
      header.classList.remove('header--scrolled');
    }
  }
  handleScroll();
  window.addEventListener('scroll', handleScroll, { passive: true });

  // Hamburguesa para menú overlay
  const toggle = header.querySelector('.header__toggle');
  if (!toggle) return;

  const overlayNav = document.querySelector('.overlay-nav');
  if (!overlayNav) return;

  toggle.addEventListener('click', () => {
    const isActive = toggle.classList.toggle('is-active');
    overlayNav.classList.toggle('is-active', isActive);
    document.body.classList.toggle('nav-open', isActive);
    if (isActive) {
      header.classList.remove('header--scrolled');
    } else {
      handleScroll();
    }
  });

  // Botón de cierre en overlay
  const overlayClose = document.querySelector('.overlay-nav__close');
  if (overlayClose) {
    overlayClose.addEventListener('click', () => {
      toggle.classList.remove('is-active');
      overlayNav.classList.remove('is-active');
      document.body.classList.remove('nav-open');
      handleScroll();
    });
  }

  // Al redimensionar, cerramos overlay si se alcanza tablet
  function handleResize() {
    if (window.innerWidth >= 768) {
      toggle.classList.remove('is-active');
      overlayNav.classList.remove('is-active');
      document.body.classList.remove('nav-open');
      handleScroll();
    }
  }
  window.addEventListener('resize', handleResize);

  // Nueva lógica para el dropdown de usuario (activación por click)
  const userBtn = header.querySelector('.header__user-btn');
  const userDropdown = header.querySelector('.header__user-dropdown');
  
  if (userBtn && userDropdown) {
    userBtn.addEventListener('click', (e) => {
      // Evitar que se cierre al hacer click en el botón
      e.stopPropagation();
      userDropdown.classList.toggle('is-active');
    });
    
    // Cerrar el dropdown si se hace click fuera
    document.addEventListener('click', (e) => {
      if (!header.contains(e.target)) {
        userDropdown.classList.remove('is-active');
      }
    });
    
    // Evitar cierre al hacer click dentro del dropdown
    userDropdown.addEventListener('click', (e) => {
      e.stopPropagation();
    });
  }
})();
