<h1>Livres écrits par <?php echo $auteur->prenom.' '.$auteur->nom ?></h1>

<?php foreach($livres as $livre){
    echo "Nom: ".$livre['nom'].' Prix:'.$livre['prix'].'<br />';
}