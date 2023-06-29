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

    public function removerTweet(){
        $query = 'delete from tweets where id = :id1 and id_usuario = :id2;';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":id1", $this->__get("id"));
        $smtm->bindValue(":id2", $this->__get("id_usuario"));

        $smtm->execute();
    }

    public function getAll($registro, $deslocamento){
        $query = "
        select 
            t.id, t.id_usuario, u.nome, t.tweet, t.data 
        from
           tweets as t
        left join usuarios as u on (t.id_usuario = u.id)
        where
           t.id_usuario = :id_usuario or t.id_usuario in ( select id_seguindo from seguidores where id_usuario = :id_usuario )
        order by t.data desc 
        limit 
            $registro
        offset
            $deslocamento;";

        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":id_usuario", $this->__get("id_usuario"));
        $smtm->execute();

        return $smtm->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>