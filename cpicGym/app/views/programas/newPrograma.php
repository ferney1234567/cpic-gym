<div class="view">
    <a href='/rol/index'>Roles</a>
    <a href='/actividad/index'>Actividades</a>
    <a href='/centro/index'>Centros de Formacion</a>
    <a href='/programa/index'>Programas de Formacion</a>
</div>
<div class="data-container">
    <form action="/programa/create" method="post">
        <div class="form-group">
            <label for="txtCodigo">codigo</label>
            <input type="text" name="txtCodigo" id="txtCodigo">
        </div>
        <div class="form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" name="txtNombre" id="txtNombre">
        </div>
        <div class="form-group">
            <label for="txtFkIdCentroFormacion">Centro Formacion</label>
            <select name='txtFkIdCentroFormacion'>
                <?php
                if (isset($centros) && is_array($centros)) {
                    foreach ($centros as $key => $value) {
                        echo "
                                    <option value='$value->id'>$value->nombre</option>
                                    ";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit">Crear</button>
        </div>
    </form>
</div>
