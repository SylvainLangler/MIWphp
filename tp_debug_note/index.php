<?php

require 'config.php';
$bdd = getDB();
//liste des 5 derniers articles
$res = $bdd->query('SELECT a.* FROM article a LIMIT 6');
$articles = $res->fetchAll();


?>

<table>
    <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <!-- Position de la boucle foreach -> pour chaque article on créé une ligne dans le tableau -->
    <?php foreach($articles as $article){
    // bug -> datetime au lieu de datetim
    $newDate = date("d-m-Y h:i:s", strtotime($article['datetime'])); ?>
    <!-- indentation -->
    <tr>
        <td><?php echo $article['titre'] ?></td>
        <!-- oublie date -->
        <td><?php echo $newDate ?></td>
        <td>
            <!-- Bug -> id au lieu de id_article -->
            <a href="article.php?id=<?php echo $article['id'] ?>">Lire</a>
        </td>
    </tr>
<?php } ?>
    </table>