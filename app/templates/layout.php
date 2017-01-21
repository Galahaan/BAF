<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>ma BAF - <?= $this->e($title) ?></title>

	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
	<div class="container">
		<header>
			<!-- <h1><?= $this->e($title) ?></h1> -->
		</header>

		<section>
			<?= $this->section('main_content') ?>
		</section>

		<footer>
		</footer>
	</div>
</body>
</html>