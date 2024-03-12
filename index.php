<?php
require 'vendor/autoload.php';
// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
]];
$app = new \Slim\App($config);

require_once('src/mysql.php');   //Consultas con PDO
require_once('src/Routes/RouteClient.php');   //Consultas con PDO
require_once('src/Controllers/ClientController.php');   //Consultas con PDO


// Run app
$app->run();
