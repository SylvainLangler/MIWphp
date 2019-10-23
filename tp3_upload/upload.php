<?php

if(isset($_FILES['photo'])){
    if($_FILES['photo']['error'] == UPLOAD_ERR_OK){

        $tab_authorized_images_extensions = ['png','jpg','jpeg','gif'];

        $dossier = './upload/';

        $fichier = $_POST['nom'];

        $type = explode("/", $_FILES['photo']['type']);
        if($type[1] == 'pdf'){

            if (!file_exists($dossier.'pdf/')) {
                mkdir($dossier.'pdf', 0777, true);
            }

            $dossier = $dossier.'pdf/';
            $fichier = $fichier.'_'.date('dmYH-i-s').'.'.$type[1];

            
            if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichier)){
                echo "Le fichier a bien été upload";
            }
            
        }
        else if(in_array($type[1],$tab_authorized_images_extensions)){

            if(!file_exists($dossier.'images/')){
                mkdir($dossier.'images', 0777, true);
            }

            $dossier = $dossier.'images/';
            $fichier = $fichier.'_'.date('dmYH-i-s').'.'.$type[1];

            if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichier)){
                echo "Le fichier a bien été upload";
            }
            
        }
        else{
            echo 'echec de l\'upload.';
        }
    }
}
   

?>