<!DOCTYPE html>
<html lang='FR'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <main>
            <h2>Ajouter un livre</h2>
            <form action="<?php echo ROOT ?>livre/post" method="post">
                <label>Nom</label>
                <input type="text" name="nom" id="nom">
                <label>ISBN</label>
                <input type="text" name="ISBN" id="ISBN">
                <label>Résume</label>
                <input type="text" name="resume" id="resume">
                <label>Auteur</label>
                <input type="text" name="auteur" id="auteur">
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
</style>