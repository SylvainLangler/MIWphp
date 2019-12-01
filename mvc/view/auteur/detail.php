<?php
/** @var Auteur $auteur */
?>

<a href="<?php echo ROOT ?>auteur/liste">< Retour</a>

<h1>Nom: <?php echo $auteur->nom ?></h1>
<h1>Prenom: <?php echo $auteur->prenom ?></h2>
<h2>Date de naissance: <?php echo $auteur->date_naissance ?></h2>

<a href="<?php echo ROOT?>auteur/modifier?id=<?php echo $_GET['id_auteur'] ?>">Modifier</a>
<br />
<br />
<a href="<?php echo ROOT?>auteur/livres?id_auteur=<?php echo $_GET['id_auteur'] ?>">Livres écrits par <?php echo $auteur->nom.' '.$auteur->prenom ?></a>
