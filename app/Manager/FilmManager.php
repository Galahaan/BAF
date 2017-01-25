<?php 

namespace Manager;


// ATTENTION :
// En fait, quand on crée une classe, comme ici FilmManager,
// W va directement lui-même associer la table films (avec un 's' !)


class FilmManager extends \W\Manager\Manager {

	// on crée ici nos propres méthodes spécialisées
	// (en plus de celles héritées de la classe mère Manager)

	/////////////////////////////            getSelection            /////////////////////////////
	//
	// en entrée : 		theme 	= thème de la sélection (ex.: Palmes d'Or, 007, Césars, ...)
	//
	// en sortie : 		liste des films appartenant à ce thème
	//
	// 		Cette méthode retourne une sélection de films appartenant à un thème.
	//		associée à un film par le biais de la table de liaison.
	//
	public function getSelection($theme){
		$liste = [];
		$select = "select * from selections where theme = $theme";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$liste[] = $requete->fetch();

		// si on est dans le cas d'un thème 'récompense', donc décernée une certaine année X,
		// on trie les résultats de la sélection selon cette année X,
		// sinon on trie selon l'année de production du film :
		$select = "select count(fs.annee) as nb from film_selection fs, selections s where s.theme = $theme and fs.idSelection = s.id";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$resultat = $requete->fetch();
		if( $resultat['nb'] != 0 ){
			$orderBy = " order by	fs.annee desc";		// cas où l'année est connue
		}
		else{
			$orderBy = " order by	f.anneeProd desc";	// cas où l'année est vide
		}
		$select = "select	f.id, f.titreFr, f.anneeProd, f.urlAffiche, fs.annee as anneeSel
						from		film_selection fs, selections s, films f
						where		s.theme		= $theme
							and		fs.idSelection	= s.id
							and		fs.idFilm		= f.id
						".$orderBy;
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$liste[] = $requete->fetchAll();
		return $liste;
	}

	//////////////////////            getDataFilmLiaison_1_Table            //////////////////////
	//
	// en entrée : 		idFilm 			= id du film dont on veut les données
	//					tableLiaison 	= table de liaison du type 'film_table'
	//					idL 			= id dans la table de liaison vers 'table'
	//					table 			= 'table' dont on veut les données
	//					libelle			= champ de 'table' qui est souvent intitulé 'libelle'
	//					alias 			= utilisé comme index dans le tableau associatif résultat
	//
	// en sortie : 		tableau associatif de données partielles sur un film
	//
	// 		Cette méthode sert à récupérer les données d' UNE SEULE table
	//		associée à un film par le biais de la table de liaison.
	//		Elle est appelée par la methode getFilm(id) définie ci-dessous.
	//
	public function getDataFilmLiaison_1_Table($idFilm, $tableLiaison, $idL, $table, $libelle, $alias){

		// Cas particulier de la table 'film_selection' : on récupère l'année de la 'récompense'
		$complement1 = "";
		if($tableLiaison == "film_selection"){
			$complement1 = ", $tableLiaison.annee as anneeRecompense";
		}

		// Cas particulier de la table 'film_selection', voire plus tard, des autres tables  :
		// on récupère le thème de la sélection, écrit dans routes.php,
		// pour faire un lien vers la liste des films de ce thème.
		// (de façon plus générique, on récupère la FIN DU CHEMIN écrit dans routes.php)
		$complement2 = "";
		if($tableLiaison == "film_selection"){
			$complement2 = ", $table.theme ";
		}
		$select = "
			select
					$table.$libelle as $alias
					$complement1 $complement2
			from
					films, $tableLiaison, $table

			where	films.id	= $tableLiaison.idFilm
				and	$table.id	= $tableLiaison.$idL
				and	films.id	= $idFilm";
		$requete = $this->dbh->prepare($select);
		$requete->bindValue(":idB", $idFilm);
		$requete->execute();
		return $requete->fetchAll();
	}

