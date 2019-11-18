<?php

foreach($livres as $livre){
    echo '<a href="./detail?idLivre='.$livre['id'].'">'.$livre['nom'].'<br /></a>';
}