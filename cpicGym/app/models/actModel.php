<?php
namespace App\Models;
require_once MAIN_APP_ROUTE."../models/baseModel.php";

use PDO;
use PDOException;

class ActModel extends BaseModel{
    public function __construct(
        private ?int $id = null,
        private ?string $nombre = null,
        private ?string $descripcion = null,
    ){
        //Se llama al constructor del padre
        parent::__construct();
        //Se especifica la tabla
        $this->table = "actividad";
    }
    public function save()
    {
        try {
            //1. Se prepara la consulta
            $sql = $this->dbConnection->prepare("INSERT INTO $this->table (nombre, descripcion) VALUES (:nombre, :descripcion)");
            //2. Se remplasan las variables con bindParam
            $sql->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $sql->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
            //3. Se ejecuta la consulta
            $res = $sql->execute();
            return $res;
        } catch (PDOException $ex) {
            echo "Error en consulta> " . $ex->getMessage();
        }
    }
    public function getActividad()
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $this->id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            echo "Error al obtener la actividad> " . $ex->getMessage();
        }
    }
    public function editActividad()
    {
        try {
            $sql = "UPDATE $this->table SET nombre=:nombre, descripcion=:descripcion WHERE id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
            $statement->bindParam(":id", $this->id, PDO::PARAM_INT);
            $resp = $statement->execute();
            return $resp;
        } catch (PDOException $ex) {
            echo "El no pudo ser editado " . $ex->getMessage();
        }
    }

    public function deleteActividad()
    {
        try {
            $sql = "DELETE FROM $this->table WHERE id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $this->id, PDO::PARAM_INT);
            $resp = $statement->execute();
            return $resp;
        } catch (PDOException $ex) {
            echo "El no pudo ser Eliminado " . $ex->getMessage();
        }
    }
}
?>