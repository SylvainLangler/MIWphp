<?php
/** @var Livre $livre */
?>

<a href="<?php echo ROOT ?>livre/liste">< Retour</a>

<h1>Nom: <?php echo $livre->nom ?></h1>
<h2>ISBN: <?php echo $livre->isbn ?></h2>
<h2>Résumé: <?php echo $livre->resume ?></h2>
<h2>Auteur: <?php echo $auteur['prenom'].' '.$auteur['nom'] ?></h2>
<h2>Prix: <?php echo $livre->prix ?></h2>

<a href="<?php echo ROOT?>livre/modifier?id=<?php echo $_GET['id']?>">Modifier</a>