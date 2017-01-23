<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
	<h1> Accueil </h1>
	<p> Tony, à toi de jouer !... </p>

	<p>
		<a href="<?= $this->url('docW') ?>">Doc sur W</a>
	</p>
	
	<p>
		<a href="<?= $this->url('pageSelections', ['theme' => "palmesOr"]) ?>">Palmes d'Or</a>
	</p>

	<p>
		<a href="<?= $this->url('pageSelections', ['theme' => "007"]) ?>">James Bond</a>
	</p>

	<p>
		<a href="<?= $this->url('pageSelections', ['theme' => "cesars"]) ?>">Césars</a>
	</p>


<?php $this->stop('main_content') ?>
