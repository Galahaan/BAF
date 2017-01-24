<?php $this->layout('layout', ['title' => 'Inscription']) ?>


<?php $this->start('main_content') ?>

<form method="POST" action="">

	<div class="container formulaire">
		<h2 class="formulaire_titre">Pour créer votre compte, veuillez remplir ce formulaire :</h2>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<form method="POST" action="" id="formulaire">
				<div class="form-group">
					<label for="civilite">Civilité :</label>
					<select name="tabFormU[civilite]" >
						<option value="M">M</option>
						<option value="Mme">Mme</option>
					</select><br>
				</div>
				<div class="form-group">
					<label for="prenom">Prénom :</label>
					<input type="text" class="form-control" name="tabFormU[prenom]" required>
				</div>
				<div class="form-group">
					<label for="nom">Nom :</label>
					<input type="text" class="form-control" name="tabFormU[nom]" required>
				</div>
				<div class="form-group">
					<label for="ddn">Date de naissance :</label>
					<input type="date" class="form-control" name="tabFormU[ddn]" required>
				</div>
				<div class="form-group">
					<label for="email">Email :</label>
					<input type="text" class="form-control" name="tabFormU[email]" required>
				</div>
				<div class="form-group">
					<label for="username">Identifiant de connexion :</label>
					<input type="text" class="form-control" name="tabFormU[username]" required>
				</div>

				<div class="form-group">
					<label for="password">Mot de passe :</label>
					<input type="password" class="form-control" name="tabFormU[password]" required>
				</div>

				<input type="hidden" name="tabFormU[role]" value="standard">

				<button type="submit" name="valider" class="btn btn-default regbutton" >Valider</button>
			</form>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Fonctionnalités</h3>
			<ul class="listes">
				<li>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit.
				</li>
				<li>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit.
				</li>
				<li>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit.
				</li>
				<li>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit.
				</li>
				<li>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit.
				</li>
				<li>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit.
				</li>
			</ul>
		</div>
	</div>
</form>


<?php $this->stop('main_content') ?>
