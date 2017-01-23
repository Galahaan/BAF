<?php $this->layout('layout', ['title' => "Doc sur 'W'"]) ?>
<!-- 'layout' fait référence au fichier layout.php du répertoire templates -->

<?php $this->start('main_content') ?>

	<h1>Doc sur W</h1>

	<p>Pour accéder à la doc, veuillez suivre les étapes indiquées ci-dessous :</p>

	<ol>
		<li>Ouvrir Cmder</li>
		<li><p>Se déplacer dans le répertoire tuto</p>
			<p>(ex.  C:\Users\Etudiant\Desktop\Dropbox\Projets vagrant\public\17-01-10-Framework-W\blogW\docs\tuto)</p></li>
		<li><p>Lancer un mini-serveur grâce à la commande :</p>
		    <p>> php -S 127.0.0.1:8080</p></li>
		<li>Ouvrir un navigateur à l'adresse : 127.0.0.1:8080</li>
	</ol>
	
	<p></p>

<?php $this->stop('main_content') ?>
