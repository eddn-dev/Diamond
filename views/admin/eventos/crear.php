<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__button-container">
    <a href="/admin/eventos" class="dashboard__button">
        <i class="fa-solid fa-circle-arrow-left">
        </i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php 
        include_once __DIR__ . '/../../templates/alerts.php';
    ?>

    <form action="/admin/eventos/crear" class="form" method="POST" enctype="multipart/form-data">
        <?php include_once __DIR__ . '/formulario.php'?>

        <input class="form__submit form__submit--register" type="submit" value="Registrar evento">
    </form>
</div>