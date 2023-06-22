<?php

namespace App\Models;

use MF\Model\Model;

class Tweet extends Model{
    private $id;
    private $id_usuario;
    private $tweet;
    private $date;

    public function __get($attr){
        return $this->$attr;
    }

    public function __set($attr1, $attr2){
        $this->$attr1 = $attr2;
    }

    public function salvar(){
        $query = 'insert into tweets(id_usuario, tweet)values(:id_usuario, :tweet);';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":id_usuario", $this->__get("id_usuario"));
        $smtm->bindValue(":tweet", $this->__get("tweet"));
        $smtm->execute();
    }

    public function getAll(){
        $query = '
            select 
                t.id, t.id_usuario, u.nome, t.tweet, t.data 
            from
                tweets as t
                left join usuarios as u on (t.id_usuario = u.id)
            where
                t.id_usuario = :id_usuario
            order by t.data desc;';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":id_usuario", $this->__get("id_usuario"));
        $smtm->execute();

        return $smtm->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>