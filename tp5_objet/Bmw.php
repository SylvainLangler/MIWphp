<?php

class Bmw extends Vehicule{

    public function __construct()
    {
        $this->marque = "BMW";
    }

    public function reculer(){

        if($this->jauge>0){
            $this->kmParcouru++;
            $this->jauge --;
            return true;
        }
        else{
            $this->erreur .= 'Panne d\'essence!<br />';
            return false;
        }
    }

    public function avancer(){
        if($this->jauge>0){
            $this->kmParcouru += 3;
            $this->jauge -= 2;
            if(rand(0,100)<=0){
                $this->erreur .= 'Accident!<br />';
                return false;
            }
            return true;
        }
        else{
            $this->erreur .= 'Panne d\'essence!<br />';
            return false;
        }
    }

    public function faireLePlein(){
        $this->jauge = 100;
    }
}