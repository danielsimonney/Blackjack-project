<?php

//c'est ici le rooter ou l'on va aller dés qu'une nouvelle URL sera entrée et qui va définir l'action a utilisé dans le controlleur


require_once("../src/autoload.php");
session_start();

// $debug = $_GET["debug"] ?? false;
// if ($debug){
//     var_dump($_SESSION);
//     die("newPage");
// }

$controller_query = $_GET["controller"] ?? "index";
$action = $_GET["action"] ?? "home";

$controllerName = "\Controllers\\".ucfirst($controller_query)."Controller";

$controller = new $controllerName;

$controller->$action();