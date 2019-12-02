<!DOCTYPE html>
<html lang='FR'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="title" content="Sylvain Langler portfolio">
        <meta name="description" content="Site web portfolio Sylvain Langler">
        <title>Sylvain Langler</title>
        <link rel="stylesheet" href="assets/site.css">
    </head>
    <body>
        <div class="accueil">
            <header>
                <nav>
                    <img src="./assets/img/logo.png" class="logo" alt="logo sylvain langler" width="45" height="90">
                    <img src="./assets/img/hamburger.png" class="hamburger" alt="menu" width="60" height="60">
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Portfolio</a></li>
                        <li><a href="#">CV</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </header>
            <div class="intro">
                <h1><?php echo $prenom.' '.$nom ?></h1>
                <h2>Développeur Web</h2>
            </div>
        </div>
        <div class="container">
            <div class="titre">
                A PROPOS
            </div>
            <div class="presentation">
                <div class="pres_texte">
                    <div class="bienvenue">
                        Bienvenue sur mon site personnel !
                    </div>
                    <div class="texte">
                            Je m'appelle Sylvain Langler, j'ai 20 ans et je suis étudiant à Polytech Nice'Sophia en première année de cycle d'ingénieur en sciences informatiques. Je suis passionné par la conception et le dévelopement d'applications web.
                    </div>
                    <div class="texte">
                            Sur ce site vous trouverez les différents projets que j'ai réalisés pendant mon DUT MMI (Métiers du Multimédia et de l'Internet) en Arles, mais aussi les projets réalisés à Polytech et ceux développés lors de stages.
                    </div>
                </div>
                <div class="photo">
                    <img src="./assets/img/sylvainlangler.jpg" width="272" height="292" alt="photo sylvain langler">
                </div>
            </div>

            <div class="titre">
                MES PROJETS RECENTS
            </div>
            <div class="projets_recents">
            <?php echo Controller::fetch('Projet', 'projetCard'); ?>
            <?php echo Controller::fetch('Projet', 'projetCard'); ?>
            <?php echo Controller::fetch('Projet', 'projetCard'); ?>
            </div>
        </div>
    </body>
</html>

<?php




// Layout = appelé à chaque fois, on ne met rien d'autres que le "header" dans layout, ce qu'on rajoute dans la page c'est à voir dans core/controller.php avec $content, voir livre-layout
// Page cv par ex: cv-layout.php 
?>
