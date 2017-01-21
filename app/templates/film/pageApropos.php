<?php $this->layout('layout', ['title' => 'A propos ...']) ?>

<?php $this->start('main_content') ?>

	<h1>Ma Boîte à films ...</h1>

	<p>La "BAF" constitue le projet final de 3 élèves issus de WebForce3 :</p>
	<ul>
		<li>Tony Battoia</li>
		<li>Franck Langlois</li>
		<li>Christophe Le Reste</li>
	</ul>

	<p>
		L'idée principale de ce site est de proposer à tout internaute enregistré
		un outil lui permettant de gérer sa propre base de données cinématographiques.
	</p>

	<h2>Fonctionnalités principales :</h2>

	<ul>
		<li>cocher les films vus
			<p>(ou importer une liste .txt ou .csv)</p>
		</li>
	
		<li>cocher les films à voir</li>
		
		<li>associer de nombreux commentaires personnels aux films vus
			<p>(date, lieu, ...)</p>
		</li>
		
		<li>donner sa propre note à un film vu</li>

		<li>consulter la base de données sous de multiples angles :
			<ul>
				<li>thèmes prédéfinis : grands festivals, classiques, UGC 2016, James Bond, ...</li>
				<li>thèmes personnels : films vus, à voir, préférés, en possession de tel ou tel support, ...</li>
				<li>genres : comédie dramatique, aventure, ...</li>
				<li>recherche multicritère</li>
			</ul>
		</li>

		<li>échanger sa liste de films préférés avec un autre internaute</li>

		<li>etc ...</li>
	</ul>

<?php $this->stop('main_content') ?>
