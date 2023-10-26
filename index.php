<?php

declare(strict_types = 1);

namespace App;

require_once "./src/Utilities/debug.php";

$action = htmlspecialchars($_GET["action"] ?? "", ENT_QUOTES, "UTF-8") ?? null;

if($action === "create"){
    include_once "./templates/pages/create.php";
} else {
    include_once "./templates/pages/list.php";
}



// php -S localhost:8080