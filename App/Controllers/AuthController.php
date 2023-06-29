<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

use App\Connection;

class AuthController extends action {

    public function autenticar() {
        $validado = true;
        $usuario = Container::getModel("usuario");

        $usuario->__set("email", $_POST['email']);
        $usuario->__set("senha", md5($_POST['senha']));

        $usuario->autenticar();

        if($usuario->__get('id') == '' || $usuario->__get('nome') == '') { $validado = false; }

        if($validado){
            session_start();

            $_SESSION['id'] = $usuario->__get("id");
            $_SESSION['nome'] = $usuario->__get("nome");

            header("location: /timeline");
        }else{
            header("location: /?login=erro");
        }

    }

    public function sair(){
        session_start();
        session_destroy();
        header('location: /');
    }

}

?>