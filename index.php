<?php

declare(strict_types = 1);

namespace App;

require_once "./src/Utilities/debug.php";
require_once "./src/View.php";

// error_reporting(0);
// ini_set("display_errors", "0");

const DEFAULT_ACTION = "list";

$action = $_GET["action"] ?? DEFAULT_ACTION;

$view = new View();

$viewParams = [];
if($action === "create"){
    $page = "create";
    $viewParams["resultCreate"] = "Udało się";
} else {
    $page = "list";
    $viewParams["resultList"] = "Wyświetlenie notatek";
}

$view->render($page, $viewParams);






// php -S localhost:8080