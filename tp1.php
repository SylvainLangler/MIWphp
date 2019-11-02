<?php

// Ex 1
$prenom = 'Sylvain';
$nom = 'Langler';

define('AGE', 21);

// Ex 2

echo 'Je m\'appelle '.$prenom.' '.$nom.'<br />';

echo 'J\'ai '.AGE.' ans <br />';

// Ex 3
$nombre_rand = rand(0,100);

if($nombre_rand < AGE){
    echo $nombre_rand.' < à '.AGE;
}else{
    echo $nombre_rand.' > à '.AGE;
}

// Ex 4

while($nombre_rand >= AGE){
    $nombre_rand = rand(0,100);
}

echo '<br />';

echo 'nombre aléatoire en dessous de 21: '.$nombre_rand;

echo '<br />';

// Ex 5

/**
 * Génère un nombre alétoire tant qu'il n'est pas en dessous de mon age 
 */
function getRandomNumberUnderAge(){
    $nb = rand(0,100);

    if($nb < AGE){
        return $nb;
    }
    else{
        return getRandomNumberUnderAge();
    }
}

$nombre_rand2 = getRandomNumberUnderAge(); 

echo 'nombre aléatoire en dessous de 21: '.$nombre_rand2;

// Ex 6

$tab = [
    -123=>60,
    1=>5,
    555=>-99,
    0=>99,
    50=>1
];

/**
 * Retourne la somme des valeurs d'un tableau
 */
function somme(Array $tab){
    $somme = 0;
    foreach($tab as $value){
        $somme += $value;
    }
    return $somme;
}

/**
 * Retourne la valeur maximale d'un tableau
 */
function maxValue(Array $tab){
    $max = null;
    foreach($tab as $value){
        if($value > $max){
            $max = $value;
        }
    }
    return $max;
}

/**
 * Retourne la valeur minimale d'un tableau
 */
function minValue(Array $tab){
    $min = null;
    foreach($tab as $value){
        if(is_null($min) || $value < $min){
            $min = $value;
        }
    }
    return $min;
}

/**
 * Retourne la clé de la valeur maximale d'un tableau
 */
function maxKey(Array $tab){
    $maxValue = maxValue($tab);
    foreach($tab as $key=>$value){
        if($value == $maxValue){
            return $key;
        }
    }
}

/**
 * Retourne la clé de la valeur minimale d'un tableau
 */
function minKey(Array $tab){
    $minValue = minValue($tab);
    foreach($tab as $key=>$value){
        if($value == $minValue){
            return $key;
        }
    }
}

echo '<br />';


$somme = somme($tab);
 
echo 'Somme des valeurs du tableau: '.$somme;

echo '<br />';


$maxValue = maxValue($tab);

echo 'Valeur maximum: '.$maxValue;

echo '<br />';


$minValue = minValue($tab);

echo 'Valeur minimum: '.$minValue;

echo '<br />';


$maxKey = maxKey($tab);

echo 'Clé de la valeur maximale: '.$maxKey;

echo '<br />';


$minKey = minKey($tab);

echo 'Clé de la valeur minimale: '.$minKey;