<div class="view">
    <a href='/rol/index'>Roles</a>
    <a href='/actividad/index'>Actividades</a>
    <a href='/centro/index'>Centros de Formacion</a>
    <a href='/programa/index'>Programas de Formacion</a>
</div>
<div class="data-container">
    <?php
    echo "<a href='/centro/new' class='new'><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAABzklEQVRIS7WVPUsDQRCGd3MBDShiJ4poZSFo8AcINoIflVpoo5WINiIIVn5ibSGCIHZaCBaSQhEECxGsLNJJUMTGXlIIYvbWZ+Vicpe73CWcB1vc7Oz77M7Mzkrxz5/8Z31RFaC1bhBKTQkpR9hImtHN0Iw3RlZofS0s60JK+R200UAA4qPCtg8d0WoHfRGJxCKQWz8nX4BWahvnrRrCZ+O7Ji1rz7umAoD4Dk6bNYiXu64A2S83uACEZZywXNYpbpbZhGuQcD0UNf4AiDch/sxEW2DCLOvXn1OaRAd9OSB9xcSXAEotscIkNfDj+FEAAsAEgIwRKgEKhSvKcSwWgBDHbGbBDVDqHUN7TIAsgAEv4BNDylUBTkjCku6Tkw8ArV5AHkNzTIA8gBYvIIehJ6YQPQHo9QLOMMzEBDgFMOetolmq6CQWgNbTMpk8dwO0TnHRTJg6gyAR74G5aGnuwZcLYH64zcNAbsKqpsq8aRVDiN8Xffya3TqTu3VCljnlgasS/YSo6w3spqtGffEUvqveTloRonKY01mPsHWEnMY8OPOE5c7PL+zJbOTJnHR6VD8CXSZVjFfGI8ImXxnEC4GFUWesIy+LGuPIgl7HH8BGsBl9FV1ZAAAAAElFTkSuQmCC'/></a>";
    if (isset($Centros) && is_array($Centros)) {
        foreach ($Centros as $key => $value) {
            echo "
                        <div class='record'>
                            <span>$value->id - $value->nombre</span>
                            <div class='buttons'>
                                <a href='/centro/view/$value->id'>Consultar</a>
                                <a href='/centro/edit/$value->id'>Editar</a>
                                <a href='/centro/delete/$value->id'>Eliminar</a>
                            </div>
                        </div>";
        }
    }
    ?>
</div>