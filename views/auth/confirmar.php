<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Tu cuenta en devwebcamp</p>
    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>  
    <?php if(isset($alertas['exito'])) { ?>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">Iniciar sesión</a>
    </div>
    <?php } ?>
</main>