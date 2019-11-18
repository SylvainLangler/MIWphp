<?php

class LivreController extends Controller{

    public $livres = [
        ['id'=>1, 'nom'=>'Nom du livre'],
        ['id'=>2, 'nom'=>'Nom du livre 2'],
        ['id'=>3, 'nom'=>'Nom du livre 3'],
    ];

    public function index(){
        $this->set(['livres'=>$this->livres]);

        $this->render('index');
    }

    public function detail(){

        $this->set(['livres'=>$this->livres]);

        $this->render('detail');

    }

}