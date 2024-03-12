<?php
class db
{

    private $db_host = "127.0.0.1";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "tax_tech";
    // 	private $db_user="apolomul_AaronRa";
    // 	private $db_pass="apolomul_AaronRa";
    // 	private $db_name="apolomul_canvaplh_app_edit_image";

    public function connectDb()
    {
        $conexion = "mysql:host=$this->db_host;dbname=$this->db_name";
        $db_coneccion = new PDO($conexion, $this->db_user, $this->db_pass);

        $db_coneccion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db_coneccion;
    }

    // function actualizar($consulta, $datos_actualizar)
    // {
    //     $respuesta = "";

    //     $sql = $consulta;
    //     $db = new db();
    //     $db = $db->conectar_db();
    //     $stmt = $db->prepare($sql);

    //     try {
    //         $stmt->execute($datos_actualizar);
    //         $respuesta = '';
    //     } catch (Exception $e) {
    //         $respuesta = $e;
    //     }

    //     return $respuesta;
    // }

    // function borrar($consulta, $datos_borrar)
    // {
    //     $respuesta = "";

    //     $sql = $consulta;
    //     $db = new db();
    //     $db = $db->conectar_db();
    //     $stmt = $db->prepare($sql);

    //     try {
    //         $stmt->execute($datos_borrar);
    //         $respuesta = '';
    //     } catch (Exception $e) {
    //         $respuesta = $e;
    //     }

    //     return $respuesta;
    // }

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

    function create($consulta, $datos_agregar)
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
        }

        return $respuesta;
    }
}
