<?php $this->layout('layout', ['title' => 'Inscription']) ?>


<?php $this->start('main_content') ?>

<form method="POST" action="">

	<div class="container formulaire">
		<h2 class="formulaire_titre">Pour créer votre compte, veuillez remplir ce formulaire :</h2>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<form method="POST" action="" >
				<div class="form-group">
					<label for="civilite">Civilité :</label>
					<select name="tabFormUt[civilite]" >
						<option value="M">M</option>
						<option value="Mme">Mme</option>
					</select><br>
				</div>
				<div class="form-group">
					<label for="prenom">Prénom :</label>
					<input type="text" class="form-control" name="tabFormUt[prenom]" required>
				</div>
				<div class="form-group">
					<label for="nom">Nom :</label>
					<input type="text" class="form-control" name="tabFormUt[nom]" required>
				</div>
				<div class="form-group">
					<label for="ddn">Date de naissance :</label>
					<input type="date" class="form-control" name="tabFormUt[ddn]" required placeholder="aaaa-mm-jj">
				</div>
				<div class="form-group">
					<label for="email">Email :</label>
					<input type="text" class="form-control" name="tabFormUs[email]" required>
				</div>
				<div class="form-group">
					<label for="username">Identifiant de connexion :</label>
					<input type="text" class="form-control" name="tabFormUs[username]" required>
				</div>

				<div class="form-group">
					<label for="password">Mot de passe :</label>
					<input type="password" class="form-control" name="tabFormUs[password]" required>
				</div>

				<input type="hidden" name="tabFormUs[role]" value="user">

				<button type="submit" name="inscription" class="btn btn-default regbutton" >Valider</button>
			</form>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Fonctionnalités principales :</h3>
			<p> (disponibles et à vanir !.. )</p>
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
		</div>
	</div>
</form>


<?php $this->stop('main_content') ?>
