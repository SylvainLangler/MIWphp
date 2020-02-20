<?php

define('HOST', 'localhost');
define('DB_NAME', 'miw');
define('USER', 'root'); // roooooot
define('PASS', '');

function getDB(){
    $bdd = false;
    try{
        $bdd = new PDO(
            'mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8',
            USER, //inversion user/pass
            PASS,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) //suppression du debug
        );
    }catch(Exception $e){
        var_dump($e);
    }
    return $bdd;
}

function p($data=null){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}
function d($data= null){
    p($data);
    die();
}