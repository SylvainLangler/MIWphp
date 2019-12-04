<?php

try{
    $bdd = new PDO(
        // dns et dbname
        'mysql:host=localhost;dbname=bVilles;charset=utf8',
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

$req = $bdd->prepare("SELECT nom FROM villes WHERE nom LIKE :debut ");

$req->bindValue('debut', $_POST['debut'].'%');
$req->execute();

$tabJson = array();
while ($donnees = $req->fetch()){
    array_push($tabJson, array("nom" => $donnees["nom"])
    );
}

echo (json_encode($tabJson));

$req->closeCursor();

?>