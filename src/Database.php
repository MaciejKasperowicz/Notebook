<?php

declare(strict_types = 1);

namespace App;

require_once("Exception/StorageException.php");
require_once("Exception/ConfigurationException.php");

use App\Exception\StorageException;
use App\Exception\ConfigurationException;
use Throwable;
use PDO;
use PDOException;

class Database {
    public function __construct(array $config){
        
        try {

            $this->validateConfig($config);
            $dsn = "mysql:dbname={$config['database']};host={$config['host']}";

            
            $connection = new PDO($dsn, $config["user"], $config["password"]);
            deb($connection);
            
        } catch (PDOExecption $e) {
            throw new StorageException("Connection error");
        }
    }
    private function validateConfig(array $config):void
        {
            if(
                empty($config["database"])
                || empty($config["host"])
                || empty($config["user"])
                || empty($config["password"])
            ) {
                throw new ConfigurationException("Storage configuration error");
            }
        }
}