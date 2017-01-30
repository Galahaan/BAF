<?php 

namespace Manager;


// ATTENTION :
// En fait, quand on crée une classe, comme ici FilmManager,
// W va directement lui-même associer la table films (avec un 's' !)


class FilmManager extends \W\Manager\Manager {

	// on crée ici nos propres méthodes spécialisées
	// (en plus de celles héritées de la classe mère Manager)

	////////////////////////            getNbFilmsSelection            /////////////////////////
	//
	// en entrée : 		theme 		= thème de la sélection (ex.: Palmes d'Or, 007, Césars, ...)
	//
	// en sortie : 		nombre de films répondant au thème de la sélection
	//
	// 		Cette méthode retourne le nombre de films répondant au thème de la sélection.
	//
	public function getNbFilmsSelection($theme){
		
		$select = "select count(fs.idSelection) as nb from film_selection fs, selections s where s.theme = $theme and fs.idSelection = s.id";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$nbFilms = $requete->fetch()['nb'];
		return $nbFilms;
	}

	/////////////////////////////            getSelection            /////////////////////////////
	//
	// en entrée : 		theme 		= thème de la sélection (ex.: Palmes d'Or, 007, Césars, ...)
	//
	// 					offset 		= pour le calcul de la pagination
	//
	// 					nbLignes 	= nb de lignes max retournées par la requête
	// 									(pour le calcul de la pagination)
	//
	// en sortie : 		liste des films appartenant à ce thème
	//
	// 		Cette méthode retourne une sélection de films appartenant à un thème.
	//
	public function getSelection($theme, $offset, $nbLignes){
		$listeFilms = [];

		$select = "select * from selections where theme = $theme";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$listeFilms[] = $requete->fetch(); // (ex. palmesOr, Palme d'Or, Palmes d'Or, ...)

		// si on est dans le cas d'un thème où une année X est associée au film,
		// (ex. Palmes d'Or, Césars, sélection annuelle UGC, sélection annuelle Cahiers du Cinéma, etc ...)
		// on trie les résultats de la sélection selon cette année X,
		// sinon on trie selon l'année de production du film (qui n'est pas toujours la même !)

		// pour la 1ère requête, si 'annee' apparaît plusieurs fois dans la table, c'est que le thème
		// est de type 'année associée au film' => on trie selon l'année
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

		// on récupère les infos principales du film à afficher,
		// mais également les infos de l'utilisateur connecté, liées à ce film.
		// Pour ce faire, il nous faut une jointure gauche sur les 2 tables de liaison :
		//
		// C'était une très belle requête, mais ce n'est pas gérable une fois dans la page des résultats ... :-(
		//
		// $select = "select distinct fs.idFilm as id, f.titreFr, f.anneeProd, fs.annee as anneeSel, f.urlAffiche, sp.libelle as perso
		// 			from 			selections s, films f, utilisateurs u,
		// 							film_selection fs
		// 			left join 		selectionsperso sp
		// 			on 				fs.idFilm = sp.idFilm
		// 			where 			fs.idFilm = f.id
		// 						and fs.idSelection = s.id
		// 						and s.theme = $theme
		// 						and u.id = :idUB". $orderBy;
		// $requete = $this->dbh->prepare($select);
		// $requete->bindValue(":idUB", $_SESSION['user']['id']);
		// $requete->execute();
		// $listeFilmUtil[] = $requete->fetchAll();

		// on récupère les infos principales du film à afficher :
		$select = "select	fs.idFilm as id, f.titreFr, f.synopsis, f.anneeProd, fs.annee as anneeSel, f.urlAffiche, f.id as perso
						from		film_selection fs, selections s, films f
						where		s.theme		= $theme
							and		fs.idSelection	= s.id
							and		fs.idFilm		= f.id
						".$orderBy." limit $offset, $nbLignes";
		$requete = $this->dbh->prepare($select);
		$requete->execute();
		$listeFilms[] = $requete->fetchAll();

		// maintenant, on repasse la liste en revue, et on associe les infos utilisateur (vu, à voir, préféré,  ...)
		// sauf qu'il faut tester $_SESSION avant, sinon ça bug : user undefined !
		if( ! empty($_SESSION) ){
			foreach($listeFilms[1] as $index => $film){
				$select = "select 	sp.libelle
							from 	utilisateurs u, selectionsperso sp
							where 	u.id = sp.idUtilisateur
								and u.id = :idUB
								and sp.idFilm = :idFB";

				$requete = $this->dbh->prepare($select);
				$requete->bindValue(":idUB", $_SESSION['user']['id']);
				$requete->bindValue(":idFB", $film['id']);
				$requete->execute();
				$listeInfosUtilisateur = $requete->fetchAll();
				$listeFilms[1][$index]['perso'] = $listeInfosUtilisateur;
			}
		}
		return $listeFilms;
	}

