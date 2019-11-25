<?php
/** @var Livre $livre */
?>

<a href="<?php echo ROOT ?>livre/liste">< Retour</a>

<h1><?php echo $livre->nom ?></h1>

<a href="<?php echo ROOT?>livre/modifier?id=<?php echo $_GET['id']?>">Modifier</a>


***********