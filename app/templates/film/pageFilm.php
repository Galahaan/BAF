<?php $this->layout('layout', ['title' => $film[0]['titreFr'] ]) ?>
<!-- 'layout' fait référence au fichier layout.php du répertoire templates -->

<?php $this->start('main_content') ?>

	<?= ( $film[0]['titreOr'] == "" ) ? "<h1>Aucune information pour ce film ...</h1>" : "" ?>

	<h1>
		<?= $film[0]['titreFr'] ?>
		<?php if( $film[0]['anneeProd'] != 0 ) : ?>
			 - <?= $film[0]['anneeProd'] ?>
		<?php endif ?>
	</h1>

	<?= $film[0]['titreOr'] ?>
	<!-- § sur les différentes valeurs possibles et multiples de la nationalité -->
		<?php if( ! isset( $film[5][0]['nationalite'] ) || $film[5][0]['nationalite'] == "Inconnu" ) : ?>
			<!-- on ne fait rien, si ce n'est éviter l'affichage d'une erreur ! -->
		<?php else : ?>
			<p>(
			<?php foreach($film[5] as $nationalites) : ?>
				<?php foreach($nationalites as $nationalite) : ?>
					<?= "$nationalite " ?>
				<?php endforeach ?>
			<?php endforeach ?>
			)</p>
		<?php endif ?>
	<!-- fin du § sur la nationalite -->

	<?= $film[0]['dateSortieFr'] == "0000-00-00" ? "" : "<p>" . $film[0]['dateSortieFr'] . "</p>" ?>
	<?= $film[1]['censure'] == "Inconnu" ? "" : "<p>Attention : " . $film[1]['censure'] . "</p>" ?>
	<?= $film[1]['typeFilm'] == "Inconnu" ? "" : "<p>" . $film[1]['typeFilm'] . "</p>" ?>
	<?= $film[1]['couleur'] == "Inconnu" ? "" : "<p>" . $film[1]['couleur'] . "</p>" ?>

	<?php if( $film[0]['duree'] != 0 ) : ?>
		<p><?= floor($film[0]['duree'] / 3600) ?> h <?= ($film[0]['duree'] % 3600)/60 ?></p>
	<?php endif ?>

	<!-- § sur les différentes valeurs possibles et multiples de la langue -->
		<?php if( ! isset( $film[2][0]['langue'] ) || $film[2][0]['langue'] == "Inconnu" ) : ?>
			<!-- on ne fait rien, si ce n'est éviter l'affichage d'une erreur ! -->
		<?php elseif( isset( $film[2][1] ) ) : ?>
			<p>Langues originales du film : 
			<?php foreach($film[2] as $langues) : ?>
				<?php foreach($langues as $langue) : ?>
					<?= "$langue " ?>
				<?php endforeach ?>
			<?php endforeach ?>
			</p>
		<?php else : ?>
			<p>Langue originale du film :
				<?= $film[2][0]['langue'] ?>
			</p>
		<?php endif ?>
	<!-- fin du § sur la langue -->

	<!-- § sur les différentes valeurs possibles et multiples du genre -->
		<?php if( ! isset( $film[3][0]['genre'] ) || $film[3][0]['genre'] == "Inconnu" ) : ?>
			<!-- on ne fait rien, si ce n'est éviter l'affichage d'une erreur ! -->
		<?php elseif( isset( $film[3][1] ) ) : ?>
			<p>Genres : 
			<?php foreach($film[3] as $genres) : ?>
				<?php foreach($genres as $genre) : ?>
					<?= "$genre " ?>
				<?php endforeach ?>
			<?php endforeach ?>
			</p>
		<?php else : ?>
			<p>Genre :
				<?= $film[3][0]['genre'] ?>
			</p>
		<?php endif ?>
	<!-- fin du § sur le genre -->

	<!-- § sur les différentes valeurs possibles et multiples de ses sélections -->
		<?php if( ! isset( $film[6][0]['libelle'] ) ) : ?>
			<!-- on ne fait rien, si ce n'est éviter l'affichage d'une erreur ! -->
		<?php else : ?>
			<p>
				<?php foreach($film[6] as $selection) : ?>
					<a href="<?= $this->url('pageSelections', ['theme' => $selection['theme']]) ?>"><?= $selection['libelle'] ?></a>
					<?= ($selection['anneeRecompense'] != "") ? " (". $selection['anneeRecompense'] .") " : ""?>
				<?php endforeach ?>
			</p>
		<?php endif ?>
	<!-- fin du § sur la sélection -->

	<p><?= $film[0]['synopsis'] ?></p>
	<?php if( $film[0]['urlBA'] != 0 ) : ?>
		<a href="http://www.allocine.fr/video/player_gen_cmedia=<?= $film[0]['urlBA'] ?>&cfilm=<?= $film[0]['idAllocine'] ?>.html" target="_blank">
			Bande annonce
		</a>
	<?php endif ?>
	<?= $film[0]['budget'] == 0 ? "" : "<p>Budget : " . $film[0]['budget'] . "</p>" ?>
	<?= $film[0]['bof'] == 0 ? "" : "<p>Box office : " . $film[0]['bof'] . "</p>" ?>
	<?= $film[0]['noteIMDB'] == 0 ? "" : "<p>Note IMDB : " . $film[0]['noteIMDB'] . "</p>" ?>
	<?= $film[0]['nbVotesIMDB'] == 0 ? "" : "<p>Nb de votes IMDB : " . $film[0]['nbVotesIMDB'] . "</p>" ?>

	<!-- § sur les différentes valeurs possibles du distributeur -->
		<?php if( $film[1]['distributeur'] != "Inconnu" ) : ?>
			<?php if( $film[1]['urlDistributeur'] != "" ) : ?>
				<?= "<p>Distributeur : <a href=\"" . $film[1]['urlDistributeur'] . "\" target=\"_blank\">" . $film[1]['distributeur'] . "</a></p>" ?>
			<?php else : ?>
				<?= "<p>Distributeur : " . $film[1]['distributeur'] . "</p>" ?>
			<?php endif ?>
		<?php endif ?>
	<!-- fin du § sur le distributeur -->

	<!-- § sur les différentes valeurs possibles et multiples des mots-clés -->
		<?php if( ! isset( $film[4][0]['motcle'] ) || $film[4][0]['motcle'] == "Inconnu" ) : ?>
			<!-- on ne fait rien, si ce n'est éviter l'affichage d'une erreur ! -->
		<?php elseif( isset( $film[4][1] ) ) : ?>
			<p>Mots-clés :
				<p>
					<?php foreach($film[4] as $motscles) : ?>
						<?php foreach($motscles as $motcle) : ?>
							<?= "$motcle ." ?>
						<?php endforeach ?>
					<?php endforeach ?>
				</p>
			</p>
		<?php else : ?>
			<p>Mot-clé :
				<?= $film[4][0]['motcle'] ?>
			</p>
		<?php endif ?>
	<!-- fin du § sur les mots-clés -->

	<img src="<?= $film[0]['urlAffiche'] ?>" alt="affiche du film">

	<!-- <?php debug($film) ?> -->

<?php $this->stop('main_content') ?>
