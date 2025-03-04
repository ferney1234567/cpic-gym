<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . "../models/baseModel.php";

class RolModel extends BaseModel
{
    public function __construct(
        private ?int $id = null,
        private ?string $nombre = null,
    ) {
        //Se llama al constructor del padre
        parent::__construct();
        //Se especifica la tabla
        $this->table = "rol";
    }
    public function save()
    {
        try {
            //1. Se prepara la consulta
            $sql = $this->dbConnection->prepare("INSERT INTO $this->table (nombre) VALUES (?)");
            //2. Se remplasan las variables con bindParam
            $sql->bindParam(1, $this->nombre, PDO::PARAM_STR);
            //3. Se ejecuta la consulta
            $res = $sql->execute();
            return $res;
        } catch (PDOException $ex) {
            echo "Error en consulta> " . $ex->getMessage();
        }
    }
    public function getRol()
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $this->id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            echo "Error al obtener el rol> " . $ex->getMessage();
        }
    }
    public function editRol()
    {
        try {
            $sql = "UPDATE $this->table SET nombre=:nombre WHERE id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $statement->bindParam(":id", $this->id, PDO::PARAM_INT);
            $resp = $statement->execute();
            return $resp;
        } catch (PDOException $ex) {
            echo "El no pudo ser editado " . $ex->getMessage();
        }
    }

    public function deleteRol()
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