	//////////////////////            getDataFilmLiaison_1_Table            //////////////////////
	//
	// en entrée : 		idFilm 			= id du film dont on veut les données
	//					tableLiaison 	= table de liaison du type 'film_table'
	//					idL 			= id dans la table de liaison vers 'table'
	//					table 			= 'table' dont on veut les données
	//					champ			= nom du champ de 'table' dont on veut la valeur
	//					alias 			= alias du champ, utilisé comme index dans le
	//										tableau associatif résultat de la requête
	//
	// en sortie : 		tableau associatif de données partielles sur un film
	//
	// 		Cette méthode sert à récupérer les données d' UNE SEULE table
	//		associée à un film par le biais de la table de liaison.
	//		Elle est appelée par la methode getFilm(id) définie ci-dessous.
	//
	public function getDataFilmLiaison_1_Table($idFilm, $tableLiaison, $idL, $table, $champ, $alias){

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

	//////////////////////            getDataFilmLiaison_2_Tables            //////////////////////
	//
	// en entrée : 		idFilm 			= id du film dont on veut les données
	//					tableLiaison 	= table de liaison du type 'film_table1_table2'
	//					idL1 / 2		= id dans la table de liaison vers 'table1' / 'table2'
	//					table1 / 2		= 'table1' / 'table2' dont on veut les données
	//					champXY			= nom du champ dont on veut la valeur
	//					aliasXY			= alias du champs, utilisé comme index dans le
	//										tableau associatif résultat de la requête
	//										X = 1 -> 'table 1'	/	X = 2 -> 'table 2'
	//										Y = 1 -> 1e champ	/	Y = 2 -> 2e champ
	//
	// en sortie : 		tableau associatif de données partielles sur un film
	//
	// 		Cette méthode sert à récupérer les données de DEUX tables
	//		associées à un film par le biais de la table de liaison.
	//		Elle est appelée par la methode getFilm(id) définie ci-dessous.
	//
	// ex. d'appel de cette fonction :
	//
	// $id, "film_personne_profession",
	// "idProfession", "professions", "libelleCourt", "prof", "libelle",  "profession",
	// "idPersonne",   "personnes",   "prenom_nom",   "nom",  "urlPhoto", "urlPhoto"
	//
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
					id	= $id";
		$requete = $this->dbh->prepare($select);
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
				and	fi.id		= $id";
		$requete = $this->dbh->prepare($select);
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
			"idProfession", "professions", "libelleCourt", "prof", "libelle", "profession",
			"idPersonne", "personnes", "prenom_nom", "nom", "urlPhoto", "urlPhoto");

		// La méthode retourne le film complet :
		return $film;
	}

	//////////////////////////////       setSelectionsPerso       //////////////////////////////
	//
	// en entrée : 		donnees = 	tableau de l'ensemble des cases cochées par l'utilisateur
	//								(vu, à voir, préféré) de la précédente sélection
	//								(ex.: Palmes d'Or, 007, Césars, ...)
	//
	// en sortie : 		
	//
	// 		Cette méthode stocke en BDD les infos spécifiques utilisateur.
	//
	public function setSelectionsPerso($donnees){
		echo "<br>";
		debug($donnees);

		// il n'y a pas besoin de vérifier si l'utilisateur existe déjà dans la table des sélections perso
		// avant d'insérer les données en BDD, puisqu'il y a une correspondance directe entre
		// id de 'utilisateurs' et idUtilisateur de 'selectionsperso' :
		$idUser = $_POST['idUser'];

		// il n'y a plus qu'à insérer les nouvelles données
		// en effet, les cases non cochées ne sont pas transmises,
		// les cases déjà cochées renvoient des 'on',
		// seules les cases nouvellement cochées renvoient leur code (vu, av, tr)
		foreach( $donnees as $index => $filmSel ){
			if( $index != 'validationSelections' && $index != 'idUser' ){
				foreach( $filmSel as $valeur ){
					if( $valeur != 'on' ){
						// par défaut, quand on ne modifie pas une case déjà cochée,
						// les navigateurs envoient des 'on' au lieu de la valeur prévue ... :-(
						$insert = "insert into selectionsperso (idUtilisateur, libelle, idFilm)
									values ($idUser, '$valeur', $index)";
						echo $insert . "<br>";
						$requete = $this->dbh->prepare($insert);
						$requete->execute();
					}
				}
			}
		}
	}
}

?>