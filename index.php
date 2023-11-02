<?php

declare(strict_types = 1);

namespace App;

use App\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;

require_once "./src/Utilities/debug.php";
require_once "./src/Controller.php";

$configuration = require_once "./config/config.php";


// error_reporting(0);
// ini_set("display_errors", "0");

$request = [
    "get" => $_GET,
    "post" => $_POST
];

try {
    
    Controller::initConfiguration($configuration);
    $controller = new Controller($request);
    $controller->run();
    // (new Controller($request))->run();
} catch(ConfigurationException $e){
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    echo "Problem z konfiguracją. Proszę skontaktować się z administratorem";
} catch(AppException $e){
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    echo "<h3> {$e->getMessage()} </h3>";
} catch (Throwable $e) {
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    deb($e);
}









// php -S localhost:8080

// CREATE TABLE `notes`.`notes` (`id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(150) NOT NULL , `description` TEXT NOT NULL , `created` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

// YylLeb5jHZHbW1/y
// CREATE USER 'user_notes'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT USAGE ON *.* TO 'user_notes'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;