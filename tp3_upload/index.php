<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <header>
        </header>
        <main>
            <form enctype="multipart/form-data" action="upload.php" method="post">
            Nom : <input type="text" name="nom"><br />
            Photo : <input type="file" name="photo"><br />
            <input type="submit" value="Envoyer">
            </form>
            <div class="images">
                <p>Images</p>
            <?php 
                $tab_images = scandir('./upload/images');
                foreach($tab_images as $value){
                    if($value != '.' && $value != '..'){
                        echo '<a href="./upload/images/'.$value.'"><img src="./upload/images/'.$value.'"></a><br />';
                    }
                }
            ?>
            </div>
            <div class="pdf">
                <p>Pdf</p>
            <?php 
                $tab_pdf = scandir('./upload/pdf');
                foreach($tab_pdf as $value){
                    if($value != '.' && $value != '..'){
                        echo '<a href="./upload/pdf/'.$value.'">'.$value.'</a><br />';
                    }
                }
            ?>
            </div>
        </main>
    </body>
</html>