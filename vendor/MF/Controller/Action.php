<?php

namespace MF\Controller;

abstract class Action{
    protected $view;

    public function __construct(){
        $this->view = new \stdClass();
    }

    protected function content(){
        $classe_atual = get_class($this);
        $classe_atual = str_replace("App\\Controllers\\", "", $classe_atual);
        $classe_atual = str_replace("Controller", "", $classe_atual);
        
        require_once "../App/Views/".$classe_atual."/".$this->view->page.".phtml";
    }

    protected function Render($view){
        $this->view->page = $view;
        require_once "../App/Views/layout.phtml";
    }

    protected function VerificarAutenticacao(){
        session_start();
        if(!isset($_SESSION['id']) || !isset($_SESSION['nome'])){ header("location: /"); return;}
    }
}

?>