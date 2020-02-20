<?php

require 'config.php';
$bdd = getDB();
//liste des 5 derniers articles
$res = $bdd->query('SELECT a.* FROM article a LIMIT 5'); // limit 5
$articles = $res->fetchAll();

$reqUser = $bdd->query('SELECT * FROM `user`');
$users = $reqUser->fetchAll(PDO::FETCH_ASSOC);


?>
<!-- table à l'extérieur de la boucle -->
    <table>
    <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>Miniature</th>
        <th colspan='2'>Action</th>
    </tr>
<?php foreach($articles as $article){ ?>
<?php $origDate = $article['datetime'];
 
 $newDate = date("d-m-Y H:i:s", strtotime($origDate)); //format date : H au lieu de h (format 24/12h)
 ?>
        <tr>
            <td><?php echo $article['titre'] ?></td>
            <td><?php echo $newDate ?></td><!-- supression du echo -->
            <td><img src="./upload/thumb/<?php echo $article['image'] ?>"></td>
            <td>
                <a href="article.php?id_article=<?php echo $article['id'] ?>">Lire</a>
            </td>
            <td><a href="modifArticle.php?id_article=<?php echo $article['id'] ?>"><button type='button'>Modifier</button></a></td>
        </tr>
<?php } ?>
    </table>
    <h3 style="margin-top:50px;">Ajouter un article</h3>
    <form method="post" action="createArticle.php" enctype="multipart/form-data">
        <label for="titre">Titre :</label><input id="titre" name="titre" placeholder="Titre"><br />
        <label for="contenu">Contenu :</label><br />
        <textarea id="contenu" name="contenu" rows="3" cols="50"></textarea><br />
        <label for="user">Utilisateur :</label>
        <select id="user" name="id_user">
            <?php foreach ($users as $user) { ?>
                <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="photo">Photo :</label>
        <input type="file" name="photo">
        <br/>
        <input type="submit" value="valider">
    </form>