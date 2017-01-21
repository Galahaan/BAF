<?php $this->layout('layout', ['title' => $film['titreFr'] ]) ?>
<!-- 'layout' fait référence au fichier layout.php du répertoire templates -->

<?php $this->start('main_content') ?>

	<!-- <?php debug($article) ?> -->
	<h1><?= $film['titreFr'] ?> (<?= $film['anneeProd'] ?>)</h1>
	<h3><?= $film['titreOr'] ?></h3>
	<p></p>
	<p><?= $film['dateSortieFr'] ?></p>
	<p><?= floor($film['duree'] / 3600) ?> h <?= ($film['duree'] % 3600)/60 ?></p>
	<p><?= $film['synopsis'] ?></p>
	<a href="http://www.allocine.fr/video/player_gen_cmedia=<?= $film['urlBA'] ?>&cfilm=<?= $film['idAllocine'] ?>.html">Bande annonce</a>
	<?= $film['budget'] == 0 ? "" : "<p>Budget : " . $film['budget'] . "</p>" ?>
	<?= $film['bof'] == 0 ? "" : "<p>Box office : " . $film['bof'] . "</p>" ?>
	<?= $film['noteIMDB'] == 0 ? "" : "<p>Note IMDB : " . $film['noteIMDB'] . "</p>" ?>
	<?= $film['nbVotesIMDB'] == 0 ? "" : "<p>Nb de votes IMDB : " . $film['nbVotesIMDB'] . "</p>" ?>

<?php $this->stop('main_content') ?>
