<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

<div class="wraper">

	<div class="iso-nav">
		<!-- Liste des icônes de groupes pour tri rapide -->
		<ul>
			<li class="active" data-filter="*">Tous les thèmes !</li>
			<li data-filter=".recompenses"><img src="<?= $this->assetUrl('img/accueil/icones/recompenses.png') ?>" alt=""></li>
			<li data-filter=".genres"><img src="<?= $this->assetUrl('img/accueil/icones/clap.png') ?>" alt=""></li>
			<li data-filter=".selectionsPerso"><img src="<?= $this->assetUrl('img/accueil/icones/selectionsPerso.png') ?>" alt=""></li>
			<li data-filter=".autres"><img src="<?= $this->assetUrl('img/accueil/icones/points.png') ?>" alt=""></li>
		</ul>
	</div>

	<div class="main-iso">

		<!-- Groupe des récompenses (Palmes d'Or, Césars, Oscars, Ours d'Or, etc ...)              -->
		<!-- Groupe des sélections personnelles (vus, à voir, préférés, ...)                       -->
		<!-- Groupe des genres (aventure, comédie dramatique, comédie, policier, drame, etc ...)   -->
		<!-- Groupe des autres présélections (classiques, cultes, UGC, etc ...)                    -->

		<div class="item recompenses">
			<img src="<?= $this->assetUrl('img/accueil/recompenses/palmesOr.png') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "palmesOr"]) ?>" class="taille_a couleur_recompenses">
				<span class="affichage_titre">
					Palmes d'Or
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item recompenses">
			<img src="<?= $this->assetUrl('img/accueil/recompenses/cesars.jpg') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "cesars"]) ?>" class="taille_a couleur_recompenses">
				<span class="affichage_titre">
					Césars
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item recompenses">
			<img src="<?= $this->assetUrl('img/accueil/recompenses/oscars.jpg') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "oscars"]) ?>" class="taille_a couleur_recompenses">
				<span class="affichage_titre">
					Oscars
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item recompenses">
			<img src="<?= $this->assetUrl('img/accueil/recompenses/oursOr.jpg') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "oursOr"]) ?>" class="taille_a couleur_recompenses">
				<span class="affichage_titre">
					Ours d'Or
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>


		<?php if( ! empty($_SESSION) ) : ?>
			<div class="item selectionsPerso">
				<img src="<?= $this->assetUrl('img/accueil/selectionsPerso/vus.jpg') ?>" alt="" class="taille_img">
				<a href="#" class="taille_a couleur_selectionsPerso">
					<span class="affichage_titre">
						Films vus
					</span>
					<span class="affichage_text">
						<!--  -->
					</span>
				</a>
			</div>
		<?php endif ?>


		<div class="item genres">
			<img src="<?= $this->assetUrl('img/accueil/genres/comDra.jpg') ?>" alt="" class="taille_img">
			<a href="#" class="taille_a couleur_genres">
				<span class="affichage_titre">
					Comédie dramatique
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>


		<div class="item autres">
			<img src="<?= $this->assetUrl('img/accueil/autres/007.png') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "007"]) ?>" class="taille_a couleur_autres">
				<span class="affichage_titre">
					007
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item autres">
			<img src="<?= $this->assetUrl('img/accueil/autres/ugc.jpg') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "ugc"]) ?>" class="taille_a couleur_autres">
				<span class="affichage_titre">
					Sélection UGC 2016
				</span>
				<span class="affichage_text">
					<!--  -->
				</span>
			</a>
		</div>

		<div class="item autres">
			<img src="<?= $this->assetUrl('img/accueil/autres/cdc.png') ?>" alt="" class="taille_img">
			<a href="<?= $this->url('pageSelections', ['theme' => "cdc"]) ?>" class="taille_a couleur_autres">
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

