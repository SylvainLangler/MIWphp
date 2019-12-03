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
            <a href="#">
                    <button type="button" class="btn-decouvrir-projets">Découvrir mes projets</button>
                </a>
            </div>
        </div>