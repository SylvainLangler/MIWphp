<?php

require 'functions.php';

if (isset($_GET['id_article'])) //id au lieu de id_article
    $id = $_GET['id_article'];
else {
    header('Location: index.php');
    die();
}


if(isset($_POST['titre']) && isset($_POST['contenu']) && isset($_POST['id_user'])){
    if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
        upload($bdd, $fichier);
        $fichier = rand(0,100000).$_FILES['photo']['name'];
    }
    else{
        echo "upload failed";
    }
    modifyArticle($bdd, $fichier);
}

function modifyArticle($bdd, $fichier){
    $req = $bdd->prepare('UPDATE article SET titre = :titre, contenu = :contenu, id_user = :id_user, image = :image WHERE id = :id');
   
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $id_user = $_POST['id_user'];

    // IMPORTANT 
    //
    //
    // ici il faudrait faire une requête pour récupérer l'image déjà en base, et si l'utilisateur ne rentre pas de nouvelle image, alors on remet celle qui y est déjà
    // car bug si on ne modifie pas l'image dans le formulaire de modification d'article
    //

    $image = $fichier;
    $id = $_GET['id_article'];
    $req->bindValue('titre', $titre, PDO::PARAM_STR);
    $req->bindValue('contenu', $contenu, PDO::PARAM_STR);
    $req->bindValue('id_user', $id_user, PDO::PARAM_INT);
    $req->bindValue('image', $image, PDO::PARAM_STR);
    $req->bindValue('id', $id, PDO::PARAM_INT);
    $req->execute();
   
    $req->closeCursor();

    header('Location: index.php');
}

$req = $bdd->prepare('SELECT * FROM article a JOIN `user` u ON a.id_user=u.id WHERE a.id=:id');//variable passée en dur
$req->bindValue(':id', $id, PDO::PARAM_INT);
$req->execute();
$article = $req->fetch(PDO::FETCH_ASSOC);

$reqUser = $bdd->query('SELECT * FROM `user`');
$users = $reqUser->fetchAll(PDO::FETCH_ASSOC);

?>

<h3>Modifier l'article <?php echo $_GET['id_article'] ?></h3>
<form method="post" action="modifArticle.php?id_article=<?php echo $_GET['id_article'] ?>" enctype="multipart/form-data">
    <label for="titre">Titre :</label><input id="titre" name="titre" value="<?php echo $article['titre'] ?>"><br />
    <label for="contenu">Contenu :</label><br />
    <textarea id="contenu" name="contenu" rows="3" cols="50" ><?php echo $article['contenu'] ?></textarea><br />
    <label for="user">Utilisateur :</label>
    <select id="user" name="id_user">
        <?php foreach ($users as $user) { ?>
            <option value="<?php echo $user['id'] ?>" <?php if($user['id'] == $article['id_user']) { echo "selected";} ?>><?php echo $user['name'] ?></option>
        <?php } ?>
    </select>
    <br>
    <label for="photo">Photo :</label>
    <img src="./upload/thumb/<?php echo $article['image'] ?>">
    <input type="file" name="photo">
    <br/>
    <input type="submit" value="valider">
</form>

