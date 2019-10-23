<?php

/**
 * @param $filename string The name in the html input file
 * @return bool|string false if uploaderror, file path ad name if succeeded
 * @throws Exception
 */
function uploadFile($filename){
    if($_FILES[$filename]['error'] == UPLOAD_ERR_OK){
        $pdfExt = ['pdf'];
        $imgExt = ['jpg', 'jpeg', 'gif', 'png'];
        $destDir = 'upload/';
        if(!is_dir($destDir))
            mkdir($destDir);

        //on récupère les données du document
        $pathInfo = pathinfo($_FILES[$filename]['name']);
        $pathInfo['extension'] = strtolower($pathInfo['extension']);
        if(in_array($pathInfo['extension'], $pdfExt)){
            $destDir .= 'pdf/';
        }else if(in_array($pathInfo['extension'], $imgExt)){
            $destDir .= 'img/';
        }else{
            throw new Exception('Fichier jpg, png, gif ou pdf uniquement');
        }

        if(empty($error)){
            if(!is_dir($destDir))
                mkdir($destDir);
            $uniqueFileName = date('YmdHis').'-'.rand(0,100).'.'.$pathInfo['extension'];
            if(!move_uploaded_file($_FILES[$filename]['tmp_name'], $destDir.$uniqueFileName)){
                throw new Exception('Impossible d\'enregistrer le fichier.');
            }else{
                return $destDir.$uniqueFileName;
            }
        }
    }else{
        switch ($_FILES[$filename]['error']){
            case UPLOAD_ERR_INI_SIZE:
                throw new Exception('Le fichier reçu dépasse la limite de '.ini_get('upload_max_filesize').'.');
                break;
            case UPLOAD_ERR_PARTIAL:
            case UPLOAD_ERR_NO_TMP_DIR:
            case UPLOAD_ERR_CANT_WRITE:
            case UPLOAD_ERR_EXTENSION:
                throw new Exception('Erreur lors de l\'uplaod, veuillez réessayer.');
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('Erreur lors de l\'uplaod, aucun fichier reçu.');
                break;
        }
    }
    return false;
}

function resizeImg($filepath, $thumbnailWitdh=null, $thumbnailHeight = null){
    if(!file_exists($filepath))
        return false;

    $imgExt = ['jpg', 'jpeg', 'gif', 'png'];
    //on récupère les données du document
    $pathInfo = pathinfo($filepath);
    $pathInfo['extension'] = strtolower($pathInfo['extension']);
    if(!in_array($pathInfo['extension'], $imgExt))
        return false;

    //récupération de la source de l'image d'origine
    switch ($pathInfo['extension']) {
        case 'GIF':
            $source_gd_image = imagecreatefromgif($filepath);
            break;
        case 'jpeg':
        case 'jpg':
            $source_gd_image = imagecreatefromjpeg($filepath);
            break;
        case 'PNG':
            $source_gd_image = imagecreatefrompng($filepath);
            break;
    }
    if($source_gd_image === false)
        return false;

    $imgsize = getimagesize($filepath);
    if($imgsize === false)
        return false;

    if(is_null($thumbnailWitdh) && is_null($thumbnailHeight))
        return false;

    if(is_null($thumbnailWitdh)){
        //$thumbnailWitdh = floor($thumbnailHeight*$imgsize[0]/$imgsize[1]);
    }else{
        //$thumbnailHeight = floor($thumbnailWitdh*$imgsize[1]/$imgsize[0]);
    }

    //on créé une image "vide" (une image noire)
    $thumbnail = imagecreatetruecolor($thumbnailWitdh, $thumbnailHeight);

    if($thumbnailWitdh != null && $thumbnailHeight == null){
        var_dump('salut');
        $thumbnailHeight = $thumbnailWitdh;
    }
    else{
        $thumbnailWitdh = $thumbnailHeight;
    }
    //on créé une copie de notre image source
    imagecopyresampled($thumbnail, $source_gd_image, 0, 0, 0, 0, $thumbnailWitdh, $thumbnailHeight, $imgsize[0], $imgsize[1]);
    //et on en fait un fichier jpeg avec une qualité de 90%
    $dossier = 'upload/img/';
    imagejpeg($thumbnail, $dossier.$pathInfo['filename'].'_thumb_'.$thumbnailWitdh.'x'.$thumbnailHeight.'.jpg', 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail);
}