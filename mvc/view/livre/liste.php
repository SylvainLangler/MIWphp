<h1>Livres</h1>
<a class="btn-like add" href="<?php echo ROOT ?>livre/ajouter">+ Ajouter un livre</a>
<table>
<?php foreach($livres as $livre){ ?>
    <tr>
        <td><a href="<?php echo ROOT ?>livre/detail?id=<?php echo $livre['id']?>"><?php echo $livre['nom'] ?></a>
        <td><a class="btn-like modif" href="<?php echo ROOT ?>livre/modifier?id=<?php echo $livre['id']?>">Modifier</a>
        <td><a class="btn-like suppr" href="<?php echo ROOT ?>livre/supprimer?id=<?php echo $livre['id']?>">Supprimer</a>
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