<?php
require 'vendor/autoload.php';
// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
]];
$app = new \Slim\App($config);

require_once('src/mysql.php');   // database config
require_once('src/Routes/RouteClient.php');   // routes client
require_once('src/Controllers/ClientController.php');   // controller client

// Run app
$app->run();
