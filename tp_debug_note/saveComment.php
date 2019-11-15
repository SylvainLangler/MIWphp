<?php
require 'config.php';
$bdd = getDB();
// bug -> :titre au lieu de :tittre et bindValue au lieu de bindValues
// $_GET au lieu de $_POST car form method = get
$req = $bdd->prepare('INSERT INTO commentaire (titre, contenu, id_user, id_article, datetime) 
        VALUES (:titre, :contenu, :id_user,:id_article,NOW())');
$req->bindValue('titre', $_GET['titre']);
$req->bindValue('contenu', $_GET['contenu']);
$req->bindValue('id_user', $_GET['id_user']);
$req->bindValue('id_article', $_GET['id_article']);
$req->execute();

header('Location: article.php?id_article='.(int)$_GET['id_article']);