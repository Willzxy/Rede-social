<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

use App\Connection;

class IndexController extends Action {
    public function Index(){
        $this->Render("index");
    }

    public function Inscreverse(){
        $this->Render("inscreverse");
    }

    public function Registrar(){
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        $usuario = Container::getModel("usuario");
        $usuario->__set("nome", $_POST['nome']);
        $usuario->__set("email", $_POST['email']);
        $usuario->__set("senha", $_POST['senha']);

        $usuario->salvar();
    }
}

?>