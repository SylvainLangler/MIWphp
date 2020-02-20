<?php

require 'functions.php';

if(isset($_FILES['photo']) && isset($_POST['titre']) && isset($_POST['contenu']) && isset($_POST['id_user'])){
    if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
        $fichier = rand(0,100000).$_FILES['photo']['name'];
        createArticle($bdd, $fichier);
        upload($bdd, $fichier);
    }
    else{
        echo "upload failed";
    }
}

function createArticle($bdd, $fichier){
    $req = $bdd->prepare('INSERT INTO article (titre, contenu, id_user, datetime, image )
    VALUES(:titre, :contenu, :id_user,NOW(), :image)');
   
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $id_user = $_POST['id_user'];
    $image = $fichier;
    $req->bindValue('titre', $titre, PDO::PARAM_STR);
    $req->bindValue('contenu', $contenu, PDO::PARAM_STR);
    $req->bindValue('id_user', $id_user, PDO::PARAM_INT);
    $req->bindValue('image', $image, PDO::PARAM_STR);
    $req->execute();
   
    $req->closeCursor();

    header('Location: index.php');
}

?>