<?php

include 'db_connect.php';

if(isset($_FILES['photo'])){
    if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
        upload($bdd);
        $message = "upload réussi";
    }
    else{
        $message = "upload failed";
    }
}
else{
    echo "$_FILES empty";
}

header('Location: ./country.php?country='.$_GET['country'].'&Message='.$message);

function upload($bdd){

    $dossier = './upload/src/';
    
    $type = explode("/", $_FILES['photo']['type']);

    $fichier = getImageName($bdd).'.'.$type[1];
    if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichier)){
        
        addImageToDatabase($bdd, $fichier);
        
    }else{
        echo 'echec de l\'upload.';
    }

    $dossier_thumbnails = './upload/thumb/';
    $ext = getExtension($fichier);
    $source_gd_image = createImage($ext, $fichier, $dossier);
    $imgSize = getImgSize($fichier, $dossier);

    createThumbnail($fichier, $dossier_thumbnails, $imgSize, $source_gd_image, 150, 150);
}

function getImageName($bdd){
    $maxIdImageQuery = $bdd->query('SELECT max(id) FROM gallery');
    $maxIdImage = $maxIdImageQuery->fetch()[0];
    if($maxIdImage != NULL){
        return $maxIdImage +1;
    }
    else{
        return 1;
    }
}

function addImageToDatabase($bdd, $fichier){
    $addImageQuery = $bdd->prepare('INSERT into gallery (countrycode, name, description, extension)
    VALUES(:countrycode, :name, :description, :extension) ');

    $countrycode = $_GET['country'];
    $name = $_POST['nom'];
    $description = $_POST['description'];
    $extension = getExtension($fichier);

    $addImageQuery->bindValue('countrycode', $countrycode, PDO::PARAM_STR);
    $addImageQuery->bindValue('name', $name, PDO::PARAM_STR);
    $addImageQuery->bindValue('description', $description, PDO::PARAM_STR);
    $addImageQuery->bindValue('extension', $extension, PDO::PARAM_STR);

    $addImageQuery->execute();
    $addImageQuery->closeCursor();

}

function getImgSize($fichier, $dossier){
    //on récupère la taille de notre image
    $imgsize = getimagesize($dossier.$fichier);
    if($imgsize === false){
        echo 'erreur lors de la récupération de la source de l\'image';
        die();
    }
    return $imgsize;
}

function createImage($ext, $fichier, $dossier){
    switch ($ext) {
        case 'gif':
        $source_gd_image = imagecreatefromgif($dossier.$fichier);
        break;
        case 'jpeg':
        case 'jpg':
        $source_gd_image = imagecreatefromjpeg($dossier.$fichier);
        break;
        case 'png':
        $source_gd_image = imagecreatefrompng($dossier.$fichier);
        break;
    }
    if($source_gd_image === false){
        echo 'erreur lors de la récupération de la source de l\'image';
        die();
    }
    else{
        return $source_gd_image;
    }
}

function getExtension($fichier){
    //on récupère l'extension de l'image:
    $ext = explode('.', $fichier);
    $ext = strtolower($ext[count($ext)-1]);

    return $ext;
}

function createThumbnail($fichier, $dossier_thumbnails, $imgsize, $source_gd_image, $targetWidth, $targetHeight = null){
    // Une partie du code a été récupérée sur https://pqina.nl/blog/creating-thumbnails-with-php/
    // Pour bien gérer la transparence des images png, il faudrait récupérer une partie du code qui ne l'est pas ici
    
    $width = $imgsize[0];
    $height = $imgsize[1];

    // maintain aspect ratio when no height set
    if ($targetHeight == null) {

        // get width to height ratio
        $ratio = $width / $height;

        // if is portrait
        // use ratio to scale height to fit in square
        if ($width > $height) {
            $targetHeight = floor($targetWidth / $ratio);
        }
        // if is landscape
        // use ratio to scale width to fit in square
        else {
            $targetHeight = $targetWidth;
            $targetWidth = floor($targetWidth * $ratio);
        }
    }

    // create duplicate image based on calculated target size
    $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);

    // copy entire source image to duplicate image and resize
    imagecopyresampled(
        $thumbnail,
        $source_gd_image,
        0, 0, 0, 0,
        $targetWidth, $targetHeight,
        $width, $height
    );

    //imagecrop($thumbnail, ['x' => 0, 'y' => 0, 'width' => $thumbnailWitdh, 'height' => $thumbnailHeight]);
    //et on en fait un fichier jpeg avec une qualité de 90%
    imagejpeg($thumbnail, $dossier_thumbnails.$fichier, 90);

    //on oublie pas de libérer la mémoire, car nos images sources sont stocké etprennent de la place!
    imagedestroy($source_gd_image);

    imagedestroy($thumbnail);

    
}

?>