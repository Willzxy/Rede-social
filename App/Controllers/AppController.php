<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

use App\Connection;

class AppController extends action {
    public function timeline(){
        $this->VerificarAutenticacao();

        $tweet = Container::getModel("Tweet");
        $tweet->__set("id_usuario", $_SESSION['id']);

        $this->view->tweets = $tweet->getAll();

        $this->render("timeline");
    }

    public function tweet(){
        $this->VerificarAutenticacao();

        $tweet = Container::getModel("Tweet");
        $tweet->__set("id_usuario", $_SESSION['id']);
        $tweet->__set("tweet", $_POST['tweet']);
        $tweet->salvar();

        header("location: /timeline");
    }

    public function quemSeguir(){
        $this->VerificarAutenticacao();

        $valores = isset($_GET['procurar'])? $_GET['procurar'] : '';

        $usuarios_gerados = array();
        
        if($valores != ''){
            $usuario = Container::getModel("Usuario");
            $usuario->__set("nome", $valores);
            $usuario->__set("id", $_SESSION['id']);
            $usuarios_gerados = $usuario->getUsuarios();
        }
        
        $this->view->usuarios = $usuarios_gerados;
        $this->render('quemSeguir');
    }

    public function acao(){
        
    }

}

?>