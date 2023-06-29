<?php
namespace App\Models;

use MF\Model\Model;

class Seguidores extends Model {
    private $id;
    private $id_usuario;
    private $id_seguindo;

    function __get($attr){
        return $this->$attr;
    }

    function __set($attr1, $attr2){
        $this->$attr1 = $attr2;
    }

    public function Seguir(){
        $query = 'insert into seguidores(id_usuario, id_seguindo)values(:id_1,:id_2);';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":id_1", $this->__get("id_usuario"));
        $smtm->bindValue(":id_2", $this->__get("id_seguindo"));
        $smtm->execute();
    }

    public function DeixarDeSeguir(){
        $query = 'delete from seguidores where id_usuario = :id1 and id_seguindo = :id2;';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(":id1", $this->__get("id_usuario"));
        $smtm->bindValue(":id2", $this->__get("id_seguindo"));

        $smtm->execute();
    }
} 

?>