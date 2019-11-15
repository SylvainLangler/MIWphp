<?php
error_reporting(E_ALL);

include 'fonctions.php';
include 'iVehicule.php';
include 'Vehicule.php';
include 'Renault.php';
include 'Bmw.php';

$voiture = new Vehicule();
$voiture->faireLePlein();

$renault = new Renault();
$renault->faireLePlein();

$bmw = new Bmw();
$bmw->faireLePlein();


echo '<table border=\'1\'>
		<tr>
			<td>Voiture</td>
			<td>'.$renault->getMarque().'</td>
			<td>'.$bmw->getMarque().'</td>
		</tr>';

for($i=0; $i<200; $i++){
	echo '<tr><td>';
	if($voiture->getErreur() == ''){
		if($voiture->avancer()){
			echo 'J\'avance !<br />';
		}else{
			echo $voiture->getErreur();
		}
	}
	
	echo '</td><td>';
	if($renault->getErreur() == ''){
		if($renault->avancer()){
			echo 'J\'avance !<br />';
		}else{
			echo $renault->getErreur();
		}
	}
	echo '</td><td>';

	if($bmw->getErreur() == ''){
		if($bmw->avancer()){
			echo 'J\'avance !<br />';
		}else{
			echo $bmw->getErreur();
		}
	}

	echo '</td></tr>';
}


var_dump('voiture: '.$voiture->getErreur(), 'renault: '.$renault->getErreur(), 'bmw: '.$bmw->getErreur());

/*
 * TP : Créer 2 classes :
 * - Renault : consomme deux fois moins que Véhicule, a 3% de chance de tomber en panne mécanique en avançant
 * - Bmw : consomme deux fois plus et roule trois fois plus vite que Véhicule, a 5% de chance d'avoir un accident de la route ( http://s2.quickmeme.com/img/cb/cbb19102f4ada827be3c87b54b169e1eb8b50e69631e456600fc8fd2959c3766.jpg )
 */