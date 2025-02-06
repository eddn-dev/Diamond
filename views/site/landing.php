<main class="landing">
  <!-- HERO SECTION (UN SOLO SLIDE) -->
  <section class="hero">
    <!-- Imagen definida dinámicamente (si no se pasa, usa un default) -->
    <img class="hero__image" src="<?php echo $hero_image ?? '/build/img/hero.jpg'; ?>" alt="Experiencia Diamond">
    
    <!-- Overlay con degradado sutil hacia la derecha -->
    <div class="hero__overlay"></div>
    
    <!-- Contenido del Hero -->
    <div class="hero__content">
      <h1 class="hero__title">
        Redefine <span class="hero__title--highlight">tu estilo</span> hoy
      </h1>
      <p class="hero__subtitle">
        Descubre la elegancia en cada detalle
      </p>
      <a href="/reservar" class="cta btn">Agendar Cita</a>
    </div>
  </section>

  <!-- SERVICES SECTION -->
  <section class="services">
    <div class="services__container">
      <h2 class="services__title">Nuestros Servicios</h2>
      <div class="services__grid">
        <!-- Tarjeta para Corte de Cabello -->
        <div class="service-card">
          <!-- Contenedor de imagen que ciclará entre varias fotos -->
          <div class="service-card__image-container" data-images='["/build/img/services/corte1.webp", "/build/img/services/corte2.webp", "/build/img/services/corte3.webp", "/build/img/services/corte4.webp", "/build/img/services/corte5.webp", "/build/img/services/corte6.webp"]'>
            <img class="service-card__image" src="/build/img/services/corte1.webp" alt="Corte de Cabello">
          </div>
          <div class="service-card__inner">
            <h3 class="service-card__title">Corte de Cabello</h3>
            <!-- Íconos para públicos (ejemplo: niños, hombres, mujeres) -->
            <div class="service-card__demographics">
              <i class="fas fa-child" title="Niños"></i>
              <i class="fas fa-male" title="Hombres"></i>
              <i class="fas fa-female" title="Mujeres"></i>
            </div>
            <p class="service-card__desc">Cortes modernos y clásicos adaptados a ti.</p>
            <a href="/servicio/corte" class="cta btn service-card__button">Ver Más</a>
          </div>
        </div>

        <!-- Tarjeta para Peinados -->
        <div class="service-card">
          <div class="service-card__image-container" data-images='["/build/img/services/peinado1.jpg", "/build/img/services/peinado2.jpg", "/build/img/services/peinado3.jpg", "/build/img/services/peinado4.jpg", "/build/img/services/peinado5.jpg", "/build/img/services/peinado6.jpg"]'>
            <img class="service-card__image" src="/build/img/services/peinado1.jpg" alt="Peinados">
          </div>
          <div class="service-card__inner">
            <h3 class="service-card__title">Peinados</h3>
            <div class="service-card__demographics">
              <i class="fas fa-child" title="Niñas"></i>
              <i class="fas fa-female" title="Mujeres"></i>
            </div>
            <p class="service-card__desc">Peinados elegantes para cada ocasión.</p>
            <a href="/servicio/peinados" class="cta btn service-card__button">Ver Más</a>
          </div>
        </div>

        <!-- Tarjeta para Tintes y Coloración -->
        <div class="service-card">
          <div class="service-card__image-container" data-images='["/build/img/services/tinte1.jpg", "/build/img/services/tinte2.jpg", "/build/img/services/tinte3.jpg", "/build/img/services/tinte4.jpg", "/build/img/services/tinte5.jpg", "/build/img/services/tinte6.jpg"]'>
            <img class="service-card__image" src="/build/img/services/tinte1.jpg" alt="Tintes y Coloración">
          </div>
          <div class="service-card__inner">
            <h3 class="service-card__title">Tintes y Coloración</h3>
            <div class="service-card__demographics">
              <i class="fas fa-female" title="Mujeres"></i>
              <i class="fas fa-male" title="Hombres"></i>
            </div>
            <p class="service-card__desc">Dale vida a tu cabello con colores vibrantes.</p>
            <a href="/servicio/tinte" class="cta btn service-card__button">Ver Más</a>
          </div>
        </div>
      </div>
      <a href="/servicios" class="cta cta--secondary">Ver Todos los Servicios</a>
    </div>
  </section>

  <section class="cta-section">
    <div class="cta-section__container">
      <!-- Columna Izquierda: Imagen (1:1) -->
      <div class="cta-section__image">
        <img src="<?php echo $cta_image ?? '/build/img/cta-default.jpg'; ?>" alt="Agenda tu cita">
      </div>
      <!-- Columna Derecha: Contenido de texto y CTA -->
      <div class="cta-section__content">
        <h2 class="cta-section__title">Agenda tu cita</h2>
        <p class="cta-section__subtitle">
          En Diamond nos preocupamos por tus necesidades, agenda una cita para experimentar nuestra atención.
        </p>
        <a href="/reservar" class="cta btn cta-section__button">Agendar</a>
      </div>
    </div>
  </section>


  <!-- BRANCHES SECTION -->
  <section class="branches">
    <div class="branches__container">
      <h2 class="branches__title">Nuestras Sucursales</h2>
      <div class="branches__map">
        <!-- Aquí se integraría un mapa interactivo o listado -->
        <p>Mapa interactivo o listado de sucursales</p>
      </div>
      <a href="/sucursales" class="cta cta--secondary">Ver Sucursales</a>
    </div>
  </section>

  <!-- TESTIMONIALS SECTION -->
  <section class="testimonials">
    <div class="testimonials__container">
      <h2 class="testimonials__title">Lo que dicen nuestros clientes</h2>
      <div class="testimonials__grid">
        <div class="testimonial-card">
          <p class="testimonial-card__text">"Diamond ha transformado mi look. ¡Me siento increíble!"</p>
          <p class="testimonial-card__author">- Ana López</p>
        </div>
        <div class="testimonial-card">
          <p class="testimonial-card__text">"Un servicio excepcional y un ambiente único. ¡Altamente recomendado!"</p>
          <p class="testimonial-card__author">- Carlos Méndez</p>
        </div>
        <div class="testimonial-card">
          <p class="testimonial-card__text">"La mejor experiencia en estética. Profesionalismo y calidad."</p>
          <p class="testimonial-card__author">- María García</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FINAL CTA SECTION -->
  <section class="final-cta">
    <div class="final-cta__container">
      <p class="final-cta__text">¿Listo para transformar tu estilo?</p>
      <a href="/reservar" class="cta btn cta--primary">Reserva tu Cita</a>
    </div>
  </section>
</main>
