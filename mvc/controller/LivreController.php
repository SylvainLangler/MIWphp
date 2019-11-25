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

        $this->set(['livre'=>$livre]);
        $this->render('detail');
    }

    public function ajouter(){
        $this->render('ajouter');

        
    }

    public function modifier(){
        $this->render('modifier');

    }

    public function post(){
        if(isset($_POST['nom'])){
            $livre = new Livre();
            $livre->nom = $_POST['nom'];
            $livre->auteur = $_POST['auteur'];
            $livre->resume = $_POST['resume'];
            $livre->isbn = $_POST['ISBN'];
            $livre->prix = $_POST['prix'];

            $livre->create();

            header('Location:'.ROOT.'/livre/liste');
        }
    }

}