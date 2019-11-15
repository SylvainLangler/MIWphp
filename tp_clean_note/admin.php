<?php

require 'config.php';
$bdd = getDB();

$reqUser = $bdd->query('SELECT * FROM `user`');
$users = $reqUser->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Email</th>
        <th colspan='2'>Action</th>
    </tr>
<?php foreach($users as $user){ ?>
        <tr>
            <td><?php echo $user['id'] ?></td>
            <td><?php echo $user['name'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <!-- pas le temps -->
            <td><a href="modifUser.php?id="><button type='button'>Modifier</button></a></td>
            <td><a href="modifUser.php?id="><button type='button'>Supprimer</button></a></td>
        </tr>
<?php } ?>
    </table>

    <h3>Ajouter un utilisateur</h3>
    <form method="post" action="addUser.php">
        <label for="name">Name :</label><input id="name" name="name" placeholder="name"><br />
        <label for="email">Email :</label><br />
        <input id="email" name="email" placeholder="email">
        <input type="submit" value="valider">
    </form>
