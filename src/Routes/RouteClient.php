<?php

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// Define app routes
$app->get('/listclients', function ($request, $response, $args) {
    $dni = $request->getQueryParam('dni');

    $clientController = new ClientController;
    $clients = $dni ? $clientController->readByDni($dni) : $clientController->read();

    return $response->withJson(
        array(
            "status" => true,
            "dni" => $dni,
            "data" => $clients,
        )
    );
});

$app->post('/createclient', function ($request, $response, $args) {
    $body = $request->getBody();
    $body = json_decode($body, true);

    if (!isset($body['name'])) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo name es requerido',)
        );
    }
    if (!isset($body['lastname'])) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo lastname es requerido',)
        );
    }
    if (!isset($body['years_old'])) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo years_old es requerido',)
        );
    }
    if (!isset($body['birthday'])) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo birthday es requerido',)
        );
    }
    if (!isset($body['dni'])) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo dni es requerido',)
        );
    }

    $clientController = new ClientController;

    $searchIfExist = $clientController->readByDni($body['dni']);
    if (count($searchIfExist)) {
        return $response->withJson(
            array("status" => false, "data" => 'Ya existe cliente con el dni ingresado, no se puede agregar.',)
        );
    }

    $addClient = $clientController->create($body);

    return $response->withJson(
        array(
            "status" => true,
            "addClient" => $addClient,
        )
    );
});

$app->put('/updateclient[/{dni:.*}]', function ($request, $response, $args) {
    $dni = $request->getAttribute('dni');
    $body = $request->getBody();
    $body = json_decode($body, true);

    if (!isset($body['name'])) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo name es requerido',)
        );
    }
    if (!isset($body['lastname'])) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo lastname es requerido',)
        );
    }
    if (!isset($body['years_old'])) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo years_old es requerido',)
        );
    }
    if (!isset($body['birthday'])) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo birthday es requerido',)
        );
    }
    if (!$dni) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo dni es requerido',)
        );
    }
    $body['dni'] = $dni;

    $clientController = new ClientController;

    $searchIfExist = $clientController->readByDni($dni);
    if (!count($searchIfExist)) {
        return $response->withJson(
            array("status" => false, "data" => 'No existe cliente con el dni ingresado, no se puede actualizar.',)
        );
    }

    $updateClient = $clientController->update($body);

    return $response->withJson(
        array(
            "status" => true,
            "updateClient" => $updateClient,
        )
    );
});

$app->delete('/deleteclient[/{dni:.*}]', function ($request, $response, $args) {
    $dni = $request->getAttribute('dni');
    if (!$dni) {
        return $response->withJson(
            array("status" => false, "data" => 'El campo dni es requerido',)
        );
    }

    $clientController = new ClientController;

    $searchIfExist = $clientController->readByDni($dni);
    if (!count($searchIfExist)) {
        return $response->withJson(
            array("status" => false, "data" => 'No existe cliente con el dni ingresado, no se puede eliminar.',)
        );
    }

    $deleteClient = $clientController->deleteByDni($dni);

    return $response->withJson(
        array(
            "status" => true,
            "deleteClient" => $deleteClient,
        )
    );
});
