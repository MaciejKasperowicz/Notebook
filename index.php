<?php

declare(strict_types = 1);

namespace App;

require_once "./src/Utilities/debug.php";
require_once "./src/Controller.php";
require_once "./src/View.php";

// error_reporting(0);
// ini_set("display_errors", "0");

const DEFAULT_ACTION = "list";

$action = $_GET["action"] ?? DEFAULT_ACTION;

$controller = new Controller();
$controller->run();
$view = new View();

$viewParams = [];

switch ($action) {
    case "create":
        $page = "create";
        $created = false;
    
        //if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(!empty($_POST)){
            $created = true;
            $viewParams= [
                "title" => $_POST["title"],
                "description" => $_POST["description"]
            ];
        }
    
        $viewParams["created"] = $created;
        break;
     
    case "show":
        $viewParams= [
            "title" => "Moja notatka",
            "description" => "Opis"
        ];
        break;
    
    default:
        $page = "list";
        $viewParams["resultList"] = "Wyświetlenie notatek";
        break;
}


$view->render($page, $viewParams);






// php -S localhost:8080