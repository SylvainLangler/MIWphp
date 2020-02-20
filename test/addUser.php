<?php

require 'config.php';
$bdd = getDB();

if(isset($_POST['name']) && isset($_POST['email'])){
    createUser($bdd);
}

function createUser($bdd){
    $req = $bdd->prepare('INSERT INTO user (name, email,)
    VALUES(:name, :email');
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $req->bindValue('name', $name, PDO::PARAM_STR);
    $req->bindValue('email', $email, PDO::PARAM_STR);
    $req->execute();
   
    $req->closeCursor();

    header('Location: admin.php');

    // pas eu le temps de faire marcher
}

?>