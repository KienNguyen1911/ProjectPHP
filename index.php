<?php
session_start();
require_once "Models/IAction.php";
require_once "Controllers/BaseController.php";
require_once "Models/BaseModel.php";
require_once "Database/DbConnect.php";	

$controllerName = ucfirst((strtolower($_REQUEST['controller']) ?? 'Welcome') . 'Controller');
$actionName = strtolower($_REQUEST['action'] ?? 'index');
// echo $controllerName;

require_once "Controllers/${controllerName}.php";

$controllerObject = new $controllerName();

$controllerObject->$actionName();
?>


