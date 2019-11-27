<?php

header('Content-Type: text/xml'); 

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

$req = $bdd->prepare('SELECT * FROM categories');
$req->execute();

$fichXml = "<?xml version=\"1.0\"?>";
$fichXml .= "<categories>";
while ($donnees = $req->fetch()){
 $fichXml .= "<categorie> <id>".$donnees['codeCat']."</id><nom>".$donnees['libCat']."</nom></categorie>";
}
$fichXml .= "</categories>";

echo $fichXml;

$req->closeCursor();

?>