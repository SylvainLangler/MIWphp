<?php

class ProjetController extends Controller{

    public function projetCard(){
        $this->layout = '';
        $projet = new Projet(1);
        $this->set(['projet'=>$projet]);
        $this->render('projetCard');
    }

}