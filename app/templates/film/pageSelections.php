<?php $this->layout('layout', ['title' => $resultat[0]['titre']]) ?>

	<!-- <?php debug($resultat) ?> -->


	<!-- à faire : ajouter la possibilité, pour un utilisateur connecté, de cocher des cases :
					- "vu"
					- "à voir"
					- "préféré"
					- "sur tel ou tel support"
	-->

<?php $this->start('main_content') ?>

	<h1><?= $resultat[0]['titre'] ?> ...</h1>
	<p>
		<?= $resultat[0]['description'] ?>
	</p>

	<form method="POST" action="">
		<input type="submit" name="valider" value="Valider les sélections">

	<?php foreach($resultat[1] as $film) : ?>
		<p>
			<?php if( ! empty($_SESSION) ) : // cas où un utilisateur est connecté ?>

				<?php //debug($_SESSION); ?>

				<a href="<?= $this->url('pageFilm', ['id' => $film['id']]) ?>">
					<img src="">
					<?php  //<?= $this->assetUrl("img/affichesFilms/" . $film['urlAffiche'] ) ?>
					<?= ( $film['anneeSel'] != 0 ) ? $film['anneeSel'] . " - " . $film['titreFr'] : $film['titreFr'] ." (". $film['anneeProd'] . ") " ?>
				</a>
					<?php
						// nb de cases cochées : $nbSelPerso
						$nbSelPerso = count($film['perso']);

						// initialisation des booléens qui servent à repérer les cases cochées :
						$vuOK = false; // vu
						$avOK = false; // à voir
						$prOK = false; // préféré

						// if( $nbSelPerso > 0 ){
						// 	foreach( $film['perso'] as $selPerso ){
						// 		if( $selPerso['libelle'] == 'vu' ){
						// 			$vuOK = true;
						// 		}
						// 		elseif( $selPerso['libelle'] == 'av' ){
						// 			$avOK = true;
						// 		}
						// 		elseif( $selPerso['libelle'] == 'pr' ){
						// 			$prOK = true;
						// 		}
						// 	}
						// }

						if( $nbSelPerso > 0 ){
							foreach( $film['perso'] as $selPerso ){
								switch( $selPerso['libelle'] ){
									case 'vu' :
										$vuOK = true;
										break;
									case 'av' :
										$avOK = true;
										break;
									case 'pr' :
										$prOK = true;
										break;
								}
							}
						}

					?>

				<label for="<?= "vu" . $film['id'] ?>">vu</label>
					<input type="checkbox"
								id="<?= "vu" . $film['id'] ?>"
								name="<?= "id" . $film['id'] . "[]" ?>"
								<?= ( $vuOK ) ? "checked" : "value='vu'" ?> >
				<label for="<?= "av" . $film['id'] ?>">à voir</label>
					<input type="checkbox"
								id="<?= "av" . $film['id'] ?>"
								name="<?= "id" . $film['id'] . "[]" ?>"
								<?= ( $avOK ) ? "checked" : "value='av'" ?> >
				<label for="<?= "pr" . $film['id'] ?>">préféré</label>
					<input type="checkbox"
								id="<?= "pr" . $film['id'] ?>"
								name="<?= "id" . $film['id'] . "[]" ?>"
								<?= ( $prOK ) ? "checked" : "value='pr'" ?> >
	</form>
			<?php else : // cas où personne n'est connecté ?>
				<a href="<?= $this->url('pageConnexion') ?>">
					<img src="<?= $film['urlAffiche'] ?>" >
					<?= ( $film['anneeSel'] != 0 ) ? $film['anneeSel'] . " - " : "" ?>
					<?=
						$film['titreFr']
						." (".
						$film['anneeProd']
						.") "
					?>
				</a>
			<?php endif ?>
		</p>
	<?php endforeach ?>

<?php $this->stop('main_content') ?>
