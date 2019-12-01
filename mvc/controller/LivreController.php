<?php

class LivreController extends Controller{

    public function liste(){

        $livres = Livre::getAll();

        $this->set(['livres'=>$livres]);

        $this->render('liste');
    }

    public function detail(){
        $id = (int)$_GET['id'];

        $livre = new Livre($id);

        $auteur = $livre->getAuteur();

        $this->set(['livre'=>$livre]);
        $this->set(['auteur'=>$auteur]);

        $this->render('detail');
    }

    public function ajouter(){
        $auteurs = Auteur::getAll();
        $this->set(['auteurs'=>$auteurs]);
        $this->render('ajouter');
    }

    public function modifier(){
        $id = (int)$_GET['id'];

        $livre = new Livre($id);
        $auteurs = Auteur::getAll();

        $this->set(['livre'=>$livre]);
        $this->set(['auteurs'=>$auteurs]);

        $this->render('modifier');

    }

    public function supprimer(){
        $id = (int)$_GET['id'];
        
        $livre = new Livre($id);

        $livre->delete();

        header('Location:'.ROOT.'livre/liste');
    }

    public function post(){
        
        if(isset($_POST['nom'])){
            if(isset($_POST['id'])){
                $livre = new Livre($_POST['id']);
            }
            else{
                $livre = new Livre();
            }
            $livre->nom = $_POST['nom'];
            $livre->auteur = $_POST['auteur'];
            $livre->resume = $_POST['resume'];
            $livre->isbn = $_POST['ISBN'];
            $livre->prix = $_POST['prix'];

            if(isset($_POST['id'])){
                $livre->update();
            }
            else{
                $livre->create();
            }

            header('Location:'.ROOT.'livre/liste');
        }
    }

}