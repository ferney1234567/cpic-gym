<?php
namespace App\Controller;
use App\Models\ActModel;

require_once MAIN_APP_ROUTE."../controllers/baseController.php";
require_once MAIN_APP_ROUTE."../models/actModel.php";

class ActividadController extends BaseController{
    public function __construct()
    {
        $this->layout = 'admin_layout';
    }
    public function index(){
        // echo"<br>CONTROLLER> RolController";
        // echo"<br>ACTION> index";                con Ctrl + K + C
        // echo "<hr>";
        //Se crea un objeto del modelo rol
        $objAct = new ActModel();
        $actividades = $objAct->getAll();
        //Llamando a la vista
        $data=[
            "actividades"=> $actividades,
        ];
        $this->render("actividades/viewActividad.php", $data);
        //require_once MAIN_APP_ROUTE."../views/rols/viewRol.php";
    }
    //Muestra un formulario para el new rol
    public function new()
    {
        $this->render('actividades/newActividad.php');
    }

    //Guarada los datos del formulario
    public function create()
    {
        $nombre = $_POST['txtNombre'] ?? null;
        $descripcion = $_POST['txtDescripcion'] ?? null;
        if ($nombre) {
            $objAct = new ActModel(null, $nombre, $descripcion);
            $resp = $objAct->save();
            if ($resp) {
                header('Location:/actividad/index');
            } else {
                header('Location:/actividad/index');
            };
        }
    }

    public function view($id)
    {

        $objAct = new ActModel($id);
        $actInfo = $objAct->getActividad();
        $data = [
            "id" => $actInfo[0]->id,
            "nombre" => $actInfo[0]->nombre,
            "descripcion" => $actInfo[0]->descripcion,
        ];
        $this->render("actividades/viewOneActividad.php", $data);

        // Crear el objeto rol
        // Traer la informacion de ese rol desde la base de datos
    }

    // Mostrar lo que se quiere editar 
    public function editActividad($id)
    {
        $objAct = new ActModel($id);
        $actividadInfo = $objAct->getActividad();
        $data = [
            "infoReal" => $actividadInfo[0],
        ];
        $this->render("actividades/editActividad.php", $data);
    }

    // Se edita como tal en la BD
    public function updateActividad()
    {
        if (isset($_POST["txtId"])) {
            $id = $_POST["txtId"] ?? null;
            $nombre = $_POST["txtNombre"] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $actividadObjEdit = new ActModel($id, $nombre, $descripcion);
            $res = $actividadObjEdit->editActividad();
            if ($res) {
                header('Location:/actividad/index');
            }else {
                header('Location:/actividad/index');
            }
        }
    }

    public function deleteActividad($id)
    {
        echo $id;
        if (isset($id)) {
            $actividadObjDelete = new ActModel($id);
            $res = $actividadObjDelete->deleteActividad();
            print_r($res);
            if ($res) {
                header('Location:/actividad/index');
            }else {
                header('Location:/actividad/index');
            }
        }
    }
}
?>