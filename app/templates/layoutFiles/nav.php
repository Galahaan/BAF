
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= $this->url('pageAccueil') ?>">ma BAF</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background-color: #343434;">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" style="float:right;">
                <li>
                    <a href="<?= $this->url('pageAccueil') ?>">Accueil</a>
                </li>
                <li>
                    <a href="<?= $this->url('pageApropos') ?>">A propos ...</a>
                </li>
                <li>
                    <a href="<?= $this->url('pageContacts') ?>">Contacts</a>
                </li>
                <li>
                    <a href="<?= $this->url('pageInscription') ?>">Inscription</a>
                </li>
                <li>
                    <?php if( empty($_SESSION) ) : ?>
                        <a href="<?= $this->url('pageConnexion') ?>">Connexion</a>
                    <?php else : ?>
                        <a href="<?= $this->url('pageDeconnexion') ?>">Déconnexion</a>
                    <?php endif ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
