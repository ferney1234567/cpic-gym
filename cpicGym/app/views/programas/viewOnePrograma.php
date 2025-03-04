<div class="view">
    <a href='/rol/index'>Roles</a>
    <a href='/actividad/index'>Actividades</a>
    <a href='/centro/index'>Centros de Formacion</a>
    <a href='/programa/index'>Programas de Formacion</a>
</div>
<div class="data-container">
    <form action="/programa/create" method="post">
        <div class="form-group">
            <?php
            echo "Codigo: " . $codigo;
            ?>
        </div>
        <div class="form-group">
            <?php
            echo "Nombre: " . $nombre;
            ?>
        </div>
        <div class="form-group">
            <?php
            echo "Centro Formacion: " . $FkIdCentroFormacion;
            ?>
        </div>
    </form>
</div>