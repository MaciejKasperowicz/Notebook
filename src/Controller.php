<?php

declare(strict_types = 1);

namespace App;

class Controller{
    public function run(string $action):void
    {   
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
        exit("STOP");
    }
}