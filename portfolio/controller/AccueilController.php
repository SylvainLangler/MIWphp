<?php

class AccueilController extends Controller {

    public function index(){
        
        $this->set([
            'nom'=>Configuration::get('nom'),
            'prenom'=>Configuration::get('prenom'),
            'job'=>utf8_encode(Configuration::get('job'))
        ]);

        $this->render('index');

    }
}