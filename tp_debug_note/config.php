<?php

define('HOST', 'localhost');
define('DB_NAME', 'miw');
// bug -> root au lieu de rooot
define('USER', 'root');
define('PASS', '');

function getDB(){
    $bdd = false;
    try{
        $bdd = new PDO(
            'mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8',
            // bug -> USER puis PASS
            USER,
            PASS
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