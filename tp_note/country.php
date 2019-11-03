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

$imagesQuery = $bdd->prepare('SELECT * FROM gallery WHERE countrycode = ?');
$imagesQuery->execute(array($_GET['country']));

if(isset($countryName)) : 

include 'header.php';

?>
            <div class="row ml-2 mt-5">
                <div class="col-lg-1">
                    <a href="./">
                    <button type="button" class="btn btn-dark">Retour</button>
                    </a>
                </div>
                
                <?php
                    if( isset( $_GET['Message'] ) && $_GET['Message'] != '' )
                    {
                        echo '<div class="col-lg-2" style="background-color:black; border-radius: 5px; text-align:center;">
                                    <h1>'.$_GET['Message'].'</h1>
                                </div>';
                    }
                ?>
                
            </div>
            <div class="row mt-5">
                <div class="col-lg-4 offset-lg-1">
                    <h5><?php if(isset($countryName)) echo $countryName ?></h5>
                    <table class="tab" border="1px">
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
                    <h5 class="mt-5">Formulaire d'ajout d'images</h5>
                    <form class="mt-5" action="ajoutPhoto.php?country=<?php echo $_GET['country']?>" method="post" enctype="multipart/form-data">
                        Nom <input type="text" name="nom"/>
                        <br>
                        Description <textarea class="mt-2" type="text" name="description" id="description">
                        </textarea>
                        <br>
                        Photo : <input type="file" name="photo">
                        <br>
                        <input class="mt-2 btn btn-success" type="submit" value="valider">
                    </form>
                    
                    <div class="mt-5">
                        <h3>Liste des images</h3>
                        <table class="tab" border="1px">
                            <thead>
                                <tr>
                                    <td>Miniature</td>
                                    <td>Nom</td>
                                    <td>Description</td>
                                    <td>Lien</td>
                                </tr>
                            </thead>
                        <?php
                        
                        while($row=$imagesQuery->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr>
                                    <td><img src="./upload/thumb/'.$row['id'].'.'.$row['extension'].'"</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['description'].'</td>
                                    <td><a href="./upload/src/'.$row['id'].'.'.$row['extension'].'">Lien vers l\'image</a ></td></td>
                                </tr>';
                        }
                        $imagesQuery->closeCursor();
                        
                        ?>
                    </div>
                    
                </div>
                <?php else : ?>
                <h1>Le pays n'existe pas</h1>
                <?php endif; ?>
            </div>
<?php include 'footer.php' ?>