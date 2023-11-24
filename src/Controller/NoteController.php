<?php

declare(strict_types = 1);

namespace App\Controller;


// require_once "AbstractController.php";

use App\Exception\NotFoundException;



class NoteController extends AbstractController{
    private const PAGE_SIZE = 10;

    public function createAction():void
    {
        if($this->request->hasPost()){
            $noteData = [
                "title" => $this->request->postParam("title"),
                "description" => $this->request->postParam("description")
            ];
            $this->noteModel->create($noteData);
            $this->redirect("/", ["before" => "created"]);
        }
        $this->view->render("create");
    }

    public function showAction():void
    {
        $note = $this->getNote();

        $viewParams= [
            "note" => $note
        ];
        $this->view->render("show", $viewParams);
    }
    
    public function listAction():void
    {
        $phrase = $this->request->getParam("phrase");
        $pageNumber = (int) $this->request->getParam("currentpage", 1);
        $pageSize = (int) $this->request->getParam("pagesize", self::PAGE_SIZE);

        $sortBy = $this->request->getParam("sortby", "title");
        $sortOrder = $this->request->getParam("sortorder", "desc");

        if(!in_array($pageSize, [1, 5, 10, 20])){
            $pageSize = self::PAGE_SIZE;
        }

        if($phrase){
            $notes = $this->noteModel->search($phrase, $pageNumber, $pageSize, $sortBy, $sortOrder);

            $notesCount = $this->noteModel->searchCount($phrase);
        } else{
            $notes = $this->noteModel->list($pageNumber, $pageSize, $sortBy, $sortOrder);

            $notesCount = $this->noteModel->count();
        }

        

        $viewParams = [
            "page" => ["number" => $pageNumber, "size" => $pageSize, "pages" => (int) ceil($notesCount / $pageSize) ],
            "phrase" => $phrase,
            "sort" => ["by" => $sortBy,"order" => $sortOrder],
            "notes" => $notes,
            "before" => $this->request->getParam("before"),
            "error" => $this->request->getParam("error")
        ];
        $this->view->render("list", $viewParams);
    }

    public function editAction():void
    {

        if($this->request->isPost()){
            $noteId = (int) $this->request->postParam("id");
            $noteData = [
                "title" => $this->request->postParam("title"),
                "description" => $this->request->postParam("description")
            ];
            $this->noteModel->edit($noteId, $noteData);
            $this->redirect("/", ["before" => "edited"]);
        }

        $note = $this->getNote();

        $this->view->render(
            "edit",
            ["note" => $note]
        );
    }

    public function deleteAction():void
    {
        if($this->request->isPost()){
            $noteId = (int) $this->request->postParam("id");
            $this->noteModel->delete($noteId);
            $this->redirect("/", ["before" => "deleted"]);
        }

        $note = $this->getNote();

        $this->view->render(
            "delete",
            ["note" => $note]
        );
    }

    private function getNote():array
    {
        $noteId = (int) $this->request->getParam("id");
        if(!$noteId) {
            $this->redirect("/", ["error" => "missingNoteId"]);
        }

        $note = $this->noteModel->get($noteId); 
        // try {
        //     $note = $this->noteModel->getNote($noteId); 
        // } catch (NotFoundException $e) {
        //     $this->redirect("/", ["error" => "noteNotFound"]);
        // }

        return $note;
    }
}