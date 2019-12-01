<!DOCTYPE html>
<html lang='FR'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <main>
            <a href="<?php echo ROOT ?>livre/liste">< Retour</a>
            <h2>Ajouter un livre</h2>
            <form action="<?php echo ROOT ?>livre/post" method="post">
                <label>Nom</label>
                <input type="text" name="nom" id="nom">
                <label>ISBN</label>
                <input type="text" name="ISBN" id="ISBN">
                <label>Résume</label>
                <input type="text" name="resume" id="resume">
                <label>Auteur</label>
                <select name="auteur" id="auteur">
                    <option value="">Choisir un auteur</option>
                    <?php foreach($auteurs as $auteur){
                        echo '<option value="'.$auteur['id'].'">'.$auteur['prenom'].' '.$auteur['nom'].'</option>';
                    }
                    ?>
                </select>
                <label>prix</label>
                <input type="text" name="prix" id="prix">
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