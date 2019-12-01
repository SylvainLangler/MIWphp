<!DOCTYPE html>
<html lang='FR'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <main>
            <a href="<?php echo ROOT ?>auteur/liste">< Retour</a>
            <h2>Ajouter un auteur</h2>
            <form action="<?php echo ROOT ?>auteur/post" method="post">
                <input type="hidden" name="id" nom="id" value="<?php echo $auteur->id ?>">
                <label>Nom</label>
                <input type="text" name="nom" id="nom" value="<?php echo $auteur->nom ?>">
                <label>Prenom</label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $auteur->prenom ?>">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" value="<?php echo $auteur->date_naissance ?>">
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