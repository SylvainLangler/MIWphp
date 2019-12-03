<h1>Livres</h1>
<table>
<?php foreach($livres as $livre){ ?>
    <tr>
        <td>
            <a href="<?php echo ROOT ?>livre/detail?id=<?php echo $livre['id']?>"><?php echo $livre['nom'] ?></a>
        </td>
        <td><a href="">modifier</a></td>
    </tr>
<?php } ?>
</table>
<a href="">Ajouter</a>
