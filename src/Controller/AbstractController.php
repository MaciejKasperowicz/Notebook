<?php

declare(strict_types = 1);

namespace App\Controller;

// require_once "./src/Exception/ConfigurationException.php";
// require_once "Database.php";
// require_once "View.php";
use App\Database;
use App\Request;
use App\View;
use App\Exception\ConfigurationException;

abstract class AbstractController {
    protected const DEFAULT_ACTION = "list";

    private static array $configuration = [];

    protected Database $database;
    protected Request $request;
    protected View $view;

    public static function initConfiguration(array $configuration):void
    {
        self::$configuration = $configuration;
    }
    

    public function __construct(Request $request){
        if(empty(self::$configuration["db"])){
            throw new ConfigurationException("Configuration error");
        }
        $this->database = new Database(self::$configuration["db"]);
        $this->request = $request;
        $this->view = new View();
        
    }

    final public function run():void
    {   
        $actionMethod = $this->action() . "Action";
        if(!method_exists($this, $actionMethod)){
            $actionMethod = self::DEFAULT_ACTION . "Action";
        } 
        $this->$actionMethod();

        // switch ($this->action()) {
        // case "create":
        //     $this->create();
        //     break;
         
        // case "show":
        //     $this->show();
        //     break;
        
        // default:
        //     $this->list();
        //     break;
        // }
    }

    private function action(): string
    {
        return $this->request->getParam("action", self::DEFAULT_ACTION);
    }

    final protected function redirect(string $to, array $params):void
    {
        $location = $to;

        if(count($params)) {
            $queryParams = [];
            foreach($params as $key => $value){
                $queryParams[] = urlencode($key) . "=" . urlencode($value);
            }
            $queryParams = implode("&", $queryParams);
            $location .= "?" . $queryParams;
        }
       
        header("Location: $location");
        exit;
    }
}