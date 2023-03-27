<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
session_start();
include_once("util.php");
include_once("Config.php");
include_once("db-files/db-lehrer.php");
include_once("db-files/db-lehrer-fach-klasse.php");
include_once("db-files/db-schueler.php");
include_once("db-files/db-klasse-schueler.php");
include_once("db-files/db-fach.php");
include_once("db-files/db-klasse.php");
include_once("Controller.php");
include_once("rest.php");
include_once("DatabaseController.php");
include_once("Entity.php");
include_once("Fach.php");
include_once("Person.php");
include_once("Lehrer.php");
include_once("Klasse.php");


// Get requested method
$method = $_SERVER['REQUEST_METHOD'];

// Read post, put, delete data from client
$dataFromClient = json_decode(file_get_contents('php://input'));

// Read get data from client
foreach ($_GET as $pname => $pvalue) {
    if (!$dataFromClient) $dataFromClient = new stdClass();
    $dataFromClient->$pname = $pvalue;
}

//if (!$dataFromClient) $dataFromClient = new stdClass();
if (!isset($dataFromClient->id)) $dataFromClient->id = null;

// Run controller
$controller = new Controller();
$dataToClient = $controller->controller($method, $dataFromClient->ressource, $dataFromClient->id, $dataFromClient);

// Send response to client
rest::sendStatusAndData($dataToClient['status'], $dataToClient['data']);

?>