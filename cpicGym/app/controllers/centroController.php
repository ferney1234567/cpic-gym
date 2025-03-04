<?php
namespace App\Controller;
use App\Models\CenModel;

require_once MAIN_APP_ROUTE."../controllers/baseController.php";
require_once MAIN_APP_ROUTE."../models/cenModel.php";

class CentroController extends BaseController{
    public function __construct()
    {
        $this->layout = 'admin_layout';
    }
    public function index(){
        // echo"<br>CONTROLLER> RolController";
        // echo"<br>ACTION> index";                con Ctrl + K + C
        // echo "<hr>";
        //Se crea un objeto del modelo rol
        $objCen = new CenModel();
        $Centros = $objCen->getAll();
        //Llamando a la vista
        $data=[
            "Centros"=> $Centros,
        ];
        $this->render("centroFormacion/viewCentro.php", $data);
        //require_once MAIN_APP_ROUTE."../views/rols/viewRol.php";
    }
    public function new()
    {
        $this->render('centroFormacion/newCentro.php');
    }

    //Guarada los datos del formulario
    public function create()
    {
        $nombre = $_POST['txtNombre'] ?? null;
        if ($nombre) {
            $objCen = new CenModel(null, $nombre);
            $resp = $objCen->save();
            if ($resp) {
                header('Location:/centro/index');
            } else {
                header('Location:/centro/index');
            };
        }
    }

    public function view($id)
    {

        $objCen = new CenModel($id);
        $centroInfo = $objCen->getCentro();
        $data = [
            "id" => $centroInfo[0]->id,
            "nombre" => $centroInfo[0]->nombre,
        ];
        $this->render("centroFormacion/viewOneCentro.php", $data);

        // Crear el objeto rol
        // Traer la informacion de ese rol desde la base de datos
    }

    // Mostrar lo que se quiere editar 
    public function editCentro($id)
    {
        $objCen = new CenModel($id);
        $centroInfo = $objCen->getCentro();
        $data = [
            "infoReal" => $centroInfo[0],
        ];
        $this->render("centroFormacion/editCentro.php", $data);
    }

    // Se edita como tal en la BD
    public function updateCentro()
    {
        if (isset($_POST["txtId"])) {
            $id = $_POST["txtId"] ?? null;
            $nombre = $_POST["txtNombre"] ?? null;
            $rolObjEdit = new CenModel($id, $nombre);
            $res = $rolObjEdit->editCentro();
            if ($res) {
                header('Location:/centro/index');
            }else {
                header('Location:/centro/index');
            }
        }
    }

    public function deleteCentro($id)
    {
        echo $id;
        if (isset($id)) {
            $centroObjDelete = new CenModel($id);
            $res = $centroObjDelete->deleteCentro();
            print_r($res);
            if ($res) {
                header('Location:/centro/index');
            }else {
                header('Location:/centro/index');
            }
        }
    }
}
?>