	//////////////////////            getDataFilmLiaison_2_Tables            //////////////////////
	//
	// en entrée : 		idFilm 			= id du film dont on veut les données
	//					tableLiaison 	= table de liaison du type 'film_table1_table2'
	//					idL1 / 2		= id dans la table de liaison vers 'table1' / 'table2'
	//					table1 / 2		= 'table1' / 'table2' dont on veut les données
	//					libelle1x / 2	= champ de 'table1' / 'table2' qui est souvent intitulé 'libelle'
	//										x = C ou L = libelle court / libelle
	//					alias1x / 2		= utilisé comme index dans le tableau associatif résultat
	//										x = C ou L = alias pour libelle court / alias pour libelle
	// en sortie : 		tableau associatif de données partielles sur un film
	//
	// 		Cette méthode sert à récupérer les données de DEUX tables
	//		associées à un film par le biais de la table de liaison.
	//		Elle est appelée par la methode getFilm(id) définie ci-dessous.
	//
	public function getDataFilmLiaison_2_Tables($idFilm, $tableLiaison, $idL1, $table1, $libelle1C, $libelle1L, $alias1C, $alias1L, $idL2, $table2, $libelle2, $alias2){
		$select = "
			select
					$table1.$libelle1C as $alias1C,
					$table1.$libelle1L as $alias1L,
					$table2.$libelle2 as $alias2
			from
					films, $tableLiaison, $table1, $table2

			where	$table1.id	= $tableLiaison.$idL1
				and	$table2.id	= $tableLiaison.$idL2
				and	films.id	= $tableLiaison.idFilm
				and	films.id	= $idFilm";
		$requete = $this->dbh->prepare($select);
		$requete->bindValue(":idB", $idFilm);
		$requete->execute();
		return $requete->fetchAll();
	}

	///////////////////////////////          getFilm          ////////////////////////////////
	//
	// en entrée : 		id du film en BDD
	// en sortie : 		tableau associatif des données de l'ensemble du film
	//
	// 		Cette méthode sert à l'affichage de la Fiche d'un film.
	//
	public function getFilm($id){

		// initialisation du tableau qui contiendra toutes les infos du film
		$film = [];

		if( ! is_numeric($id) ){
			return false;
		}

		/////////////////////////////		données directes de la table 'films' :
		//
		$select = "
			select
					titreFr,		titreOr,		anneeProd,	dateSortieFr,	duree,		synopsis,
					urlAffiche,		urlBA,			budget,		bof,			noteIMDB,	nbVotesIMDB,
					idAllocine
			from
					films
			where
					id	= :idB";
		$requete = $this->dbh->prepare($select);
		$requete->bindValue(":idB", $id);
		$requete->execute();
		$film[] = $requete->fetch();   // PDO::FETCH_ASSOC    ne passe pas, cf + bas aussi **************************************************

		///////////////////		données liées à la table 'films' par un 'idXxx' :
		//
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
				and	fi.id		= :idB";
		$requete = $this->dbh->prepare($select);
		$requete->bindValue(":idB", $id);
		$requete->execute();
		$film[] = $requete->fetch();

		///////////////////		données liées à la table 'films' par 1 table de liaison simple :
		//
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_langue", "idLangue", "langues", "libelle", "langue");
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_genre", "idGenre", "genres", "libelle", "genre");
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_motcle", "idMotCle", "motscles", "libelle", "motcle");
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_nationalite", "idNationalite", "nationalites", "libelle", "nationalite");
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_selection", "idSelection", "selections", "libelle", "libelle");

		///////////////////		données liées à la table 'films' par 1 table de liaison double :
		//
		$film[] = $this->getDataFilmLiaison_2_Tables(
			$id, "film_personne_profession",
			"idProfession", "professions", "libelleCourt", "libelle", "prof", "profession",
			"idPersonne", "personnes", "prenom_nom", "nom");

		// La méthode retourne le film complet :
		return $film;
	}
}


 ?>