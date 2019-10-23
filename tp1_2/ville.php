<?php

    include 'db_connect.php';
    include 'header.php';
    
    $villes = $bdd->query('SELECT name FROM city');

    while($row = $villes->fetch()){
        if($row['name'] == $_GET['ville']){
            $ville = $bdd->prepare('SELECT * FROM city WHERE name= ?');
            $ville->execute(array($_GET['ville']));
            $ville_infos = $ville->fetch();
        }
    }

    $idVille = $ville_infos['id'];
    $population = $ville_infos['population'];

    $countryCode = $ville_infos['countrycode'];
?>

            <div class="row ml-2 mt-5">
                <div class="col-lg-1">
                    <a href="http://localhost:8080/exercices_php/country.php?country=<?php echo $countryCode ?>">
                        <button type="button" class="btn btn-dark">Retour</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 offset-lg-1">
                    <h1 class="text-center"> <?php echo $_GET['ville']; ?> </h1>
                    <form class="mt-5" action="modifyVille.php?ville=<?php echo $_GET['ville'] ?>" method="post">
                        Nom de la ville <input type="text" name="ville" value="<?php echo $_GET['ville']; ?>"/>
                        <br>
                        Nombre d'habitants <input class="mt-2" type="text" name="habitants" value="<?php echo $population; ?>"/>
                        <input name="id" type="hidden" value="<?php echo $idVille; ?>">
                        <br>
                        <input class="mt-2 btn btn-success" type="submit" value="valider">
                    </form>
                </div>
            </div>

<?php 

include 'footer.php';

?>
