<?php $this->layout('layout', ['title' => "Problème lors de l'inscription ..."]) ?>


<?php $this->start('main_content') ?>

	<h2>Erreur ...</h2>
	<p>
		Une erreur est survenue pendant le traitement du formulaire. 
		<a href="<?= $this->url('pageInscription') ?>"> inscription</a>
	</p>


<?php $this->stop('main_content') ?>