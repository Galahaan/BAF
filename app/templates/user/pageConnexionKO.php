<?php $this->layout('layout', ['title' => "Connexion refusée ..."]) ?>


<?php $this->start('main_content') ?>

	<h2>Erreur de connexion</h2>
	<p>La combinaison "identifiant / mot de passe" est incorrecte ... </p>
	<p></p>
	<p>
		<a href="<?= $this->url('pageConnexion') ?>"> connexion </a>
	</p>


<?php $this->stop('main_content') ?>
