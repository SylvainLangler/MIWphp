<?php

class AuteurController extends Controller{

    public function liste(){

        $auteurs = Auteur::getAll();

        $this->set(['auteurs'=>$auteurs]);

        $this->render('liste');
    }

    public function detail(){
        $id = (int)$_GET['id_auteur'];

        $auteur = new Auteur($id);

        $this->set(['auteur'=>$auteur]);

        $this->render('detail');
    }

    public function ajouter(){
        $this->render('ajouter');
    }

    public function modifier(){
        $id = (int)$_GET['id'];

        $auteur = new Auteur($id);
        
        $this->set(['auteur'=>$auteur]);

        $this->render('modifier');

    }

    public function supprimer(){
        $id = (int)$_GET['id'];
        
        $auteur = new Auteur($id);

        $auteur->delete();

        header('Location:'.ROOT.'auteur/liste');
    }

    public function post(){
        
        if(isset($_POST['nom'])){
            if(isset($_POST['id'])){
                $auteur = new Auteur($_POST['id']);
            }
            else{
                $auteur = new Auteur();
            }
            $auteur->nom = $_POST['nom'];
            $auteur->prenom = $_POST['prenom'];
            $auteur->date_naissance = $_POST['date_naissance'];

            if(isset($_POST['id'])){
                $auteur->update();
            }
            else{
                $auteur->create();
            }

            header('Location:'.ROOT.'auteur/liste');
        }
    }

    public function livres(){
        $auteur = new Auteur();
        $auteur->id = $_GET['id_auteur'];
        
        $auteur = $auteur->getAuteur();

        $livres = $auteur->getLivres();

        $this->set(['livres'=> $livres]);
        $this->set(['auteur' => $auteur]);

        $this->render('livres');
    }

}