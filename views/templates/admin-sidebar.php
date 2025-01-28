<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__link <?php echo current_page('/dashboard') ? 'dashboard__link-current' : ''; ?>">
            <i class="fa-solid fa-house icon"></i>
            <span class="dashboard__menu-text">
                Inicio
            </span>
        </a>
        <a href="/admin/ponentes" class="dashboard__link <?php echo current_page('/ponentes') ? 'dashboard__link-current' : ''; ?>">
            <i class="fa-solid fa-microphone icon"></i>
            <span class="dashboard__menu-text">
                Ponentes
            </span>
        </a>
        <a href="/admin/eventos" class="dashboard__link <?php echo current_page('/eventos') ? 'dashboard__link-current' : ''; ?>">
            <i class="fa-solid fa-calendar icon"></i>
            <span class="dashboard__menu-text">
                Eventos
            </span>
        </a>
        <a href="/admin/registrados" class="dashboard__link <?php echo current_page('/registrados') ? 'dashboard__link-current' : ''; ?>">
            <i class="fa-solid fa-users icon"></i>
            <span class="dashboard__menu-text">
                Registrados
            </span>
        </a>
        <a href="/admin/regalos" class="dashboard__link <?php echo current_page('/regalos') ? 'dashboard__link-current' : ''; ?>">
            <i class="fa-solid fa-gift icon"></i>
            <span class="dashboard__menu-text">
                Regalos
            </span>
        </a>
    </nav>
</aside>