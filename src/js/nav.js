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

  // Hamburguesa
  const toggle = header.querySelector('.header__toggle');
  if (!toggle) return;

  // Overlay nav (fuera del header)
  const overlayNav = document.querySelector('.overlay-nav');
  if (!overlayNav) return;

  // Al hacer clic en la hamburguesa
  toggle.addEventListener('click', () => {
    const isActive = toggle.classList.toggle('is-active');
    // Activamos/desactivamos overlay nav
    overlayNav.classList.toggle('is-active', isActive);
    // Bloquear scroll en body
    document.body.classList.toggle('nav-open', isActive);

    if (isActive) {
      // Si el menú se abre, quitamos la clase scrolled
      header.classList.remove('header--scrolled');
    } else {
      // Si el menú se cierra, verificamos scroll para reponer o no la clase
      handleScroll();
    }
  });

  // Bug Fix: Al redimensionar a >= 768px, cerramos overlay y restauramos
  function handleResize() {
    if (window.innerWidth >= 768) {
      toggle.classList.remove('is-active');
      overlayNav.classList.remove('is-active');
      document.body.classList.remove('nav-open');
      // Al cerrar a la fuerza, chequea si debe reponer scrolled:
      handleScroll();
    }
  }
  window.addEventListener('resize', handleResize);
})();
