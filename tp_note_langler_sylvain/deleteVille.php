<?php

include 'db_connect.php';

echo $_GET['ville'];

$deleteVille = $bdd->prepare('DELETE FROM city WHERE name= ?');
$deleteVille->execute(array($_GET['ville']));

header('Location: ./country.php?country='.$_GET['country']);

?>