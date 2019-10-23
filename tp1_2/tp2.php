<?php

include 'db_connect.php';

// Exercice 1

$countriesNames = $bdd->query('SELECT name, population, code FROM country order by population desc');

include 'header.php';

?>
                <div class="row mt-5">
                    <div class="col-lg-3 offset-lg-1">
                        <table class="tab" border="1px solid black">
        
<?php

while($row=$countriesNames->fetch(PDO::FETCH_ASSOC))
{
 echo '<tr><td><a href="country.php?country='.$row['code'].'">'.$row['name'].'</a></td><td>'.$row['population'].'</tr>';
}


$countriesNames->closeCursor();

?>

                    </table>
                </div>
            </div>
<?php include 'footer.php' ?>