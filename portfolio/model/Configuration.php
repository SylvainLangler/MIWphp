<?php

class Configuration extends Model {

    
    public static function get($cle){
        $model = parent::getInstance();
        $req = $model->bdd->prepare('SELECT * FROM configuration WHERE cle =:cle');
        $req->bindValue(':cle', $cle);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data['valeur'];
    }

}