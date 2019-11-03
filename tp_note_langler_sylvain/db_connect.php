<?php

try{
    $bdd = new PDO(
        // dns et dbname
        'mysql:host=localhost;dbname=miw_world;charset=utf8',
        // user
        'root',
        // mdp
        '',
        // options supplémentaires
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)
    );
}
catch(PDOException $e){
    die('Erreur: '.$e->getMessage());
}

?>