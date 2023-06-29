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
        $validado = true;

        if(strlen($this->__get("nome")) < 3 ){
            $validado = false;
        }
        if(strlen($this->__get("email")) < 3 ){
            $validado = false;
        }
        if(strlen($this->__get("senha")) < 5 ){
            $validado = false;
        }

        return $validado;
    }

    public function getTweets(){
        $query = 'select count(*) as tweets from tweets where id_usuario = :id;';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":id", $this->__get("id"));
        $smtm->execute();

        return $smtm->fetch(\PDO::FETCH_ASSOC);
    }

    public function getSeguindo(){
        $query = 'select count(*) as seguindo from seguidores where id_usuario = :id;';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":id", $this->__get("id"));
        $smtm->execute();

        return $smtm->fetch(\PDO::FETCH_ASSOC);
    }

    public function getSeguidores(){
        $query = 'select count(*) as seguidores from seguidores where id_seguindo = :id;';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":id", $this->__get("id"));
        $smtm->execute();

        return $smtm->fetch(\PDO::FETCH_ASSOC);
    }

    public function getUsuarios(){
        $query = '
        select 
            u.id, u.nome, u.email,
            (
            select
                count(*)
            from
                seguidores as s
            where
                s.id_usuario = :id and s.id_seguindo = u.id
            ) as seguindo
        from 
            usuarios as u
        where 
            nome like :nome and id != :id limit 8;
        ';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":nome", '%'.$this->__get("nome").'%');
        $smtm->bindValue(":id", $this->__get("id"));
        $smtm->execute();

        return $smtm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function autenticar(){
        $query = 'select id, nome, email from usuarios where email = :email and senha = :senha;';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":email", $this->__get("email"));
        $smtm->bindValue(":senha", $this->__get("senha"));
        $smtm->execute();
        $resultado = $smtm->Fetch(\PDO::FETCH_ASSOC);

        echo"<pre>";
        print_r($resultado);
        echo"</pre>";

        $this->__set("nome", $resultado['nome']);
        $this->__set("id", $resultado['id']);
    }

    public function GetUsuariosEmail(){
        $query = 'select nome, email, senha from usuarios where email = :email;';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":email", $this->__get("email"));
        $smtm->execute();

        return $smtm->FetchAll(\PDO::FETCH_ASSOC);
    }
}

?>