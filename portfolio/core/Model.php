<?php

class Model{

    private static $instance;

    public $bdd;

    public function __construct(){
        if(is_null(self::$instance)){
            $this->bdd = new PDO('mysql:dbname=portfolio;host=localhost'
                ,'root',''
                , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
        }
        else{
            $this->bdd = self::$instance->bdd;
        }
    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new Model();
        }
        return self::$instance;
    }
}