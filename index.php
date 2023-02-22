<?php
require "Controllers/BaseController.php";
require "Database/DbConnect.php";	
require "Models/IAction.php";
require "Models/BaseModel.php";

$controllerName = ucfirst((strtolower($_REQUEST['controller']) ?? 'Welcome') . 'Controller');
$actionName = strtolower($_REQUEST['action'] ?? 'index');
// echo $controllerName;

require_once "Controllers/${controllerName}.php";

$controllerObject = new $controllerName();

$controllerObject->$actionName();
?>


