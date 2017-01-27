<?php $this->layout('layout', ['title' => $film[0]['titreFr'] ]) ?>
<!-- 'layout' fait référence au fichier layout.php du répertoire templates -->

<?php $this->start('main_content') ?>

	<div class="container margin">

		<div class="row">
			<div class="col-md-3 image">
				<a href="#">
					<img class="img-responsive img-center" src="<?= $film[0]['urlAffiche'] ?>" alt="affiche du film" style="margin:auto;">
				</a>
			</div>
			<div class="col-md-4 descriptif">
	<!-- Titre Fr -->
				<h3><?= $film[0]['titreFr'] ?>
				<?php if( $film[0]['anneeProd'] != 0 ) : ?>
					 - <?= $film[0]['anneeProd'] ?>
				<?php endif ?>
				</h3>
	<!-- fin titre Fr -->

	<!-- Titre Or (si différent du Fr) -->
				<?= ( $film[0]['titreOr'] == $film[0]['titreFr'] ) ? "" : "<h4>".$film[0]['titreOr']."</h4>" ?>
	<!-- fin titre Or -->

				<ul>
					<?php
					foreach($film[7] as $profession){
						if($profession['prof'] == 'auteur'){
							echo "<li>Auteur : ".$profession['nom']."</li>"; } }
					foreach($film[7] as $profession){
						if($profession['prof'] == 'realis'){
							echo "<li>Réalisateur : ".$profession['nom']."</li>"; } }
	// Distributeur : différentes valeurs possibles
					if( $film[1]['distributeur'] != "Inconnu" ){
						if( $film[1]['urlDistributeur'] != "" ){
							echo "<li>Distributeur : <a href=\"" . $film[1]['urlDistributeur'] . "\" target=\"_blank\">" . $film[1]['distributeur'] . "</a></li>";
						}
					}
					else{
						"<p>Distributeur : " . $film[1]['distributeur'] . "</p>";
					}
	// fin distributeur
					?>
	<!-- Type de film : long métrage / court métrage / ... -->
					<?= $film[1]['typeFilm'] == "Inconnu" ? "" : "<li>" . $film[1]['typeFilm'] ?><!-- la fin du li est au § suivant -->
	<!-- Nationalité : différentes valeurs possibles et multiples -->
		<?php if( ! isset( $film[5][0]['nationalite'] ) || $film[5][0]['nationalite'] == "Inconnu" ) : ?>
			<!-- on ne fait rien, si ce n'est éviter l'affichage d'une erreur ! -->
		<?php else : ?>
			(
			<?php foreach($film[5] as $nationalites) : ?>
				<?php foreach($nationalites as $nationalite) : ?>
					<?= "$nationalite " ?>
				<?php endforeach ?>
			<?php endforeach ?>
			)</li><!-- li commencé au début du § sur le type de film -->
		<?php endif ?>
	<!-- fin nationalité -->
	<!-- Date de sortie -->
					<?= $film[0]['dateSortieFr'] == "0000-00-00" ? "" : "<li>" . date('d M Y', strtotime($film[0]['dateSortieFr'])) . "</li>" ?>
	<!-- Couleur / Noir & Blanc / les 2 -->
					<?= $film[1]['couleur'] == "Inconnu" ? "" : "<li>" . $film[1]['couleur'] . "</li>" ?>
	<!-- Durée -->
					<?php if( $film[0]['duree'] != 0 ) : ?>
						<li><?= floor($film[0]['duree'] / 3600) ?> h <?= ($film[0]['duree'] % 3600)/60 ?></li>
					<?php endif ?>
	<!-- Genre : différentes valeurs possibles et multiples -->
						<?php if( ! isset( $film[3][0]['genre'] ) || $film[3][0]['genre'] == "Inconnu" ) : ?>
							<!-- on ne fait rien, si ce n'est éviter l'affichage d'une erreur ! -->
						<?php elseif( isset( $film[3][1] ) ) : ?>
							<li>Genres : 
							<?php foreach($film[3] as $genres) : ?>
								<?php foreach($genres as $genre) : ?>
									<?= "$genre " ?>
								<?php endforeach ?>
							<?php endforeach ?>
							</li>
						<?php else : ?>
							<li>Genre :
								<?= $film[3][0]['genre'] ?>
							</li>
						<?php endif ?>
	<!-- fin genre -->

	<!-- Langue : différentes valeurs possibles et multiples -->
					<?php if( ! isset( $film[2][0]['langue'] ) || $film[2][0]['langue'] == "Inconnu" ) : ?>
						<!-- on ne fait rien, si ce n'est éviter l'affichage d'une erreur ! -->
					<?php elseif( isset( $film[2][1] ) ) : ?>
						<li>Langues originales du film : 
						<?php foreach($film[2] as $langues) : ?>
							<?php foreach($langues as $langue) : ?>
								<?= "$langue " ?>
							<?php endforeach ?>
						<?php endforeach ?>
						</li>
					<?php else : ?>
						<li>Langue originale du film :
							<?= $film[2][0]['langue'] ?>
						</li>
					<?php endif ?>
	<!-- fin langue -->

	<!-- Sélection : différentes valeurs possibles et multiples -->
					<?php if( ! isset( $film[6][0]['libelle'] ) ) : ?>
						<!-- on ne fait rien, si ce n'est éviter l'affichage d'une erreur ! -->
					<?php else : ?>
						<li>
							Sélection(s) : 
							<?php foreach($film[6] as $selection) : ?>
								<a href="<?= $this->url('pageSelections', ['theme' => $selection['theme']]) ?>"><?= $selection['libelle'] ?></a>
								<?= ($selection['anneeRecompense'] != "") ? " (". $selection['anneeRecompense'] .") " : ""?>
							<?php endforeach ?>
						</li>
					<?php endif ?>
	<!-- fin sélection -->

				</ul>
			</div>
			<div class="col-md-5">
	<!-- Bande annonce -->
				<?php if( $film[0]['urlBA'] != 0 ) : ?>
					<iframe src='http://www.allocine.fr/_video/iblogvision.aspx?cmedia=<?= $film[0]['urlBA'] ?>' style='width:480px; height:270px'>
					</iframe>
				<?php endif ?>
				<?php //if( $film[0]['urlBA'] != 0 ) : ?>
					<!-- <a href="http://www.allocine.fr/video/player_gen_cmedia=<?= $film[0]['urlBA'] ?>&cfilm=<?= $film[0]['idAllocine'] ?>.html" target="_blank">Bande annonce</a> -->
				<?php //endif ?>
	<!-- fin bande annonce -->

	<!-- Censure -->
				<p style="text-align:center;">
					<?= $film[1]['censure'] == "Inconnu" ? "" : "Attention : " . $film[1]['censure'] ?>
				</p>
	<!-- fin censure -->

			</div>
		</div>
	</div>

	<div class="container">
		<div class="row section">
			<h4> Plus de détails </h4>
		</div>
	</div>

	<div class="container">
		<h4>Synopsis</h4>
		<p><?= $film[0]['synopsis'] ?></p>
	</div>

	<!-- "Acteurs" (double sens) -->
		<?php
			if( ! isset( $film[7][0]['prof'] ) ){
				// on ne fait rien, si ce n'est éviter l'affichage d'une erreur !
			}
			elseif( isset( $film[7][1] ) ){
				echo "<h4>Principaux acteurs</h4>";
				foreach($film[7] as $index => $acteur){
					// pour voir tous les "acteurs" (au sens "personne ayant participé au film") :
					// $acteur['profession'] . " : " . $acteur['nom']

					// pour voir les XX principaux acteurs (au sens "acteur" proprement dit) :
					if( ($acteur['prof'] == 'acteur') && $index <= 4 ){
						debug($acteur);
						echo "<p>Acteur : ".$acteur['nom']."</p>";
					}
				}
			}
			else{
				echo $film[7][0]['prof'] . " " . $film[7][0]['nom'];
			}
		?>
	<!-- fin Acteurs -->

	<div class="container">
			<h4>Principaux ACTEURS</h4>
		<div class="row">
	        <div class="col-md-3 col-sm-6 hero-feature taille">
	            <div class="thumbnail">
	                <img src="img/acteurs/acteur_1.jpg" alt="">
	                <div class="caption">
	                    <h5>Michael Fassbender</h5> 
	                </div>
	            </div>
	        </div>
	        <div class="col-md-3 col-sm-6 hero-feature taille">
	            <div class="thumbnail">
	                <img src="img/acteurs/acteur_2.jpg" alt="">
	                <div class="caption">
	                    <h5>Marion Cotillard</h5> 
	                </div>
	            </div>
	        </div>
	        <div class="col-md-3 col-sm-6 hero-feature taille">
	            <div class="thumbnail">
	                <img src="img/acteurs/acteur_3.jpg" alt="">
	                <div class="caption">
	                    <h5>Jeremy Irons</h5> 
	                </div>
	            </div>
	        </div>
	        <div class="col-md-3 col-sm-6 hero-feature taille">
	            <div class="thumbnail">
	                <img src="img/acteurs/acteur_4.jpg" alt="">
	                <div class="caption">
	                    <h5>Brendan Gleeson</h5> 
	                </div>
	            </div>
	        </div>
		</div>
	</div>

	<div class="container">
	<?php foreach($film[7] as $profession){
			if($profession['prof'] == 'produc'){
				echo "<h4>Producteur : ".$profession['nom']."</h4>"; } } ?>
	</div>
	<div class="container">
	<?php foreach($film[7] as $profession){
			if($profession['prof'] == 'scenar'){
				echo "<h4>Scénariste : ".$profession['nom']."</h4>"; } } ?>
	</div>
	<div class="container">
	<?php foreach($film[7] as $profession){
			if($profession['prof'] == 'compos'){
				echo "<h4>Compositeur : ".$profession['nom']."</h4>"; } } ?>
	</div>
	<div class="container">
	<?php foreach($film[7] as $profession){
			if($profession['prof'] == 'dirPho'){
				echo "<h4>Directeur de la photographie : ".$profession['nom']."</h4>"; } } ?>
	</div>
	<div class="container">
		<?= $film[0]['budget'] == 0 ? "" : "<h4>Budget : " . $film[0]['budget'] . "</h4>" ?>
	</div>
	<div class="container">
		<?= $film[0]['bof'] == 0 ? "" : "<h4>Box office : " . $film[0]['bof'] . "</h4>" ?>
	</div>
	<div class="container">
		<?= $film[0]['noteIMDB'] == 0 ? "" : "<h4>Note IMDB : " . $film[0]['noteIMDB'] . "</h4>" ?>
	</div>
	<div class="container">
		<?= $film[0]['nbVotesIMDB'] == 0 ? "" : "<h4>Nb de votes IMDB : " . $film[0]['nbVotesIMDB'] . "</h4>" ?>
	</div>
	<div class="container">
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
	</div>

<?php $this->stop('main_content') ?>
