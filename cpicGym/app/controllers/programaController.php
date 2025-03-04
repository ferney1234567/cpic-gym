<?php
namespace App\Controller;
use App\Models\ProModel;
use App\Models\CenModel;

require_once MAIN_APP_ROUTE."../controllers/baseController.php";
require_once MAIN_APP_ROUTE."../models/proModel.php";
require_once MAIN_APP_ROUTE."../models/cenModel.php";

class ProgramaController extends BaseController{
    public function __construct()
    {
        $this->layout = 'admin_layout';
    }
    public function index(){
        // echo"<br>CONTROLLER> RolController";
        // echo"<br>ACTION> index";                con Ctrl + K + C
        // echo "<hr>";
        //Se crea un objeto del modelo rol
        $objPro = new ProModel();
        $programas = $objPro->getAllPrograma();
        //Llamando a la vista
        $data=[
            "programas"=> $programas,
        ];
        $this->render("programas/viewPrograma.php", $data);
        //require_once MAIN_APP_ROUTE."../views/rols/viewRol.php";
    }
    public function new()
    {
        $objPro = new CenModel();
        $centros = $objPro->getAll();
        //Llamando a la vista
        $data=[
            "centros"=> $centros,
        ];
        $this->render("programas/newPrograma.php", $data);
        // $this->render('programas/newPrograma.php');
    }

    //Guarada los datos del formulario
    public function create()
    {
        
        $codigo = $_POST['txtCodigo'] ?? null;
        $nombre = $_POST['txtNombre'] ?? null;
        $FkIdCentroFormacion = $_POST['txtFkIdCentroFormacion'] ?? null;
        if ($nombre) {
            $objAct = new ProModel(null, $codigo,$nombre, $FkIdCentroFormacion);
            $resp = $objAct->save();
            if ($resp) {
                header('Location:/programa/index');
            } else {
                header('Location:/programa/index');
            };
        }
    }

    public function view($id)
    {

        $objAct = new ProModel($id);
        $actInfo = $objAct->getPrograma();
        $data = [
            "id" => $actInfo[0]->id,
            "codigo" => $actInfo[0]->codigo,
            "nombre" => $actInfo[0]->nombre,
            "FkIdCentroFormacion" => $actInfo[0]->FkIdCentroFormacion,
        ];
        $this->render("programas/viewOnePrograma.php", $data);

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