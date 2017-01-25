<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- La fonction insert est définie par Plates (et considère que l'extension du fichier est .php ?) -->
	<?php $this->insert('layoutFiles/head') ?>

	<title>ma BAF - <?= $this->e($title) ?></title>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/styles.css') ?>">
</head>

<body>
	<div class="container-fluid">

		<header>
			<?php $this->insert('layoutFiles/nav') ?>
		    <div class="img_header">
			    <img src="<?= $this->assetUrl('/img/background_image_1.png') ?>" alt="background_image">
			    <h1>la Boîte à films</h1>
			    <p>Bienvenue sur votre BAF personnelle !</p>
		    </div>
		</header>


		<section>

			<?= $this->section('main_content') ?>

		</section>


		<hr>
		<footer>
			<?php $this->insert('layoutFiles/footer') ?>
			<a href="<?= $this->url('docW') ?>">Doc sur W</a>
		</footer>
	</div>
</body>
</html>
