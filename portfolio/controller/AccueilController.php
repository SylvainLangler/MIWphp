<?php

class AccueilController extends Controller {

    public function index(){
        
        $this->set([
            'nom'=>Configuration::get('nom'),
            'prenom'=>Configuration::get('prenom')
        ]);
        
        $this->render('index');

    }
}