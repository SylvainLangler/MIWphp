<?php

include 'db_connect.php';

$cities = $bdd->prepare('SELECT name,population FROM city WHERE countrycode= ?');
$cities->execute(array($_GET['country']));

$countries = $bdd->query('SELECT code FROM country');

while($row = $countries->fetch()){
    if($row['code'] == $_GET['country']){
        $country = $bdd->prepare('SELECT name FROM country WHERE code= ?');
        $country->execute(array($_GET['country']));
        $countryName = $country->fetch()['name'];
    }
}

if(isset($countryName)) : 

include 'header.php';

?>
            <div class="row ml-2 mt-5">
                <div class="col-lg-1">
                    <a href="./">
                    <button type="button" class="btn btn-dark">Retour</button>
                    </a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-4 offset-lg-1">
                    <h5><?php if(isset($countryName)) echo $countryName ?></h5>
                    <table class="tab" border="1px solid black">
                        <thead>
                            <tr>
                                <td>Ville</td>
                                <td>Population</td>
                                <td colspan='2'>Action</td>
                            </tr>
                        </thead>

<?php

while($row=$cities->fetch(PDO::FETCH_ASSOC)){
    echo '<tr>
            <td>'.$row['name'].'</td><td>'.$row['population'].'</td>
            <td><a href="ville.php?ville='.$row['name'].'"><button class="btn btn-primary">Modifier</button></a ></td></td>
            <td><form action="deleteVille.php?ville='.$row['name'].'&country='.$_GET['country'].'" method="post"><button class="btn btn-danger" type="submit" value="valider">Supprimer</button></form></td>
        </tr>';
}

$cities->closeCursor();

?>

                    </table>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h5>Formulaire d'ajout d'une ville</h5>
                    <form class="mt-5" action="ajoutVille.php?country=<?php echo $_GET['country']?>" method="post">
                        Nom de la ville <input type="text" name="ville"/>
                        <br>
                        Nombre d'habitants <input class="mt-2" type="text" name="habitants"/>
                        <br>
                        <input class="mt-2 btn btn-success" type="submit" value="valider">
                    </form>
                </div>
                <?php else : ?>
                <h1>Le pays n'existe pas</h1>
                <?php endif; ?>
            </div>
<?php include 'footer.php' ?>