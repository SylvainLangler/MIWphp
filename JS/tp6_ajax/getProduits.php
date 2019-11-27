<?php

try{
    $bdd = new PDO(
        // dns et dbname
        'mysql:host=localhost;dbname=langler_sylvain;charset=utf8',
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

$req = $bdd->prepare('SELECT * FROM produits WHERE codeCat = :codeCat');

$req->bindValue('codeCat', $_POST['cat']);
$req->execute();

$tabJson = array();
while ($donnees = $req->fetch()){
    array_push($tabJson, array("num" => $donnees["numPro"],
    "nom" => $donnees["libPro"])
    );
}

echo (json_encode($tabJson));

$req->closeCursor();

?>