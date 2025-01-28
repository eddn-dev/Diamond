<fieldset class="form__fieldset">
    <legend class="form__legend"> Información personal</legend>
    <div class="form__campo">
        <label for="nombre" class="form__label">Nombre</label>
        <input 
            type="text"
            class="form__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre ponente"
            value="<?php echo $ponente->nombre ?? ''; ?>"
        >
    </div>

    <div class="form__campo">
        <label for="apellido" class="form__label">Apellido</label>
        <input 
            type="text"
            class="form__input"
            id="apellido"
            name="apellido"
            placeholder="Apellido del ponente"
            value="<?php echo $ponente->apellido ?? ''; ?>"
        >
    </div>

    <div class="form__campo">
        <label for="ciudad" class="form__label">Ciudad</label>
        <input 
            type="text"
            class="form__input"
            id="ciudad"
            name="ciudad"
            placeholder="Ciudad del ponente"
            value="<?php echo $ponente->ciudad ?? ''; ?>"
        >
    </div>

    <div class="form__campo">
        <label for="pais" class="form__label">Pais</label>
        <input 
            type="text"
            class="form__input"
            id="pais"
            name="pais"
            placeholder="Pais del ponente"
            value="<?php echo $ponente->pais ?? ''; ?>"
        >
    </div>

    <div class="form__campo">
        <label for="imagen" class="form__label">Imagen</label>
        <input 
            type="file"
            class="form__input form__input--file"
            id="imagen"
            name="imagen"
        >
    </div>

    <?php if(isset($ponente->imagen_actual)) { ?>
        <p class="form__text">Imagen actual</p>
        <div class="form__image">
            <picture>
                <source srcset="<?php echo $_ENV['HOST']  . '/img/speakers/' . $ponente->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST']  . '/img/speakers/' . $ponente->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST']  . '/img/speakers/' . $ponente->imagen; ?>.png" alt="Imagen ponente">
            </picture>
        </div>
    <?php } ?>
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend"> Información extra</legend>

    <div class="form__campo">
        <label for="tags_input" class="form__label">Áreas de experiencia (separadas por coma)</label>
        <input 
            type="text"
            class="form__input"
            id="tags_input"
            placeholder="Ej. Node.js, PHP, CSS, Laravel, UX/UI"
        >
        <div id="tags" class="form__list"></div>
        <input type="hidden" name="tags"
        value="<?php echo $ponente->tags ?? ''; ?>"
        >
    </div>
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend"> Redes sociales </legend>

    <div class="form__campo">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input 
                type="text"
                class="form__input--social"
                name="redes[facebook]"
                placeholder="Facebook"
                value="<?php echo $redes->facebook ?? ''; ?>"
            >  
        </div>
    </div>

    <div class="form__campo">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input 
                type="text"
                class="form__input--social"
                name="redes[twitter]"
                placeholder="Twitter / X"
                value="<?php echo $redes->twitter ?? ''; ?>"
            >  
        </div>
    </div>

    <div class="form__campo">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input 
                type="text"
                class="form__input--social"
                name="redes[youtube]"
                placeholder="YouTube"
                value="<?php echo $redes->youtube ?? ''; ?>"
            >  
        </div>
    </div>

    <div class="form__campo">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input 
                type="text"
                class="form__input--social"
                name="redes[instagram]"
                placeholder="Instagram"
                value="<?php echo $redes->instagram ?? ''; ?>"
            >  
        </div>
    </div>

    <div class="form__campo">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input 
                type="text"
                class="form__input--social"
                name="redes[tiktok]"
                placeholder="TikTok"
                value="<?php echo $redes->tiktok ?? ''; ?>"
            >  
        </div>
    </div>

    <div class="form__campo">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-github"></i>
            </div>
            <input 
                type="text"
                class="form__input--social"
                name="redes[github]"
                placeholder="GitHub"
                value="<?php echo $redes->github ?? ''; ?>"
            >  
        </div>
    </div>
</fieldset>