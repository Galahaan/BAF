
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $this->url('pageAccueil') ?>">ma BAF</a>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <!-- /.navbar-collapse -->
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
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <a href="<?= $this->url('pageInscription') ?>">Inscription</a>
                    </li>
                    <li>
                        <a href="<?= $this->url('pageConnexion') ?>">Connexion</a>
                    </li>
                </ul>
            </div>
    </div>
</nav>
