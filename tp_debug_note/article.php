<?php
// bug -> ./config.php au lieu de ../config.php
require './config.php';
$bdd = getDB();

if (isset($_GET['id']))
    $id = $_GET['id'];
else {
    header('Location: index.php');
    die();
}

$reqUser = $bdd->query('SELECT * FROM `user`');
$users = $reqUser->fetchAll(PDO::FETCH_ASSOC);

// bug -> pas $id dans la requête préparée et id au lieu de :id dans le bindvalue
$req = $bdd->prepare('SELECT * FROM article a JOIN `user` u ON a.id_user=u.id WHERE a.id=:id');
$req->bindValue('id', $id, PDO::PARAM_INT);
$req->execute();
$article = $req->fetch(PDO::FETCH_ASSOC);

$reqCom = $bdd->prepare('SELECT * FROM commentaire WHERE id_article=:id_article');
// bug -> id_article au lieu de :id_article dans bindvalue
$reqCom->bindValue('id_article', $id, PDO::PARAM_INT);
$reqCom->execute();
$commentaires = $reqCom->fetchAll(PDO::FETCH_ASSOC);

$origDate = $article['datetime'];
 
$newDate = date("d-m-Y H:i:s", strtotime($origDate));

// bug -> id au lieu de id_article
if (isset($_GET['id'])) { ?>
    <a href="index.php">< Retour</a>
    <h1><?php echo $article['titre'] ?></h1>
    <div>Publié le <?php echo $newDate ?> par <?php echo $article['name'] ?></div>
    <div>
        <?php echo nl2br($article['contenu']) ?>
    </div>
    <h3>Commentaire(s)</h3>
    <div>
        <?php
        // bug -> commentaires au lieu de comentaires
        if (count($commentaires)) {
            foreach ($commentaires as $commentaire) {
                ?>
                <div class="commentaire">
                    <?php 
                    // on peut ajouter d'autres informations du commentaire, il faudrait changer la requête pour pouvoir mentionner l'auteur
                    echo '<h3>'.$commentaire['titre'].'</h3>';
                    echo 'écrit le '.$commentaire['datetime'].' par l\'utilisateur d\'id: '.$commentaire['id_user'].'<br/>';
                    echo $commentaire['contenu'] ?>
                </div>
                <?php
            }
        } else {
            ?>
            <div>Aucun commentaire.</div>
        <?php } ?>
    </div>
    <div>
        <form method="get" action="saveComment.php">
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
