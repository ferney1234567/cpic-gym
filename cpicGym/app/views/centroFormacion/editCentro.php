<div class="view">
    <a href='/rol/index'>Roles</a>
    <a href='/actividad/index'>Actividades</a>
    <a href='/centro/index'>Centros de Formacion</a>
    <a href='/programa/index'>Programas de Formacion</a>
</div>
<div class="data-container">
    <form action="/centro/update" method="post">
        <div class="form-group">
            <label for="txtId">Id</label>
            <input type="text" value="<?php echo $infoReal->id; ?>" name="txtId" id="txtId" readonly>
        </div>
        <div class="form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" value="<?php echo $infoReal->nombre; ?>" name="txtNombre" id="txtNombre">
        </div>
        <div class="form-group">
            <button type="submit">Editar</button>
        </div>
    </form>
</div>