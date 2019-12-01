<!DOCTYPE html>
<html lang='FR'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <main>
            <a href="<?php echo ROOT ?>livre/liste">< Retour</a>
            <h2>Modifier un livre</h2>
            <form action="<?php echo ROOT ?>livre/post" method="post">
                <input type="hidden" name="id" nom="id" value="<?php echo $livre->id ?>">
                <label>Nom</label>
                <input type="text" name="nom" id="nom" value="<?php echo $livre->nom ?>">
                <label>ISBN</label>
                <input type="text" name="ISBN" id="ISBN" value="<?php echo $livre->isbn ?>">
                <label>Résumé</label>
                <input type="text" name="resume" id="resume" value="<?php echo $livre->resume ?>">
                <label>Auteur</label>
                <select name="auteur" id="auteur">
                    <option value="">Choisir un auteur</option>
                    <?php foreach($auteurs as $auteur){

                        echo '<option value="'.$auteur['id'].'"';

                        if($livre->auteur == $auteur['id']){
                            echo 'selected';
                        }

                        echo '>'.$auteur['prenom'].' '.$auteur['nom'].'</option>';
                    }
                    ?>
                </select>
                <label>prix</label>
                <input type="text" name="prix" id="prix" value="<?php echo $livre->prix ?>">
                <br>
                <input type="submit" value="Envoyer">
            </form>
        </main>
    </body>
</html>
<style>
label{
    display: block;
    margin-top: 20px;
}

input[type="submit"]{
    margin-top:20px;
}
</style>