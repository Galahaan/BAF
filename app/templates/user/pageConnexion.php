<?php $this->layout('layout', ['title' => 'Connexion']) ?>


<?php $this->start('main_content') ?>

	<div class="container formulaire">
		<h2 class="formulaire_titre">Connexion à la BAF :</h2>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<form method="POST" action="" >

				<div class="form-group">
					<label for="username">Identifiant de connexion :</label>
					<input type="text" class="form-control" name="tabForm[username]" required>
				</div>

				<div class="form-group">
					<label for="password">Mot de passe :</label>
					<input type="password" class="form-control" name="tabForm[password]" required>
				</div>

				<button type="submit" name="connexion" class="btn btn-default regbutton" >Valider</button>

			</form>

			<p></p>
			<p>
				Si vous n'avez pas encore de compte, vous pouvez retrouver le formulaire d'inscription
				ici : 
				<a href="<?= $this->url('pageInscription') ?>">inscription</a>
			</p>

		</div>
	</div>

<?php $this->stop('main_content') ?>
