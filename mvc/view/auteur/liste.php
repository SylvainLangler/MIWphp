<a href="<?php echo ROOT ?>">< Retour</a>
<h1>Auteurs</h1>
<a class="btn-like add" href="<?php echo ROOT ?>auteur/ajouter">+ Ajouter un auteur</a>
<table>
<?php foreach($auteurs as $auteur){ ?>
    <tr>
        <td><a href="<?php echo ROOT ?>auteur/detail?id_auteur=<?php echo $auteur['id']?>"><?php echo $auteur['prenom'].' '.$auteur['nom'] ?></a>
        <td><a class="btn-like modif" href="<?php echo ROOT ?>auteur/modifier?id=<?php echo $auteur['id']?>">Modifier</a>
        <td><a class="btn-like suppr" href="<?php echo ROOT ?>auteur/supprimer?id=<?php echo $auteur['id']?>">Supprimer</a>
    </td>
<?php } ?>
</table>
<style>
.btn-like{
    text-decoration:none;
    color:white;
    padding:8px;
    border-radius:3px;
}

.modif{
    background-color:#343495;
}

.suppr{
    background-color:#e73333;
}

.add{
    background-color:#006a9d;
}

table{
    margin-top:20px;
    border-collapse: collapse;
}

td{
    border: 1px solid black;
    padding:13px;
}
</style>