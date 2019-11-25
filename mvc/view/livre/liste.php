<h1>Livres</h1>
<ul>
<?php foreach($livres as $livre){ ?>
    <li><a href="<?php echo ROOT ?>livre/detail?id=<?php echo $livre['id']?>"><?php echo $livre['nom'] ?></a></li>
<?php } ?>
</ul>
