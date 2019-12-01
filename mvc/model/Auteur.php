<?php

class Auteur extends Model {
    public $id;
    public $nom;
    public $prenom;
    public $date_naissance;

    public function __construct($id=null){
        parent::__construct();
        if(!is_null($id)){
            $req = $this->bdd->prepare('SELECT * FROM auteur WHERE id=:id');
            $req->bindValue(':id', $id);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            $this->id = $data['id'];
            $this->nom = $data['nom'];
            $this->prenom = $data['prenom'];
            $this->date_naissance = $data['date_naissance'];
        }
    }

    public function create(){
        $req = $this->bdd->prepare('INSERT INTO auteur (nom, prenom, date_naissance) VALUE (:nom, :prenom, :date_naissance)');
        $req->bindValue(':nom', $this->nom);
        $req->bindValue(':prenom', $this->prenom);
        $req->bindValue(':date_naissance', $this->date_naissance);
        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }

    public function update(){
        $req = $this->bdd->prepare('UPDATE auteur SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance WHERE id =:id');
        $req->bindValue(':nom', $this->nom);
        $req->bindValue(':prenom', $this->prenom);
        $req->bindValue(':date_naissance', $this->date_naissance);
        $req->bindValue(':id', $this->id);
        $req->execute();
    }

    public function delete(){
        $req = $this->bdd->prepare('DELETE FROM auteur WHERE id = :id');
        $req->bindValue(':id', $this->id);
        $req->execute();
    }

    public static function getAll(){
        $model = parent::getInstance();
        $req = $model->bdd->query('SELECT * FROM auteur');
        $auteurs = $req->fetchAll();

        return $auteurs;
    }

    public function getLivres(){
        $req = $this->bdd->prepare('SELECT * FROM livre WHERE id_auteur = :id_auteur');
        $req->bindValue(':id_auteur', $this->id);
        $req->execute();
        $livres = $req->fetchAll();

        return $livres;
    }

    // Cette fonction permet de récupérer les infos d'un auteur à partir de son id
    // Je ne pense pas sûr qu'elle soit vraiment logique dans cette architecture MVC mais elle me permet
    // de récupérer les infos de l'auteur d'id 1 sur la page /auteur/livres?id_auteur=1
    public function getAuteur(){
        $req = $this->bdd->prepare('SELECT * FROM auteur WHERE id = :id_auteur');
        $req->bindValue(':id_auteur', $this->id);
        $req->execute();
        $auteurInfos = $req->fetchAll();

        $auteur = new Auteur();
        $auteur->id = $this->id;
        $auteur->nom = $auteurInfos[0]['nom'];
        $auteur->prenom = $auteurInfos[0]['prenom'];
        $auteur->date_naissance = $auteurInfos[0]['date_naissance'];

        return $auteur;
    }

}