<?php $this->layout('layout', ['title' => 'Inscription validée']) ?>


<?php $this->start('main_content') ?>

	<h2>Bienvenue ! Votre inscription est validée.</h2>
	<p>Vous pouvez maintenant vous connecter : <a href="<?= $this->url('pageConnexion') ?>"> connexion </a> ...</p>
	<p>et bénéficier des fonctionnalités suivantes :</p>
	<ul>
		<li>création de vos propres listes de films : vus, à voir, préférés, ... </li>
		<li>annotations personnelles des films que vous avez vus : où, quand, avec qui, donner une note ...</li>
		<li>partage de vos films préférés avec d'autres cinéphiles.</li>
	</ul>

<?php $this->stop('main_content') ?>
