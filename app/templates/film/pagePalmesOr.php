<?php $this->layout('layout', ['title' => $resultat[0]['libelleTitre']]) ?>


	<!-- à faire : ajouter la possibilité, pour un utilisateur connecté, de cocher des cases :
					- "vu"
					- "à voir"
					- "ajouter à mes films préférés / sélection perso"
	-->

<?php $this->start('main_content') ?>

	<h1><?= $resultat[0]['libelleTitre'] ?> ...</h1>
	<p>
		<?= $resultat[0]['description'] ?>
	</p>

	<?php foreach($resultat[1] as $film) : ?>
		<p>
			<a href="/film/<?= $film['id'] ?>" target="_blank">
				<img src="<?= $film['urlAffiche'] ?>" >
				<?=
					$film['anneeSel']
					." - ".
					$film['titreFr']
					." (".
					$film['anneeProd']
					.") "
				?>
			</a>
		</p>
	<?php endforeach ?>

	<!-- <?php debug($resultat) ?> -->

<?php $this->stop('main_content') ?>
