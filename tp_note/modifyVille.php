<?php

include 'db_connect.php';

if(isset($_POST['ville'])){
    $req = $bdd->prepare('UPDATE city SET name = :name, population = :population WHERE id = :idVille');
   
    $name = $_POST['ville'];
    //$countryCode = $_GET['country'];
    $population = $_POST['habitants'];
    $idVille = $_POST['id'];

    $req->bindValue('name', $name, PDO::PARAM_STR);
    $req->bindValue('idVille', $idVille, PDO::PARAM_INT);
    //$req->bindValue('countrycode', $countryCode, PDO::PARAM_STR);
    $req->bindValue('population', $population, PDO::PARAM_INT);
    $req->execute();

    $countryCodeQuery = $bdd->prepare('SELECT countrycode FROM city WHERE id = ?');
    $countryCodeQuery->execute(array($idVille));

    $countryCode = $countryCodeQuery->fetch()['countrycode'];
    
    $countryCodeQuery->closeCursor();
}

    header('Location: ./country.php?country='.$countryCode);

?>