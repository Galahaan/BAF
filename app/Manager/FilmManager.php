<?php 

namespace Manager;


// ATTENTION :
// En fait, quand on crée une classe, comme ici FilmManager,
// W va directement lui-même associer la table films (avec un 's' !)


class FilmManager extends \W\Manager\Manager {

	// on crée ici nos propres méthodes spécialisées
	// (en plus de celles héritées de la classe mère Manager)


	// Retourne la liste des id des films ayant reçu la palme d'Or à Cannes
	public function getPalmesOr()
	{
		$liste = [];
		$select = "select * from selections where libelle = \"Palme d'Or\"";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$liste[] = $requete->fetch();
		$select = "select		f.id, f.titreFr, f.anneeProd, f.urlAffiche, fs.annee as anneeSel
						from		film_selection fs, selections s, films f
						where		s.libelle		= \"Palme d'Or\"
							and		fs.idSelection	= s.id
							and		fs.idFilm		= f.id
						order by	fs.annee desc";
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
	//					colonne 		= utilisé comme index dans le tableau associatif résultat
	//
	// en sortie : 		tableau associatif de données partielles sur un film
	//
	// 		Cette méthode sert à récupérer les données d' UNE SEULE table
	//		associée à un film par le biais de la table de liaison.
	//		Elle est appelée par la methode getFilm(id) définie ci-dessous.
	//
	public function getDataFilmLiaison_1_Table($idFilm, $tableLiaison, $idL, $table, $libelle, $colonne){

		// Cas particulier de la table 'film_selection' : on doit récupérer l'année de la récompense
		if($tableLiaison == "film_selection"){
			$complement = ", $tableLiaison.annee as anneeRecompense";
		}
		else{
			$complement = "";
		}

		$select = "
			select
					$table.$libelle as $colonne
					$complement
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
	//					libelle1 / 2	= champ de 'table1' / 'table2' qui est souvent intitulé 'libelle'
	//					colonne1 / 2	= utilisé comme index dans le tableau associatif résultat
	//
	// en sortie : 		tableau associatif de données partielles sur un film
	//
	// 		Cette méthode sert à récupérer les données de DEUX tables
	//		associées à un film par le biais de la table de liaison.
	//		Elle est appelée par la methode getFilm(id) définie ci-dessous.
	//
	public function getDataFilmLiaison_2_Tables($idFilm, $tableLiaison, $idL1, $table1, $libelle1, $colonne1, $idL2, $table2, $libelle2, $colonne2){
		$select = "
			select
					$table1.$libelle1 as $colonne1,
					$table2.$libelle2 as $colonne2
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
		$film[] = $this->getDataFilmLiaison_1_Table($id, "film_selection", "idSelection", "selections", "libelle", "selection");

		///////////////////		données liées à la table 'films' par 1 table de liaison double :
		//
		$film[] = $this->getDataFilmLiaison_2_Tables(
			$id, "film_personne_profession",
			"idProfession", "professions", "libelle", "prof",
			"idPersonne", "personnes", "prenom_nom", "nom");

		// La méthode retourne le film complet :
		return $film;
	}
}


 ?>