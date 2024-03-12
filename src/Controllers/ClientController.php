<?php

class ClientController
{
    public function readByDni($dni)
    {
        try {
            $db = new db;
            $db = $db->getQueryInArray('SELECT * FROM client where dni=' . $dni);
            return $db;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function read()
    {
        try {
            $db = new db;
            $db = $db->getQueryInArray('SELECT * FROM client');
            return $db;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create($body)
    {
        try {
            $consulta_up1 = "INSERT INTO client (name,lastname,years_old,birthday,dni) VALUES(?,?,?,?,?)";
            $datos_agregar1[0] = $body['name'];
            $datos_agregar1[1] =  $body['lastname'];
            $datos_agregar1[2] =  $body['years_old'];
            $datos_agregar1[3] =  $body['birthday'];
            $datos_agregar1[4] =  $body['dni'];
            $db = new db;
            $db = $db->create($consulta_up1, $datos_agregar1);
            return $db;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($body)
    {
        try {
            $consulta_up1 = "UPDATE client SET name = ?, lastname = ?, years_old = ?, birthday = ? WHERE dni = ?";
            $datos_agregar1[0] = $body['name'];
            $datos_agregar1[1] =  $body['lastname'];
            $datos_agregar1[2] =  $body['years_old'];
            $datos_agregar1[3] =  $body['birthday'];
            $datos_agregar1[4] =  $body['dni'];
            $db = new db;
            $db = $db->create($consulta_up1, $datos_agregar1);
            return $db;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function deleteByDni($dni)
    {
        if (!$dni) {
            return;
        }
        try {
            $consulta_up1 = "DELETE from client WHERE dni = ?";
            $datos_agregar1[0] = $dni;
            $db = new db;
            $db = $db->create($consulta_up1, $datos_agregar1);
            return $db;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
