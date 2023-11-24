<?php

declare(strict_types = 1);

namespace App\Controller;

// require_once "./src/Exception/ConfigurationException.php";
// require_once "Database.php";
// require_once "View.php";
use App\Model\NoteModel;
use App\Request;
use App\View;
use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use App\Exception\NotFoundException;

abstract class AbstractController {
    protected const DEFAULT_ACTION = "list";

    private static array $configuration = [];

    protected NoteModel $noteModel;
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
        $this->noteModel = new NoteModel(self::$configuration["db"]);
        $this->request = $request;
        $this->view = new View();
        
    }

    final public function run():void
    {   
        try {
            $actionMethod = $this->action() . "Action";
            if(!method_exists($this, $actionMethod)){
                $actionMethod = self::DEFAULT_ACTION . "Action";
            } 
            //throw new StorageException("Testowy błąd");
            $this->$actionMethod();
        } catch (StorageException $e) {
            $this->view->render("error",["message" => $e->getMessage()]);
        } catch (NotFoundException $e) {
            $this->redirect("/", ["error" => "noteNotFound"]);
        }


        

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