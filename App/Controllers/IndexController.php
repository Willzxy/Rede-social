<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

use App\Connection;

class IndexController extends Action {
    public function Index(){
        session_start();

        if(isset($_SESSION['id']) || isset($_SESSION['nome'])){ header("location: /timeline"); return;}

        $this->Render("index");
    }

    public function Inscreverse(){
        $this->view->erro_envio = false;

        $this->view->nome = '';
        $this->view->email = '';
        $this->view->senha = '';

        $this->Render("inscreverse");
    }

    public function Registrar(){
        $this->view->erro_envio = false;

        $usuario = Container::getModel("usuario");
        $usuario->__set("nome", $_POST['nome']);
        $usuario->__set("email", $_POST['email']);
        $usuario->__set("senha", md5($_POST['senha']));


        if($usuario->validar()){
            $usuario->salvar();

            $_POST['email'] = $usuario->__get("email");
            $_POST['senha'] = $usuario->__get("senha");
            
            header("location: /autenticar");
        } else {
            $this->view->erro_envio = true;
            $this->view->nome = $usuario->__get("nome");
            $this->view->email = $usuario->__get("email");
            $this->view->senha = $usuario->__get("senha");

            $this->render("inscreverse");
        }
    }
}

?>