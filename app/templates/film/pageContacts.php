<?php $this->layout('layout', ['title' => 'Contacts']) ?>

<?php $this->start('main_content') ?>

<div class="row size">
    <div class="col-lg-12">

        <div class="col-md-6 col-sm-6">
            <h3>Notre équipe :</h3>
            <div class="col-md-3">
                <img src="<?= $this->assetUrl('img/contacts/perso.jpg') ?>" alt="" style="width: 110px;">
            </div>
            <div class="col-md-9">
                <h3>Franck</h3>
                <h4>Langlois</h4>
                <p>...</p>
            </div>
            <div class="col-md-3">
                <img src="<?= $this->assetUrl('img/contacts/perso.jpg') ?>" alt="" style="width: 110px;">
            </div>
            <div class="col-md-9">
                <h3>Tony</h3>
                <h4>Battoia</h4>
                <p>...</p>
            </div>
            <div class="col-md-3">
                <img src="<?= $this->assetUrl('img/contacts/perso.jpg') ?>" alt="" style="width: 110px;">
            </div>
            <div class="col-md-9">
                <h3>Christophe</h3>
                <h4>Le Reste</h4>
                <p>...</p>

            </div>
        </div>


        <div class="col-md-6">
            <div class=" formulaire">
                <h2 class="formulaire_titre">Formulaire de contact </h2>
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <form method="POST" action="" id="formulaire">

                        <div class="form-group">
                            <label for="mail">Email:</label>
                            <input type="text" class="form-control" name="mail" required>
                        </div>
                        <div class="form-group">
                            <label for="nom">Votre nom:</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Votre message:</label>
                            <textarea name="message" class="form-control"></textarea>
                        </div>
                        <button type="submit" name="inscrire" class="btn btn-default regbutton" value="s'inscrire">s'inscrire</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->stop('main_content') ?>
