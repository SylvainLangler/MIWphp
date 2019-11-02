<?php

if(isset($_FILES['photo'])){
    if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
            
        $dossier = 'images/';
        $fichier = $_POST['nom'];//ou on peut mettre le nom de fichierque l'on veut pour être certain d'éviter les doublons
        $type = explode("/", $_FILES['photo']['type']);

        $fichier = $fichier.'.'.$type[1];
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichier)){
            //la fonction renvoie true, le fichier a bien été enregistré
        }else{
            echo 'echec de l\'upload.';
        }
    }
}

function getExtension($fichier){
    //on récupère l'extension de l'image:
    $ext = explode('.', $fichier);
    $ext = strtolower($ext[count($ext)-1]);

    return $ext;
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

function getImgSize($fichier, $dossier){
    //on récupère la taille de notre image
    $imgsize = getimagesize($dossier.$fichier);
    if($imgsize === false){
        echo 'erreur lors de la récupération de la source de l\'image';
        die();
    }
    return $imgsize;
}

function createThumbnail($fichier, $dossier, $imgsize, $source_gd_image, $targetWidth, $targetHeight = null){
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
    imagejpeg($thumbnail, $dossier.'thumb_'.$fichier, 90);

    //on oublie pas de libérer la mémoire, car nos images sources sont stocké etprennent de la place!
    imagedestroy($source_gd_image);

    imagedestroy($thumbnail);

    
}

$ext = getExtension($fichier);
$source_gd_image = createImage($ext, $fichier, $dossier);
$imgSize = getImgSize($fichier, $dossier);

createThumbnail($fichier, $dossier, $imgSize, $source_gd_image, 200);


echo '<img src="'. $dossier.'thumb_'.$fichier.'" style="margin:50px">';
echo '<img src="'. $dossier.$fichier.'">';

?>