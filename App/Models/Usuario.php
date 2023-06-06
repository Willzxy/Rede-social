<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model {
    private $id;
    private $nome;
    private $senha;
    private $email;

    function __get($attr){
        return $this->$attr;
    }

    function __set($attr1, $attr2){
        $this->$attr1 = $attr2;
    }

    function Salvar(){
        $query = 'insert into usuarios(nome, email, senha)values(:nome, :email, :senha);';
        
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":nome", $this->__get('nome'));
        $smtm->bindValue(":senha", $this->__get('senha'));
        $smtm->bindValue(":email", $this->__get('email'));
        $smtm->execute();

        return $this;
    }

    function Validar(){

    }

    function
}

?>