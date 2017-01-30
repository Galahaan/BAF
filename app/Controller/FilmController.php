<?php

namespace Controller;

use \W\Controller\Controller; // toutes les classes de ce fichier seront incluses dans le namespace "\Controller"
							  // situé directement sous la racine logique.
use \Manager\FilmManager;


// --------------------------------------------------------------
// Constantes liées à la pagination
// --------------------------------------------------------------

define("NB_FILM_PAGE",   '26');
define("MODE_PAGINATION", ''  );    // vide par défaut '' ou 'pager' ou 'alphanumeric' (mais les 2 derniers ne fonctionnent pas)


class FilmController extends Controller
{

	public function accueil()
	{
		$this->show('film/pageAccueil');
	}

	public function aPropos()
	{
		$this->show('film/pageApropos');
	}

	public function afficherFilm($id)
	{
		$manager = new FilmManager();
		$film = $manager->getFilm($id);
		//debug($film);
		$this->show( 'film/pageFilm',
		//                       \_> appelle pageFilm.php	(dans le répertoire 'film' des templates)

	                ['film' => $film] );
		//                       \_> avec ce tableau associatif en paramètre
	}

	public function listerSelections($theme, $page = 1)
	{

		if( ! isset($_POST['validationSelections']) ){

			// affichage de la sélection selon le thème choisi : Palmes d'Or, 007, Films vus, etc ...

			$manager = new FilmManager();
			$nbFilms = $manager->getNbFilmsSelection("\"" . $theme . "\"");

			$modePagination = MODE_PAGINATION;

			//-------------------------------------------------------------------------------------
			// Gestion de la pagination numérique
			//-------------------------------------------------------------------------------------	
			if (filter_var($page, FILTER_VALIDATE_INT) or $page !=0 ) {
				$offset = ($page - 1) * NB_FILM_PAGE ;					// A l'initialisation, l'offset vaut 0.

				echo "<br><br>";
				// debug($nbFilms);
				// debug(NB_FILM_PAGE);

				$nbTotalPages = ceil($nbFilms / NB_FILM_PAGE);			// Nombre total de page,

				if ($page != $nbTotalPages){
					$nbEntree = NB_FILM_PAGE;
				} else {
					$nbEntree = ($nbFilms%NB_FILM_PAGE == 0) ? NB_FILM_PAGE : $nbFilms%NB_FILM_PAGE; 
				}

				$films = $manager->getSelection("\"" . $theme . "\"", $offset, $nbEntree);

				$eltsPagination = [ 'page' => $page, 'offset' => $offset, 'modePagination' => $modePagination, 'nbTotalPages' => $nbTotalPages ];

				$this->show('film/pageSelections', ['films' => $films, 'theme' => $theme, 'eltsPagination' => $eltsPagination]);

				// original : $films = get_last_movies($offset, $nbEntree);
			}
		}
		else{

			// traitement du formulaire envoyé par pageSelection : (ie les cases cochées)
			$manager = new FilmManager();
			$manager->setSelectionsPerso($_POST);

			// avant de faire une page de confirmation d'enregistrement des données :
			//$this->redirectToRoute('pageAccueil');
		}
	}

	public function listerCriteres()
	{
		$this->show('film/pageCriteres');
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




}
