<fieldset class="form__fieldset">
    <legend class="form__legend">Información del evento</legend>
    <div class="form__campo">
        <label for="nombre" class="form__label">Nombre evento</label>
        <input 
            type="text"
            class="form__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre ponente"
            value="<?php echo $evento->nombre ?? ''; ?>"
        >
    </div> 

    <div class="form__campo">
        <label for="descripcion" class="form__label">Descripción del evento</label>
        <textarea
            class="form__input"
            id="descripcion"
            name="descripcion"
            placeholder="Escribe la descripción del evento"
            rows="8"
        ><?php echo $evento->descripcion ?? ''; ?></textarea>
    </div>

    <div class="form__campo">
        <label for="ciudad" class="form__label">Categoria</label>
        <select
            class="form__select"
            id="categoria"
            name="categoria_id"
        >
            <?php foreach($categorias as $categoria){ ?>
                <option <?php echo ($evento->categoria_id === $categoria->id) ? 'selected' : ''?> value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form__campo">
        <label for="pais" class="form__label">Selecciona el dia</label>
        <div class="form__radio">
            <?php foreach($dias as $dia) { ?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>
                    <input 
                        type="radio" 
                        id="<?php echo strtolower($dia->nombre); ?>"
                        name="dia"
                        value="<?php echo $dia->id; ?>"
                    >
                </div>
            <?php } ?>
        </div>
        <input type="hidden" name="dia_id" value="">
    </div>

    <div id="hours" class="form__campo">
        <label for="horas" class="form__label">Seleccionar hora</label>

        <ul class="horas" id="horas">
            <?php foreach($horas as $hora){ ?>
                <li data-hora-id="<?php echo $hora->id; ?>" class="horas__hora horas__hora--disabled"><?php echo $hora->hora; ?></li>
            <?php } ?>
        </ul>
        <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id; ?>">
    </div>
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Información extra</legend>

    <div class="form__campo">
        <label for="ponentes" class="form__label">Ponente</label>
        <input 
            type="text"
            class="form__input"
            id="ponentes"
            placeholder="Buscar Ponente"
        >
        <ul class="listado-ponentes" id="listado-ponentes"></ul>
    </div>
    <div class="form__campo">
        <label for="disponibles" class="form__label">Lugares disponibles</label>
        <input 
            type="number"
            min="1"
            class="form__input"
            id="disponibles"
            name="disponibles"
            placeholder="Ej. 20"
            value="<?php echo $evento->disponibles; ?>"
        >
    </div>
</fieldset>
