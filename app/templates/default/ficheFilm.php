<?php $this->layout('layout', ['title' => 'Fiche du film']) ?>
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
	<p>Budget : <?= $film['budget'] ?></p>
	<p>Box office : <?= $film['bof'] ?></p>
	<p>Note IMDB : <?= $film['noteIMDB'] ?></p>
	<p>Nb de votes IMDB : <?= $film['nbVotesIMDB'] ?></p>

<?php $this->stop('main_content') ?>
