<?php

include 'db_connect.php';
if(isset($_FILES['photo'])){
    if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
        upload($bdd);
        $message = "upload réussi";
    }
}
else{
    echo "$_FILES empty";
}

header('Location: ./country.php?country='.$_GET['country'].'&Message='.$message);

function upload($bdd){

    $dossier = './upload/src/';
    
    $type = explode("/", $_FILES['photo']['type']);

    $fichier = getImageName($bdd).'.'.$type[1];
    if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichier)){
        
        addImageToDatabase($bdd);
        
    }else{
        echo 'echec de l\'upload.';
    }
}

function getImageName($bdd){
    $maxIdImageQuery = $bdd->query('SELECT max(id) FROM gallery');
    $maxIdImage = $maxIdImageQuery->fetch()[0];
    if($maxIdImage != NULL){
        return $maxIdImage +1;
    }
    else{
        return 1;
    }
}

function addImageToDatabase($bdd){
    $addImageQuery = $bdd->prepare('INSERT into gallery (countrycode, name, description)
    VALUES(:countrycode, :name, :description) ');

    $countrycode = $_GET['country'];
    $name = $_POST['nom'];
    $description = $_POST['description'];

    $addImageQuery->bindValue('countrycode', $countrycode, PDO::PARAM_STR);
    $addImageQuery->bindValue('name', $name, PDO::PARAM_STR);
    $addImageQuery->bindValue('description', $description, PDO::PARAM_STR);

    $addImageQuery->execute();
    $addImageQuery->closeCursor();

}

?>