<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

<div class="wraper">

	<div class="iso-nav">
		<!-- Liste des icônes de groupes pour tri rapide -->
		<ul>
			<li class="active" data-filter="*">All Items</li>
			<li data-filter=".preSelections"><img src="<?= $this->assetUrl('img/accueil/preSelections.png') ?>" alt=""></li>
			<li data-filter=".genre"><img src="<?= $this->assetUrl('img/accueil/clap.png') ?>" alt=""></li>
			<li data-filter=".selectionsPerso"><img src="<?= $this->assetUrl('img/accueil/selectionsPerso.png') ?>" alt=""></li>
			<li data-filter=".autre"><img src="<?= $this->assetUrl('img/accueil/points.png') ?>" alt=""></li>
		</ul>
	</div>

	<div class="main-iso">

		<!-- ///////////////////////////////////////////////////////////////////////////// -->
		<!-- Groupe des Présélections (récompenses, classiques, cultes, UGC, CDC, etc ...) -->

		<div class="item  preSelections">
			<img src="<?= $this->assetUrl('img/accueil/palmesOr.png') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "palmesOr"]) ?>" class="taille_a couleur_preSelections">
				<span class="affichage_titre">
					Palmes d'Or
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item  preSelections">
			<img src="<?= $this->assetUrl('img/accueil/cesars.jpg') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "cesars"]) ?>" class="taille_a couleur_preSelections">
				<span class="affichage_titre">
					Césars
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item  preSelections">
			<img src="<?= $this->assetUrl('img/accueil/oscars.jpg') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "oscars"]) ?>" class="taille_a couleur_preSelections">
				<span class="affichage_titre">
					Oscars
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item  preSelections">
			<img src="<?= $this->assetUrl('img/accueil/oursOr.jpg') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "oursOr"]) ?>" class="taille_a couleur_preSelections">
				<span class="affichage_titre">
					Ours d'Or
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<!-- ///////////////////////////////////////////////////////////////////////////// -->
		<!-- Groupe des Sélections personnelles (vus, à voir, préférés, ...)               -->

		<div class="item  selectionsPerso">
			<img src="<?= $this->assetUrl('img/accueil/vus.jpg') ?>" alt="" class="taille_img">
			<a href="#" class="taille_a couleur_selectionsPerso">
				<span class="affichage_titre">
					Films vus
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<!-- ///////////////////////////////////////////////////////////////////////////// -->
		<!-- Genres (aventure, comédie dramatique, comédie, policier, drame, etc ...)      -->
		<div class="item  genre">
			<img src="<?= $this->assetUrl('img/accueil/genres.jpg') ?>" alt="" class="taille_img">
			<a href="#" class="taille_a couleur_genres">
				<span class="affichage_titre">
					Comédie dramatique
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<!-- ///////////////////////////////////////////////////////////////////////////// -->
		<!-- Autres (classiques, cultes, UGC, etc ...)                                     -->
		<div class="item  autre">
			<img src="<?= $this->assetUrl('img/accueil/007.png') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "007"]) ?>" class="taille_a couleur_autre">
				<span class="affichage_titre">
					007
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item  autre">
			<img src="<?= $this->assetUrl('img/accueil/ugc2016.png') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "ugc2016"]) ?>" class="taille_a couleur_autre">
				<span class="affichage_titre">
					Sélection UGC 2016
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item  autre">
			<img src="<?= $this->assetUrl('img/accueil/cdc2016.png') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "cdc2016"]) ?>" class="taille_a couleur_autre">
				<span class="affichage_titre">
					Sélection Cahiers du Cinéma 2016
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

	</div>
</div>

<?php $this->stop('main_content') ?>





<a href="<?= $this->url('docW') ?>">Doc sur W</a>

