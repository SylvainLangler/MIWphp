<?php
require 'config.php';//chemin d'accès
$bdd = getDB();

if (isset($_GET['id_article'])) //id au lieu de id_article
    $id = $_GET['id_article'];
else {
    header('Location: index.php');
    die();
}

$reqUser = $bdd->query('SELECT * FROM `user`');
$users = $reqUser->fetchAll(PDO::FETCH_ASSOC);

$req = $bdd->prepare('SELECT * FROM article a JOIN `user` u ON a.id_user=u.id WHERE a.id=:id');//variable passée en dur
$req->bindValue(':id', $id, PDO::PARAM_INT);
$req->execute();
$article = $req->fetch(PDO::FETCH_ASSOC);

$reqCom = $bdd->prepare('SELECT * FROM commentaire WHERE id_article=:id_article');
$reqCom->bindValue(':id_article', $id, PDO::PARAM_INT);
$reqCom->execute();
$commentaires = $reqCom->fetchAll(PDO::FETCH_ASSOC);

$origDate = $article['datetime'];
 
$newDate = date("d-m-Y H:i:s", strtotime($origDate));

if (isset($_GET['id_article'])) { ?>
    <a href="index.php">< Retour</a>
    <h1><?php echo $article['titre'] ?></h1>
    <div>Publié le <?php echo $newDate ?> par <a href="auteur.php?id_auteur=<?php echo $article['id_user'] ?>"><?php echo $article['name'] ?></a></div>
    <!-- Pour l'instant la taille de l'image de base est redimensionnée avec du style -->
    <img style="max-width:1000px;"src="./upload/src/<?php echo $article['image'] ?>">
    <div>
        <?php echo nl2br($article['contenu']) ?>
    </div>
    <h3>Commentaire(s)</h3>
    <div>
        <?php
        if (count($commentaires)) {
            foreach ($commentaires as $commentaire) {
                ?>
                <div class="commentaire">
                    <?php echo nl2br($commentaire['contenu']) ?> <!-- nl2br pour afficher les retours à la ligne -->
                </div>
                <?php
            }
        } else {
            ?>
            <div>Aucun commentaire.</div>
        <?php } ?>
    </div>
    <div>
        <form method="post" action="saveComment.php"><!-- post au lieu de get -->
            <label for="user">Utilisateur :</label>
            <select id="user" name="id_user">
                <?php foreach ($users as $user) { ?>
                    <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
                <?php } ?>
            </select></br>
            <input type="hidden" name="id_article" value="<?php echo $id ?>">
            <label for="titre">Titre :</label><input id="titre" name="titre" placeholder="Titre"><br />
            <label for="contenu">Contenu :</label><br />
            <textarea id="contenu" name="contenu" rows="3" cols="50"></textarea><br />
            <input type="submit" value="valider">
        </form>
    </div>
<?php } ?>
