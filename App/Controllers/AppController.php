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

        $registro = 15;
        $descolamento = 1;

        $this->view->tweets = $tweet->getAll($registro, $descolamento);
        $this->getInformacoes();
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
        $this->getInformacoes();
        $this->render('quemSeguir');
    }

    public function getInformacoes(){
        $usuario = Container::getModel("Usuario");
        $usuario->__set("id", $_SESSION['id']);
        
        $this->view->contTweets = $usuario->getTweets();
        $this->view->seguidores = $usuario->getSeguidores();
        $this->view->seguindo = $usuario->getSeguindo();
    }

    public function acao(){
        $this->VerificarAutenticacao();

        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        $usuario_seguido = isset($_GET['id']) ? $_GET['id'] : '';

        $seguidores = Container::getModel("Seguidores");
        $seguidores->__set("id_usuario", $_SESSION['id']);
        $seguidores->__set("id_seguindo", $usuario_seguido);


        switch ($acao) {
            case 'follow':
                $seguidores->Seguir();
                header("location: /quemSeguir?procurar=".$_GET['procurar']);
                break;
            case 'unfollow':
                $seguidores->DeixarDeSeguir();
                header("location: /quemSeguir?procurar=".$_GET['procurar']);
                break;
            case 'removetweet':
                $tweets = Container::getModel("Tweet");
                $tweets->__set("id", $_GET['id']);
                $tweets->__set("id_usuario", $_SESSION['id']);
                $tweets->removerTweet();

                header("location: /timeline");
                break;
            default:
                header("location: /timeline");
                break;
        }
    }

}

?>