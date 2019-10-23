<?php
require_once 'functions.php';
var_dump($_FILES);
if(isset($_FILES['fichier'])){

    try{
        $filepath = uploadFile('fichier');
    }catch (Exception $e){
        echo $e->getMessage();
        die;
    }

    if(file_exists($filepath)){
        echo 'Upload fichier OK<br />';
        resizeImg($filepath, 500, 500);
    }
}
?>
<form enctype="multipart/form-data" method="post">
    <label>Fichier : </label><input type="file" name="fichier"><br>
    <input type="submit">
</form>
