<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . "../models/baseModel.php";

class ProModel extends BaseModel
{
    public function __construct(
        private ?int $id = null,
        private ?string $codigo = null,
        private ?string $nombre = null,
        private ?string $FkIdCentroFormacion = null,
    ) {
        //Se llama al constructor del padre
        parent::__construct();
        //Se especifica la tabla
        $this->table = "programaformacion";
    }
    public function save()
    {
        try {
            //1. Se prepara la consulta
            $sql = $this->dbConnection->prepare("INSERT INTO $this->table (codigo, nombre, FkIdCentroFormacion) VALUES (:codigo, :nombre, :FkIdCentroFormacion)");
            //2. Se remplasan las variables con bindParam
            $sql->bindParam(":codigo", $this->codigo, PDO::PARAM_STR);
            $sql->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $sql->bindParam(":FkIdCentroFormacion", $this->FkIdCentroFormacion, PDO::PARAM_STR);
            //3. Se ejecuta la consulta
            $res = $sql->execute();
            return $res;
        } catch (PDOException $ex) {
            echo "Error en consulta> " . $ex->getMessage();
        }
    }

    public function getAllPrograma()
    {
        try {
            $sql = "SELECT programaformacion.*, centroformacion.nombre AS nombreCentro FROM programaformacion
                    INNER JOIN centroformacion
                    ON programaformacion.FkIdCentroFormacion = centroformacion.id";
            $statement = $this->dbConnection->query($sql);
            //Obtenemos los datos en un array asociativo
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }
    public function getPrograma()
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
