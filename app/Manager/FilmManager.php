<?php 

namespace Manager;

class FilmManager extends \W\Manager\Manager {


	public function getNbFilmsPerso($user, $choix){

		$select = "select count(*) as nb from selectionsperso where libelle = $choix and idUtilisateur = $user";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$nbFilms = $requete->fetch()['nb'];
		return $nbFilms;		
	}

	public function getNbFilmsSelection($theme){
		
		$select = "select count(fs.idSelection) as nb from film_selection fs, selections s where s.theme = $theme and fs.idSelection = s.id";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$nbFilms = $requete->fetch()['nb'];
		return $nbFilms;
	}

	public function getSelection($theme, $offset, $nbLignes){
			$listeFilms = [];
			$select = "select * from selections where theme = $theme";
			$requete = $this->dbh->prepare($select);
			$requete->execute();
			$listeFilms[] = $requete->fetch();
			$select = "select count(fs.annee) as nb from film_selection fs, selections s where s.theme = $theme and fs.idSelection = s.id";
			$requete = $this->dbh->prepare($select);
			$requete->execute();
			$resultat = $requete->fetch();
			if( $resultat['nb'] != 0 ){
				$orderBy = " order by	fs.annee desc";
			}
			else{
				$orderBy = " order by	f.anneeProd desc";
			}
			$select = "select	fs.idFilm as id, f.titreFr, f.synopsis, f.anneeProd, fs.annee as anneeSel, f.urlAffiche, f.id as perso
							from		film_selection fs, selections s, films f
							where		s.theme		= $theme
								and		fs.idSelection	= s.id
								and		fs.idFilm		= f.id
							".$orderBy." limit $offset, $nbLignes";
			$requete = $this->dbh->prepare($select);
			$requete->execute();
			$listeFilms[] = $requete->fetchAll();
			return $listeFilms;
		}

	public function getPerso($user, $choix, $offset, $nbLignes){

		$select = "select f.id, f.titreFr, f.synopsis, f.anneeProd, f.urlAffiche from selectionsperso sp, films f where sp.libelle = $choix and sp.idUtilisateur = $user and f.id = sp.idFilm order by f.anneeProd desc";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$listeFilms = $requete->fetchAll(); // (ex. palmesOr, Palme d'Or, Palmes d'Or, ...)
		return $listeFilms;
	}

	public function getDataFilmLiaison_1_Table($idFilm, $tableLiaison, $idL, $table, $champ, $alias){
		$complement1 = "";
		if($tableLiaison == "film_selection"){
			$complement1 = ", $tableLiaison.annee as anneeRecompense";
		}
		$complement2 = "";
		if($tableLiaison == "film_selection"){
			$complement2 = ", $table.theme ";
		}
		$select = "
			select
					$table.$champ as $alias
					$complement1 $complement2
			from
					films, $tableLiaison, $table

			where	films.id	= $tableLiaison.idFilm
				and	$table.id	= $tableLiaison.$idL
				and	films.id	= $idFilm";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		return $requete->fetchAll();
	}

	public function getDataFilmLiaison_2_Tables($idFilm, $tableLiaison, $idL1, $table1, $champ11, $alias11, $champ12, $alias12, $idL2, $table2, $champ21, $alias21, $champ22, $alias22){
		$select = "
			select
					$table1.$champ11 as $alias11,
					$table1.$champ12 as $alias12,
					$table2.$champ21 as $alias21,
					$table2.$champ22 as $alias22
			from
					films, $tableLiaison, $table1, $table2

			where	$table1.id	= $tableLiaison.$idL1
				and	$table2.id	= $tableLiaison.$idL2
				and	films.id	= $tableLiaison.idFilm
				and	films.id	= $idFilm";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		return $requete->fetchAll();
	}

	public function getFilm($id){
		$film = [];
		if( ! is_numeric($id) ){
			return false;
		}
		$select = "
			select
					titreFr,		titreOr,		anneeProd,	dateSortieFr,	duree,		synopsis,
					urlAffiche,		urlBA,			budget,		bof,			noteIMDB,	nbVotesIMDB,
					idAllocine
			from
					films
			where
					id	= $id";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$film[] = $requete->fetch();
		$select = "
			select
					di.libelle	as distributeur,	di.url		as urlDistributeur,		ty.libelle	as typeFilm,
					co.libelle	as couleur,			ce.libelle	as censure
			from
					films fi,	distributeurs di,	typesfilms ty,	couleurs co,	censures ce
			where
					fi.idDistributeur	= di.id
				and	fi.idTypeFilm		= ty.id
				and	fi.idCouleur		= co.id
				and	fi.idCensure		= ce.id
				and	fi.id		= $id";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$film[] = $requete->fetch();
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_langue", "idLangue", "langues", "libelle", "langue");
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_genre", "idGenre", "genres", "libelle", "genre");
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_motcle", "idMotCle", "motscles", "libelle", "motcle");
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_nationalite", "idNationalite", "nationalites", "libelle", "nationalite");
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_selection", "idSelection", "selections", "libelle", "libelle");
		$film[] = $this->getDataFilmLiaison_2_Tables(
			$id, "film_personne_profession",
			"idProfession", "professions", "libelleCourt", "prof", "libelle", "profession",
			"idPersonne", "personnes", "prenom_nom", "nom", "urlPhoto", "urlPhoto");
		return $film;
	}
}

?>