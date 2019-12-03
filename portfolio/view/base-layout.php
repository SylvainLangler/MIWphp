<!DOCTYPE html>
<html lang='FR'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="title" content="Sylvain Langler portfolio">
        <meta name="description" content="Site web portfolio Sylvain Langler">
        <title>Sylvain Langler</title>
        <link rel="stylesheet" href="<?php echo ROOT ?>assets/site.css">
    </head>
    <body>
        <div <?php if($currentController == 'accueil'): ?> class="accueil" <?php endif ?> >
            <header>
                <nav>
                    <img src="<?php echo ROOT ?>assets/img/logo.png" class="logo" alt="logo sylvain langler" width="45" height="90">
                    <img src="<?php echo ROOT ?>assets/img/hamburger.png" class="hamburger" alt="menu" width="60" height="60">
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Portfolio</a></li>
                        <li><a href="#">CV</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </header>
            <?php if($currentController == 'accueil'): ?>
            <div class="intro">
                <h1><?php echo $prenom.' '.$nom ?></h1>
                <h2><?php echo $job ?></h2>
            </div>
            <?php endif ?>
        </div>

        <?php echo $content ?>

        </main>
        <footer>
            <div class="contact_me">
                <a href="#">Me contacter</a>
            </div>
            <div class="footer-infos">
                <div>Pensé par Sylvain Langler</div>
                <div>Développé avec Symfony par Sylvain Langler</div>
                <div>© Tous droits réservés Sylvain Langler - 2019</div>
            </div>
        </footer>
    </body>
    <script src="<?php echo ROOT ?>assets/libraries/jquery-3.4.1.min.js"></script>
    <script src="<?php echo ROOT ?>assets/js/app.js"></script>
</html>