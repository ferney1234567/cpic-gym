<div class="view">
    <a href='/rol/index'>Roles</a>
    <a href='/actividad/index'>Actividades</a>
    <a href='/centro/index'>Centros de Formacion</a>
    <a href='/programa/index'>Programas de Formacion</a>
</div>
<div class="data-container">
    <form action="/rol/create" method="post">
        <div class="form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" name="txtNombre" id="txtNombre">
        </div>
        <div class="form-group">
            <button type="submit">Crear</button>
        </div>
    </form>
</div>