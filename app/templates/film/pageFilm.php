<?php $this->layout('layout', ['title' => $film[0]['titreFr'] ]) ?>
<!-- 'layout' fait référence au fichier layout.php du répertoire templates -->

<?php $this->start('main_content') ?>

<?php define("NB_MAX_ACTEURS_AFFICHES", 6); ?>

	<div class="container margin">

		<div class="row">
			<div class="col-md-3 image">
				<a href="<?= $this->assetUrl('img/affichesFilms/'.$film[0]['urlAffiche']) ?>">
					<img class="img-responsive img-center" src="<?= $this->assetUrl('img/affichesFilms/'.$film[0]['urlAffiche']) ?>" alt="affiche du film" style="margin:auto;">
				</a>
			</div>
			<div class="col-md-4 descriptif">
				<h3><?= $film[0]['titreFr'] ?>
				<?php if( $film[0]['anneeProd'] != 0 ) : ?>
					(<?= $film[0]['anneeProd'] ?>)
				<?php endif ?>
				</h3>
				<?= ( $film[0]['titreOr'] == $film[0]['titreFr'] ) ? "" : "<h4>".$film[0]['titreOr']."</h4>" ?>
				<ul>
					<?php
					foreach($film[7] as $profession){
						if($profession['prof'] == 'auteur'){
							echo "<li>Auteur : ".$profession['nom']."</li>"; } }
					foreach($film[7] as $profession){
						if($profession['prof'] == 'realis'){
							echo "<li>Réalisateur : ".$profession['nom']."</li>"; } }
					if( $film[1]['distributeur'] != "Inconnu" ){
						if( $film[1]['urlDistributeur'] != "" ){
							echo "<li>Distributeur : <a href=\"" . $film[1]['urlDistributeur'] . "\" target=\"_blank\">" . $film[1]['distributeur'] . "</a></li>";
						}
					}
					else{
						"<p>Distributeur : " . $film[1]['distributeur'] . "</p>";
					}
					?>
					<?= $film[1]['typeFilm'] == "Inconnu" ? "" : "<li>" . $film[1]['typeFilm'] ?>
		<?php if( ! isset( $film[5][0]['nationalite'] ) || $film[5][0]['nationalite'] == "Inconnu" ) : ?>
		<?php else : ?>
			(
			<?php foreach($film[5] as $nationalites) : ?>
				<?php foreach($nationalites as $nationalite) : ?>
					<?= "$nationalite " ?>
				<?php endforeach ?>
			<?php endforeach ?>
			)</li>
		<?php endif ?>
					<?= $film[0]['dateSortieFr'] == "0000-00-00" ? "" : "<li>" . date('d M Y', strtotime($film[0]['dateSortieFr'])) . "</li>" ?>
					<?= $film[1]['couleur'] == "Inconnu" ? "" : "<li>" . $film[1]['couleur'] . "</li>" ?>
					<?php if( $film[0]['duree'] != 0 ) : ?>
						<li><?= floor($film[0]['duree'] / 3600) ?> h <?= ($film[0]['duree'] % 3600)/60 ?></li>
					<?php endif ?>
						<?php if( ! isset( $film[3][0]['genre'] ) || $film[3][0]['genre'] == "Inconnu" ) : ?>
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

					<?php if( ! isset( $film[2][0]['langue'] ) || $film[2][0]['langue'] == "Inconnu" ) : ?>
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
					<?php if( ! isset( $film[6][0]['libelle'] ) ) : ?>
					<?php else : ?>
						<li>
							Sélection(s) : 
							<?php foreach($film[6] as $selection) : ?>
								<a href="<?= $this->url('pageSelections', ['theme' => $selection['theme']]) ?>"><?= $selection['libelle'] ?></a>
								<?= ($selection['anneeRecompense'] != "") ? " (". $selection['anneeRecompense'] .") " : ""?>
							<?php endforeach ?>
						</li>
					<?php endif ?>
					<?php if( $film[0]['noteIMDB'] != 0 ) : ?>
						<li>IMDB : <?= $film[0]['noteIMDB'] ?> /10
						<?php if( $film[0]['nbVotesIMDB'] == 0 ) : ?>
							</li>
						<?php else : ?>
							 sur <?= $film[0]['nbVotesIMDB'] ?> votes
							</li>
						<?php endif ?>
					<?php endif ?>
				</ul>
			</div>
			<div class="col-md-5">
				<?php if( $film[0]['urlBA'] != 0 ) : ?>
					<iframe src='http://www.allocine.fr/_video/iblogvision.aspx?cmedia=<?= $film[0]['urlBA'] ?>' style='width:480px; height:270px'>
					</iframe>
				<?php endif ?>
				<p style="text-align:center;">
					<?= $film[1]['censure'] == "Inconnu" ? "" : "Attention : " . $film[1]['censure'] ?>
				</p>

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
		<?php
			if( ! isset( $film[7][0]['prof'] ) ){
			}
			elseif( isset( $film[7][1] ) ){

				echo "<div class='container'>";
					echo "<h4>Acteurs principaux :</h4>";
					echo "<div class='row'>";

						foreach($film[7] as $index => $acteur){
							if( ($acteur['prof'] == 'acteur') && $index <= NB_MAX_ACTEURS_AFFICHES ){
							echo "<div class='col-md-3 col-sm-6 hero-feature taille'>";
								echo "<div class='thumbnail'>";

								echo "<img src=".$acteur['urlPhoto'].">";
									echo "<div class='caption'>";
									echo "<h5>".$acteur['nom']."</h5>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
							}
						}
					echo "</div>";
				echo "</div>";
			}
			else{
				echo "<h4>\"Acteur\" (un seul !) :</h4>";
				echo $film[7][0]['profession'] . " " . $film[7][0]['nom'];
			}
		?>

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
	<?php foreach($film[7] as $profession){
			if($profession['prof'] == 'produc'){
				echo "<h4>Producteur : ".$profession['nom']."</h4>"; } } ?>
	</div>
	<div class="container">
		<?= $film[0]['budget'] == 0 ? "" : "<h4>Budget : " . $film[0]['budget'] . "</h4>" ?>
	</div>
	<div class="container">
		<?= $film[0]['bof'] == 0 ? "" : "<h4>Box office : " . $film[0]['bof'] . "</h4>" ?>
	</div>
	<div class="container">
		<?php if( ! isset( $film[4][0]['motcle'] ) || $film[4][0]['motcle'] == "Inconnu" ) : ?>
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
	</div>

<?php $this->stop('main_content') ?>
