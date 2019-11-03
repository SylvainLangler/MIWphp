<?php

include 'db_connect.php';

if(isset($_POST['ville']) && isset($_POST['habitants'])){
    $req = $bdd->prepare('INSERT INTO city (name, countrycode, population)
    VALUES(:name, :countrycode, :population)');
   
   $name = $_POST['ville'];
   $countryCode = $_GET['country'];
   $population = $_POST['habitants'];
   $req->bindValue('name', $name, PDO::PARAM_STR);
   $req->bindValue('countrycode', $countryCode, PDO::PARAM_STR);
   $req->bindValue('population', $population, PDO::PARAM_INT);
   $req->execute();
   
   $req->closeCursor();
   
}

header('Location: ./country.php?country='.$_GET['country']);

?>