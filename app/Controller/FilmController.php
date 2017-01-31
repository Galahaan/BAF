<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\FilmManager;


// --------------------------------------------------------------
// Gestion de la pagination
// --------------------------------------------------------------
define("NB_FILM_PAGE", 26);
define("DEFAULT_PAGINATION",            '');    
// define("PAGER_PAGINATION",              'pager');  
// define("ALPHANUMERIC_PAGINATION",       'alphanumeric');
// define("LF",                    "\n"); // Line Feed
// define("TABULATION_01",         "\t");
// define("TABULATION_02",         "\t\t");
// define("TABULATION_03",         "\t\t\t");
// define("TABULATION_04",         "\t\t\t\t");


class FilmController extends Controller
{

	public function accueil()
	{
		$this->show('film/pageAccueil');
	}

	public function contacts()
	{
		$this->show('film/pageContacts');
	}

	public function aPropos()
	{
		$this->show('film/pageApropos');
	}

	public function afficherFilm($id)
	{
		$manager = new FilmManager();
		$film = $manager->getFilm($id);
		$this->show( 'film/pageFilm', ['film' => $film] );
	}

	public function listerSelections($theme, $page = 1)
	{
		$manager = new FilmManager();
		$nbFilms = $manager->getNbFilmsSelection("\"" . $theme . "\"");

		$modePagination = DEFAULT_PAGINATION;
		//$modePagination = ALPHANUMERIC_PAGINATION;
		//$modePagination = PAGER_PAGINATION;

		//-------------------------------------------------------------------------------------
		// Gestion de la pagination numérique
		//-------------------------------------------------------------------------------------	
		if (filter_var($page, FILTER_VALIDATE_INT) or $page !=0 ) {
			$offset = ($page - 1) * NB_FILM_PAGE ;
			$nbTotalPages = ceil($nbFilms / NB_FILM_PAGE);

			if ($page != $nbTotalPages){
				$nbEntree = NB_FILM_PAGE;
			} else {
				$nbEntree = ($nbFilms%NB_FILM_PAGE == 0) ? NB_FILM_PAGE : $nbFilms%NB_FILM_PAGE; 
			}
			$films = $manager->getSelection("\"" . $theme . "\"", $offset, $nbEntree);
			$eltsPagination = [ 'page' => $page, 'offset' => $offset, 'modePagination' => $modePagination, 'nbTotalPages' => $nbTotalPages ];
			$this->show('film/pageSelections', ['films' => $films, 'theme' => $theme, 'eltsPagination' => $eltsPagination]);
		}
	}

	public function listerPersos($perso, $page = 1)
	{
		$user = $_SESSION['user']['id'];
		$manager = new FilmManager();
		$nbFilms = $manager->getNbFilmsPerso($user, "\"" . $perso . "\"");
		$modePagination = DEFAULT_PAGINATION;

		if (filter_var($page, FILTER_VALIDATE_INT) or $page !=0 ) {
			$offset = ($page - 1) * NB_FILM_PAGE ;

			$nbTotalPages = ceil($nbFilms / NB_FILM_PAGE);

			if ($page != $nbTotalPages){
				$nbEntree = NB_FILM_PAGE;
			} else {
				$nbEntree = ($nbFilms%NB_FILM_PAGE == 0) ? NB_FILM_PAGE : $nbFilms%NB_FILM_PAGE; 
			}
			$films = $manager->getPerso($user, "\"" . $perso . "\"", $offset, $nbEntree);
			$eltsPagination = [ 'page' => $page, 'offset' => $offset, 'modePagination' => $modePagination, 'nbTotalPages' => $nbTotalPages ];
			$this->show('film/pagePersos', ['films' => $films, 'perso' => $perso, 'eltsPagination' => $eltsPagination]);
		}
	}


	public function listerCriteres()
	{
		$this->show('film/pageCriteres');
	}
}
