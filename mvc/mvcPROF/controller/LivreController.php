<?php

class LivreController extends Controller{
    //public $layout = 'livre-layout';

    public function liste(){
        // @todo récupérer tout les livres en base
        $livres = [];

        $this->set(['livres'=>$livres]);
        $this->render('liste');
    }

    public function listeJson(){
        $this->layout = '';
        $livres = [
            ['id'=>1, 'nom'=>'Nom du livre'],
            ['id'=>2, 'nom'=>'Nom du livre 2'],
            ['id'=>3, 'nom'=>'Nom du livre 3'],
        ];

        $this->set(['livres'=>$livres]);
        $this->render('listeJson');
    }

    public function detail(){
        $id = (int)$_GET['id'];

        $livre = new Livre($id);

        $this->set(['livre'=>$livre]);
        $this->render('detail');
    }

    public function livreRandom(){
        $this->layout = '';
        $livre = new Livre(1);
        $this->set(['livre'=>$livre]);
        $this->render('livreRandom');
    }

    public function ajouter_modifier(){
        // @todo afficher formulaire pour ajouter ou modifier un livre */
    }

    public function post(){
        // @todo méthod qui traite le formulaire : ajout ou modification */
        //rediriger vers livre/liste
    }
}