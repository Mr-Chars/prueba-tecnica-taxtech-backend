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
            $query = "INSERT INTO client (name,lastname,years_old,birthday,dni) VALUES(?,?,?,?,?)";
            $dataToPost[0] = $body['name'];
            $dataToPost[1] =  $body['lastname'];
            $dataToPost[2] =  $body['years_old'];
            $dataToPost[3] =  $body['birthday'];
            $dataToPost[4] =  $body['dni'];
            $db = new db;
            $db = $db->post($query, $dataToPost);
            return $db;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($body)
    {
        try {
            $query = "UPDATE client SET name = ?, lastname = ?, years_old = ?, birthday = ? WHERE dni = ?";
            $dataToPost[0] = $body['name'];
            $dataToPost[1] =  $body['lastname'];
            $dataToPost[2] =  $body['years_old'];
            $dataToPost[3] =  $body['birthday'];
            $dataToPost[4] =  $body['dni'];
            $db = new db;
            $db = $db->post($query, $dataToPost);
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
            $query = "DELETE from client WHERE dni = ?";
            $dataToPost[0] = $dni;
            $db = new db;
            $db = $db->post($query, $dataToPost);
            return $db;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
