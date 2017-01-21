<?php 

namespace Manager;


// ATTENTION :
// En fait, quand on crée une classe, comme ici FilmManager,
// W va directement lui-même associer la table films (avec un 's' !)


class FilmManager extends \W\Manager\Manager {

	// on crée ici nos propres méthodes spécialisées
	// (en plus de celles dont on hérite de la classe mère)


	///////////////////////////////          getFilm          ////////////////////////////////
	//
	// en entrée : 		id du film en BDD
	// en sortie : 		tableau de données
	//
	// 		Cette méthode sert à l'affichage de la Fiche d'un film.
	//

	public function getFilm($id)
	{
		if( ! is_numeric($id) ){
			return false;
		}

		$selection = "
			select
				fi.idAllocine,
				fi.titreFr,
				fi.titreOr,
				fi.anneeProd,
				fi.dateSortieFr,
				fi.duree,
				fi.synopsis,
				fi.urlAffiche,
				fi.urlBA,
				fi.budget,
				fi.bof,
				fi.noteIMDB,
				fi.nbVotesIMDB"
				// ,

				// di.libelle	as distributeur,
				// di.url		as urlDistrib,
				// ty.libelle	as typeFilm,
				// co.libelle	as couleur,
				// ce.libelle	as censure,
				// la.libelle	as langue,
				// ge.libelle	as genre,
				// mc.libelle	as motsCles,
				// na.libelle	as nationalite,

				// pr.libelle	as profession,
				// pe.prenom_nom	as prenom_nom


				." from
					films fi"
					// , distributeurs di, typesfilms ty, couleurs co, censures ce, film_langue fl, langues la,
					// film_genre fg, genres ge, film_motcle fm, motscles mc, film_nationalite fn, nationalites na,
					// film_personne_profession fpp, personnes pe, professions pr

				." where
						fi.idAllocine		= :idB"
					// and	fi.idDistributeur	= di.id
					// and	fi.idTypeFilm		= ty.id
					// and	fi.idCouleur		= co.id
					// and	fi.idCensure		= ce.id
					// and	fi.id				= fl.idFilm
					// and	fl.idLangue			= la.id

					// and	fg.idFilm			= fi.id
					// and	fg.idGenre			= ge.id
					// and fm.idFilm			= fi.id
					// and fm.idMotCle			= mc.id
					// and fn.idFilm			= fi.id
					// and fn.idNationalite	= na.id

					// and fpp.idFilm 			= fi.id
					// and fpp.idPersonne		= pe.id
					// and fpp.idProfession	= pr.id

		;


		$requete = $this->dbh->prepare($selection);
		$requete->bindValue(":idB", $id);
		$requete->execute();

		return $requete->fetch(); // PDO::FETCH_ASSOC    ne passe pas ...
	}
}


 ?>