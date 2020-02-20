<?php

require 'config.php';
$bdd = getDB();

$reqUser = $bdd->prepare('SELECT * FROM `user` WHERE id=:id');
$id = $_GET['id_auteur'];
$reqUser->bindValue(':id', $id);
$reqUser->execute();

$auteur = $reqUser->fetchAll(PDO::FETCH_ASSOC);

$reqArticles = $bdd->prepare('SELECT * FROM article a  WHERE a.id_user = :id');
$reqArticles->bindValue(':id', $id);
$reqArticles->execute();

$reqComments = $bdd->prepare('SELECT * FROM commentaire c  WHERE c.id_user = :id');
$reqComments->bindValue(':id', $id);
$reqComments->execute();

// join commentaire c on a.id_user = c.id_user


$articles = $reqArticles->fetchAll(PDO::FETCH_ASSOC);
$commentaires = $reqComments->fetchAll(PDO::FETCH_ASSOC);



echo $auteur[0]['name'].'<br/>'.$auteur[0]['email'].'<br/>';

foreach($articles as $article){ 
    echo $article['titre'].'<br/>Commentaires:<br/>';
}

foreach($commentaires as $commentaire){ 
    echo $commentaire['titre'].'<br/>'.$commentaire['contenu'].'<br/><br/>';
}

// il faudrait faire mieux et mettre les commentaires de chaque article mais pas le temps


?>