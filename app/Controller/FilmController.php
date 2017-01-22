<?php

namespace Controller;

use \W\Controller\Controller; // toutes les classes de ce fichier seront incluses dans le namespace "\Controller"
							  // situé directement sous la racine logique.
use \Manager\FilmManager;

class FilmController extends Controller
{

	public function accueil()
	{
		$this->show('film/pageAccueil');
		//                       \_> appelle accueil.php    (dans le répertoire 'film' des templates)
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
		//                       \_> appelle pageFilm.php

	                ['film' => $film] );
		//                       \_> avec ce tableau associatif en paramètre
	}

	public function listerPalmesOr()
	{
		$manager = new FilmManager();
		$resultat = $manager->getPalmesOr();
		$this->show('film/pagePalmesOr', ['resultat' => $resultat]);
	}

	public function listerCriteres()
	{
		$this->show('film/pageCriteres');
	}
}
