<?php
class db
{
    private $db_host = "127.0.0.1";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "tax_tech";

    public function connectDb()
    {
        $conexion = "mysql:host=$this->db_host;dbname=$this->db_name";
        $db_coneccion = new PDO($conexion, $this->db_user, $this->db_pass);

        $db_coneccion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db_coneccion;
    }

    function getQueryInArray($consulta)
    {
        try {

            $db = new db();
            $db = $db->connectDb();

            $queryResponse = $db->query($consulta);

            if ($queryResponse->rowCount() > 0) {
                $clientes = $queryResponse->fetchAll(PDO::FETCH_OBJ);
                $response = $clientes;
            } else {
                $response = array();
            }

            $queryResponse = null;
            $db = null;

            return $response;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function post($consulta, $datos_agregar)
    {
        $respuesta = "";

        $sql = $consulta;
        $db = new db();
        $db = $db->connectDb();
        $stmt = $db->prepare($sql);

        try {
            $stmt->execute($datos_agregar);
            $respuesta = $db->lastInsertId();
        } catch (Exception $e) {
            $respuesta = $e;
        } finally {
            $db = null;
        }

        return $respuesta;
    }
}
