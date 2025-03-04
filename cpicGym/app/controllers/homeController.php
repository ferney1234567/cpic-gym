<?php
namespace App\Controller;

require_once MAIN_APP_ROUTE."../controllers/baseController.php";

class HomeController extends BaseController{
    public function __construct()
    {
        $this->layout = 'admin_layout';
    }
    //Accion 1 del controllador
    public function index(){
        echo"<br> <CONTROLLER > homeController";
        echo"<br> <a href='/rol/index'>Roles</a>";
        echo"<br> <ACTION > index";
    }

    //Accion 2 del controllador
    public function saludar(){
        echo"<CONTROLLER > homeController";
        echo"<ACTION > saludo";
    }
}
?>